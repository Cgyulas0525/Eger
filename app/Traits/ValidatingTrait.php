<?php

namespace App\Traits;

use Illuminate\Http\Request;
use DB;
use myUser;
use DataTables;

trait ValidatingTrait {

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

}
