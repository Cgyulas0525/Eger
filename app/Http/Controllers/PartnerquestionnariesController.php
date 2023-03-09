<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePartnerquestionnariesRequest;
use App\Http\Requests\UpdatePartnerquestionnariesRequest;
use App\Repositories\PartnerquestionnariesRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Partnerquestionnaries;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use myUser;
use App\Classes\LogitemClass;

class PartnerquestionnariesController extends AppBaseController
{
    /** @var PartnerquestionnariesRepository $partnerquestionnariesRepository*/
    private $partnerquestionnariesRepository;
    private $logitem;

    public function __construct(PartnerquestionnariesRepository $partnerquestionnariesRepo)
    {
        $this->partnerquestionnariesRepository = $partnerquestionnariesRepo;
        $this->logitem = new LogitemClass();
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '';
//                $btn = $btn . '<a href="' . route('partnerquestionnaries.edit', [$row->id]) . '"
//                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
//                $btn = $btn . '<a href="' . route('beforeDestroys', ['Partnerquestionnaries', $row["id"], 'partnerquestionnaries']) . '"
//                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Partnerquestionnaries.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( myUser::check() ){

            if ($request->ajax()) {

                $data = $this->partnerquestionnariesRepository->all();
                return $this->dwData($data);

            }

            return view('partnerquestionnaries.index');
        }
    }

    /**
     * Display a listing of the Partnerquestionnaries.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function pqIndex(Request $request, $id)
    {
        if( myUser::check() ){

            if ($request->ajax()) {

                $data = DB::table('partnerquestionnaries as t1')
                    ->join('partners as t2', 't2.id', '=', 't1.partner_id')
                    ->join('questionnaires as t3', 't3.id', '=', 't1.questionnarie_id')
                    ->select('t1.*', 't2.name as partnerName', 't3.name as questionnarieName', 't3.active as qactive',
                        't3.active', 't3.validityfrom', 't3.validityto', 't3.id as questionnarieId')
                    ->where('t1.partner_id', $id)
                    ->whereNull('t1.deleted_at')
                    ->get();
                return $this->dwData($data);

            }

            return view('partnerquestionnaries.index');
        }
    }

    /**
     * Display a listing of the Partnerquestionnaries.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function qpIndex(Request $request, $id)
    {
        if( myUser::check() ){

            if ($request->ajax()) {

                $data = DB::table('partnerquestionnaries as t1')
                    ->join('partners as t2', 't2.id', '=', 't1.partner_id')
                    ->join('questionnaires as t3', 't3.id', '=', 't1.questionnarie_id')
                    ->select('t1.*', 't2.name as partnerName', 't3.name as questionnarieName', 't3.active as qactive',
                        't2.active as pactive', 't3.validityfrom', 't3.validityto', 't2.id as partnerId')
                    ->where('t1.questionnarie_id', $id)
                    ->whereNull('t1.deleted_at')
                    ->get();
                return $this->dwData($data);

            }

            return view('partnerquestionnaries.index');
        }
    }

    /**
     * Show the form for creating a new Partnerquestionnaries.
     *
     * @return Response
     */
    public function create()
    {
        return view('partnerquestionnaries.create');
    }

    /**
     * Store a newly created Partnerquestionnaries in storage.
     *
     * @param CreatePartnerquestionnariesRequest $request
     *
     * @return Response
     */
    public function store(CreatePartnerquestionnariesRequest $request)
    {
        $input = $request->all();

        $partnerquestionnaries = $this->partnerquestionnariesRepository->create($input);
        $this->logitem->iudRecord(3, $partnerquestionnaries->getTable(), $partnerquestionnaries->id);

        return redirect(route('partnerquestionnaries.index'));
    }

    /**
     * Display the specified Partnerquestionnaries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $partnerquestionnaries = $this->partnerquestionnariesRepository->find($id);

        if (empty($partnerquestionnaries)) {
            return redirect(route('partnerquestionnaries.index'));
        }

        return view('partnerquestionnaries.show')->with('partnerquestionnaries', $partnerquestionnaries);
    }

    /**
     * Show the form for editing the specified Partnerquestionnaries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $partnerquestionnaries = $this->partnerquestionnariesRepository->find($id);

        if (empty($partnerquestionnaries)) {
            return redirect(route('partnerquestionnaries.index'));
        }

        return view('partnerquestionnaries.edit')->with('partnerquestionnaries', $partnerquestionnaries);
    }

    /**
     * Update the specified Partnerquestionnaries in storage.
     *
     * @param int $id
     * @param UpdatePartnerquestionnariesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePartnerquestionnariesRequest $request)
    {
        $partnerquestionnaries = $this->partnerquestionnariesRepository->find($id);

        if (empty($partnerquestionnaries)) {
            return redirect(route('partnerquestionnaries.index'));
        }

        $partnerquestionnaries = $this->partnerquestionnariesRepository->update($request->all(), $id);
        $this->logitem->iudRecord(4, $partnerquestionnaries->getTable(), $partnerquestionnaries->id);


        return redirect(route('partnerquestionnaries.index'));
    }

    /**
     * Remove the specified Partnerquestionnaries from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $partnerquestionnaries = $this->partnerquestionnariesRepository->find($id);

        if (empty($partnerquestionnaries)) {
            return redirect(route('partnerquestionnaries.index'));
        }

        $this->partnerquestionnariesRepository->delete($id);
        $this->logitem->iudRecord(5, $partnerquestionnaries->getTable(), $partnerquestionnaries->id);

        return redirect(route('partnerquestionnaries.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW() : array
    {
        return [" "] + partnerquestionnaries::orderBy('name')->pluck('name', 'id')->toArray();
    }

    /**
     * Partners witch not are in partnerquestionnaries table
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public static function PartnerQuestionnairesPartnerNotConnected($id) {
        $data = DB::table('partners as t1')
            ->whereNull('t1.deleted_at')
            ->where('active', 1)
            ->whereNotIn('id', DB::table('partnerquestionnaries as t2')->where('t2.questionnarie_id', $id)->pluck('t2.partner_id'))
            ->orWhereIn('id', DB::table('partnerquestionnaries as t2')->where('t2.questionnarie_id', $id)->whereNotNull('t2.deleted_at')->pluck('t2.partner_id'))
            ->get();;

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);

    }

    /**
     * Questionnarie witch not are in partnerquestionnaries table
     *
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function PartnerQuestionnariesQuestionnarieNotConnected($id) {
        $data = DB::table('questionnaires as t1')
            ->whereNull('t1.deleted_at')
            ->where('active', 1)
            ->whereNotIn('id', DB::table('partnerquestionnaries as t2')->where('t2.partner_id', $id)->pluck('t2.questionnarie_id'))
            ->orWhereIn('id', DB::table('partnerquestionnaries as t2')->where('t2.partner_id', $id)->whereNotNull('t2.deleted_at')->pluck('t2.questionnarie_id'))
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}



