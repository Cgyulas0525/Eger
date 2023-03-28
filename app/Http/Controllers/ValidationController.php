<?php

namespace App\Http\Controllers;

use App\Classes\SWAlertClass;
use App\Classes\ToolsClass;
use App\Classes\Models\ModelPath;
use App\Http\Requests\CreateClientsRequest;
use App\Http\Requests\UpdateClientsRequest;
use App\Models\Clientquestionnaries;
use App\Models\Clientvouchers;
use App\Repositories\ClientsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Clients;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use myUser;

use PDF;
use Mail;
use QrCode;

use App\Http\Controllers\QuestionnariesToolController;
use App\Classes\LogitemClass;

class ValidationController extends Controller
{
    private $logitem;

    function __construct() {
        $this->logitem = new LogitemClass();
    }
    /**
     * @param $data
     * @return mixed
     *
     * Datatables data
     */
    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                return '<a href="' . route('beforeValidatingValidation', [$row->id, 'Clients']) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Validálás"><i class="fas fa-user-edit"></i></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @param Request $request
     * @param $active
     * @param $validated
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     *
     * view clients.validating
     */
    public function validating(Request $request, $active, $validated)
    {
        if( myUser::check() ){

            if ($request->ajax()) {

                $data = DB::table('clients as t1')
                    ->join('settlements as t3', 't3.id', '=', 't1.settlement_id')
                    ->select('t1.*', DB::raw('concat(t1.postcode, " ", t3.name, " ", t1.address) as fulladdress'), 't3.name as settlementName')
                    ->whereNull('t1.deleted_at')
                    ->where('t1.active', '=', $active)
                    ->where( 't1.validated', '=', $validated)
                    ->get();
                return $this->dwData($data);

            }

            return view('clients.validating');
        }
    }

    /**
     * @param $id
     * @param $table
     * @param $route
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     * question before validation
     */
    public function beforeValidation($id, $table, $route) {
        $view = 'layouts.show';
        $model_name = ModelPath::makeModelPath($table);
        $data = $model_name::find($id);
        SWAlertClass::choice($id, 'Biztosan validálja az ügyfelet?', '/'.$route, 'Kilép', '/Validation/'.$id.'/'.$table.'/'.$route, 'Váltás');

        return view($view)->with('table', $data);
    }

    /**
     * @param $id
     * @param $table
     * @param $route
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * validating client
     */
    public function Validation($id, $table, $route) {
        $route .= '.index';
        $model_name = ModelPath::makeModelPath($table);
        $record = $model_name::find($id);

        if (empty($record)) {
            return redirect(route($route));
        }


        if ($table == "Clients") {
            $this->basicVouchersSend($record);
            $this->basicQuestionnariesSend($record);
        }

        $record->validated = $record->validated == 0 ? 1 : 0;
        $record->local = ClientToolsController::localCheck($record->postcode);
        $record->save();
        $this->logitem->iudRecord(8, $record->getTable(), $record->id);

        return redirect(route($route));
    }

    /**
     * @param $id
     * @param $table
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     * question before valadating
     */
    public function beforeValidatingValidation($id, $table) {
        $view = 'layouts.show';
        $model_name = ModelPath::makeModelPath($table);
        $data = $model_name::find($id);
        SWAlertClass::choice($id, 'Biztosan validálja az ügyfelet?', '/validating/1/0', 'Kilép', '/validatingValidation/'.$id.'/'.$table, 'Váltás');

        return view($view)->with('table', $data);
    }

    /**
     * send basic vouchers to client
     */
    public function basicVouchersSend($record) {
        $vouchers = VoucherToolController::validFundVouchers();
        if (!empty($vouchers)) {
            $files = [];
            foreach ($vouchers as $voucher) {
                array_push($files, $this->voucherPDF($record, $voucher));
                $this->clientVoucherInsert($record, $voucher);
            }
            $this->emailSend($record, $files, 'emails.voucherMail',' alkalmazás új vouchert, vochereket küldött Önnek.');
        }
    }

