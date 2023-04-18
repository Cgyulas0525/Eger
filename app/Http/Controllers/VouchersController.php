<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVouchersRequest;
use App\Http\Requests\UpdateVouchersRequest;
use App\Repositories\VouchersRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Vouchers;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use myUser;
use App\Classes\LogitemClass;

class VouchersController extends AppBaseController
{
    /** @var VouchersRepository $vouchersRepository*/
    private $vouchersRepository;
    private $logitem;

    public function __construct(VouchersRepository $vouchersRepo)
    {
        $this->vouchersRepository = $vouchersRepo;
        $this->logitem = new LogitemClass();
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '';
                if ($row->active == 1) {
                    if ($row->usednumber == 0) {
                        $btn = $btn.'<a href="' . route('vouchers.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                        $btn = $btn.'<a href="' . route('beforeDestroys', ['Vouchers', $row->id, 'vouchers']) . '"
                                         class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                    }
                    $btn = $btn.'<a href="' . route('beforeActivation', [$row->id, 'Vouchers', 'vouchers']) . '"
                                         class="btn btn-warning btn-sm deleteProduct" title="Deaktiválás"><i class="fas fa-user-check"></i></a>';

                } else {
                    $btn = $btn.'<a href="' . route('beforeActivation', [$row->id, 'Vouchers', 'vouchers']) . '"
                                         class="btn btn-danger btn-sm deleteProduct" title="Aktiválás"><i class="fas fa-user-alt-slash"></i></a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Vouchers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( myUser::check() ){

            if ($request->ajax()) {

                $data = DB::table('vouchers as t1')
                    ->join('partners as t2', 't2.id', '=', 't1.partner_id')
                    ->join('vouchertypes as t3', 't3.id', '=', 't1.vouchertype_id')
                    ->select('t1.*', 't2.name as partnerName', 't3.name as voucherTypeName')
                    ->whereNull('t1.deleted_at')
                    ->where('t1.active', 1)
                    ->get();
                return $this->dwData($data);

            }

            return view('vouchers.index');
        }
    }

    public function vouchersIndex(Request $request, $active = null, $partner = null)
    {
        if( myUser::check() ){

            if ($request->ajax()) {

                $data = DB::table('vouchers as t1')
                    ->join('partners as t2', 't2.id', '=', 't1.partner_id')
                    ->join('vouchertypes as t3', 't3.id', '=', 't1.vouchertype_id')
                    ->select('t1.*', 't2.name as partnerName', 't3.name as voucherTypeName')
                    ->whereNull('t1.deleted_at')
                    ->where( function($query) use ($active) {
                        if (is_null($active) || $active == -9999 ) {
                            $query->whereNotNull('t1.active');
                        } else {
                            $query->where('t1.active', '=', $active);
                        }
                    })
                    ->where( function($query) use ($partner) {
                        if (is_null($partner) || $partner == 0 ) {
                            $query->whereNotNull('t1.partner_id');
                        } else {
                            $query->where('t1.partner_id', '=', $partner);
                        }
                    })
                    ->get();
                return $this->dwData($data);

            }

            return view('vouchers.index');
        }
    }

    /**
     * Show the form for creating a new Vouchers.
     *
     * @return Response
     */
    public function create()
    {
        return view('vouchers.create');
    }

    /**
     * Store a newly created Vouchers in storage.
     *
     * @param CreateVouchersRequest $request
     *
     * @return Response
     */
    public function store(CreateVouchersRequest $request)
    {
        $input = $request->all();

        $input['qrcode'] = 'http';
        $vouchers = $this->vouchersRepository->create($input);
        $vouchers->qrcode = 'http://voucher/' . $vouchers->id;
        $vouchers->save();
        $this->logitem->iudRecord(3, $vouchers->getTable(), $vouchers->id);

        return redirect(route('vouchers.index'));
    }

    /**
     * Display the specified Vouchers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vouchers = $this->vouchersRepository->find($id);

        if (empty($vouchers)) {
            return redirect(route('vouchers.index'));
        }

        return view('vouchers.show')->with('vouchers', $vouchers);
    }

    /**
     * Show the form for editing the specified Vouchers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vouchers = $this->vouchersRepository->find($id);

        if (empty($vouchers)) {
            return redirect(route('vouchers.index'));
        }

        return view('vouchers.edit')->with('vouchers', $vouchers);
    }

    /**
     * Update the specified Vouchers in storage.
     *
     * @param int $id
     * @param UpdateVouchersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVouchersRequest $request)
    {
        $vouchers = $this->vouchersRepository->find($id);

        if (empty($vouchers)) {
            return redirect(route('vouchers.index'));
        }

        $vouchers = $this->vouchersRepository->update($request->all(), $id);
        $this->logitem->iudRecord(4, $vouchers->getTable(), $vouchers->id);

        return redirect(route('vouchers.index'));
    }

    /**
     * Remove the specified Vouchers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vouchers = $this->vouchersRepository->find($id);

        if (empty($vouchers)) {
            return redirect(route('vouchers.index'));
        }

        $this->vouchersRepository->delete($id);
        $this->logitem->iudRecord(5, $vouchers->getTable(), $vouchers->id);

        return redirect(route('vouchers.index'));
    }

        /*
         * Dropdown for field select
         *
         * return array
         */
        public static function DDDW() : array
        {
            return [" "] + vouchers::orderBy('name')->pluck('name', 'id')->toArray();
        }
}