    /**
     * send basic questinnaries to client
     */
    public function basicQuestionnariesSend($record) {
        $questionnaries = QuestionnariesToolController::activeBasicQuestionnaries();
        if (!empty($questionnaries)) {
            $files = [];
            foreach ($questionnaries as $questionnarie) {
                array_push($files, $this->questionnariePDF($record, $questionnarie));
                $this->clientQuestionnarieInsert($record, $questionnarie);
            }
            $this->emailSend($record, $files, 'emails.voucherMail',' alkalmazás új űrlapot, űrlapokat küldött Önnek.');
        }
    }

    /**
     * @param $id
     * @param $table
     *
     * client valadating
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function validatingValidation($id, $table) {
        $route = '/validating/1/0';

        $model_name = ModelPath::makeModelPath($table);
        $record = $model_name::find($id);

        if (empty($record)) {
            return redirect(route('validating', [1,0]));
        }

        $this->basicVouchersSend($record);
        $this->basicQuestionnariesSend($record);

        $record->validated = $record->validated == 0 ? 1 : 0;
        $record->local = ClientToolsController::localCheck($record->postcode);
        $record->save();
        $this->logitem->iudRecord(8, $record->getTable(), $record->id);

        if (ToolsClass::toBeValidated()->count() > 0) {
            return redirect(route('validating', [1,0]));
        } else {
            return redirect(route('dashboard'));
        }
    }

    /**
     * @param $client
     * @param $voucher
     *
     * new record in clientcouchers table
     *
     */
    public function clientVoucherInsert($client, $voucher) {
        $clientvoucher = new Clientvouchers();
        $clientvoucher->client_id = $client->id;
        $clientvoucher->voucher_id = $voucher->id;
        $clientvoucher->posted = \Carbon\Carbon::now();
        $clientvoucher->created_at = \Carbon\Carbon::now();
        $clientvoucher->save();
        $this->logitem->iudRecord(3, $clientvoucher->getTable(), $clientvoucher->id);
    }

    /**
     * @param $client
     * @param $questionnarie
     *
     * new recors clientquestionnaries table
     *
     */
    public function clientQuestionnarieInsert($client, $questionnarie) {
        $clientquestionnarie = new Clientquestionnaries();
        $clientquestionnarie->client_id = $client->id;
        $clientquestionnarie->questionnarie_id = $questionnarie->id;
        $clientquestionnarie->posted = \Carbon\Carbon::now();
        $clientquestionnarie->created_at = \Carbon\Carbon::now();
        $clientquestionnarie->save();
        $this->logitem->iudRecord(3, $clientquestionnarie->getTable(), $clientquestionnarie->id);
    }

    /**
     * @param $client
     * @param $voucher
     * @return string
     *
     * new voucher pdf file for client
     */
    public function voucherPDF($client, $voucher)
    {

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('printing.printingEmail', ['body' => 'printing.voucherPrintingBody', 'voucher' => $voucher, 'client' => $client]);

        $fileName = $voucher->partnerName . '-' . $client->name . '-' . $voucher->name . '-' . date('Y-m-d',strtotime('today')) .'-voucher.pdf';
        $path = public_path('print/'.$fileName);

        $pdf->save($path, 'UTF-8');

        return $path;

    }

    /**
     * @param $client
     * @param $questionnarie
     * @return string
     *
     * new querionnarie pdf file for client
     */
    public function questionnariePDF($client, $questionnarie)
    {

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('printing.printingEmail', ['body' => 'printing.questionnairePrintingBody', 'questionnaire' => $questionnarie, 'client' => $client]);

        $fileName = $client->name . '-' . $questionnarie->name . '-' . date('Y-m-d',strtotime('today')) .'-kérdőív.pdf';
        $path = public_path('print/'.$fileName);

        $pdf->save($path, 'UTF-8');

        return $path;

    }

    /**
     * @param $client
     * @param $files
     * @param $mail
     * @param $text
     * @return \Illuminate\Http\RedirectResponse
     *
     * send email to client
     */
    public function emailSend($client, $files, $mail, $text) {

        $data["client"] = $client->name;
        $data["email"] = $client->email;
        $data["title"] = config('app.name') . ' alkalmazás!';
        $data["body"] = config('app.name') . ' alkalmazás új '. $text;
        $data["datum"] = date('Y-m-d');

        Mail::send($mail, $data, function($message) use($files, $data) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"]);

            foreach ($files as $file) {
                $message->attach($file);
            }

        });

        return back();

    }


}
