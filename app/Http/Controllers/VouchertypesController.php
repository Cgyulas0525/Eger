<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVouchertypesRequest;
use App\Http\Requests\UpdateVouchertypesRequest;
use App\Repositories\VouchertypesRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Vouchertypes;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use myUser;
use App\Classes\LogitemClass;
use App\Enums\YesNoAllEnum;

class VouchertypesController extends AppBaseController
{
    /** @var VouchertypesRepository $vouchertypesRepository*/
    private $vouchertypesRepository;
    private $logitem;

    public function __construct(VouchertypesRepository $vouchertypesRepo)
    {
        $this->vouchertypesRepository = $vouchertypesRepo;
        $this->logitem = new LogitemClass();
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('localName', function ($data) {
                return (YesNoAllEnum::getWithCode($data->local));
            })
            ->addColumn('localFundName', function ($data) {
                return (YesNoAllEnum::getWithCode($data->localfund));
            })
            ->addColumn('localReplayName', function ($data) {
                return (YesNoAllEnum::getWithCode($data->localreplay));
            })
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('vouchertypes.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                $btn = $btn.'<a href="' . route('beforeDestroys', ['Vouchertypes', $row->id, 'vouchertypes']) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Vouchertypes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( myUser::check() ){

            if ($request->ajax()) {

                $data = DB::table('vouchertypes as t1')
                        ->select('t1.*')
                        ->whereNull('t1.deleted_at')
                        ->get();
                return $this->dwData($data);

            }

            return view('vouchertypes.index');
        }
    }

    /**
     * Display a listing of the Vouchertypes.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function vouchertypesIndex(Request $request, $local = null)
    {
        if( myUser::check() ){

            if ($request->ajax()) {

                $data = DB::table('vouchertypes as t1')
                        ->select('t1.*')
                        ->whereNull('t1.deleted_at')
                        ->where( function($query) use ($local) {
                            if (is_null($local) || $local == 2 ) {
                                $query->whereNotNull('t1.local');
                            } else {
                                $query->where('t1.local', '=', $local);
                            }
                        })
                        ->get();
                return $this->dwData($data);

            }

            return view('vouchertypes.index');
        }
    }

    /**
     * Show the form for creating a new Vouchertypes.
     *
     * @return Response
     */
    public function create()
    {
        return view('vouchertypes.create');
    }

    /**
     * Store a newly created Vouchertypes in storage.
     *
     * @param CreateVouchertypesRequest $request
     *
     * @return Response
     */
    public function store(CreateVouchertypesRequest $request)
    {
        $input = $request->all();

        $vouchertypes = $this->vouchertypesRepository->create($input);
        $this->logitem->iudRecord(3, $vouchertypes->getTable(), $vouchertypes->id);

        return redirect(route('vouchertypes.index'));
    }

    /**
     * Display the specified Vouchertypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vouchertypes = $this->vouchertypesRepository->find($id);

        if (empty($vouchertypes)) {
            return redirect(route('vouchertypes.index'));
        }

        return view('vouchertypes.show')->with('vouchertypes', $vouchertypes);
    }

    /**
     * Show the form for editing the specified Vouchertypes.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vouchertypes = $this->vouchertypesRepository->find($id);

        if (empty($vouchertypes)) {
            return redirect(route('vouchertypes.index'));
        }

        return view('vouchertypes.edit')->with('vouchertypes', $vouchertypes);
    }

    /**
     * Update the specified Vouchertypes in storage.
     *
     * @param int $id
     * @param UpdateVouchertypesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVouchertypesRequest $request)
    {
        $vouchertypes = $this->vouchertypesRepository->find($id);

        if (empty($vouchertypes)) {
            return redirect(route('vouchertypes.index'));
        }

        $vouchertypes = $this->vouchertypesRepository->update($request->all(), $id);
        $this->logitem->iudRecord(4, $vouchertypes->getTable(), $vouchertypes->id);

        return redirect(route('vouchertypes.index'));
    }

    /**
     * Remove the specified Vouchertypes from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vouchertypes = $this->vouchertypesRepository->find($id);

        if (empty($vouchertypes)) {
            return redirect(route('vouchertypes.index'));
        }

        $this->vouchertypesRepository->delete($id);
        $this->logitem->iudRecord(5, $vouchertypes->getTable(), $vouchertypes->id);

        return redirect(route('vouchertypes.index'));
    }

        /*
         * Dropdown for field select
         *
         * return array
         */
        public static function DDDW() : array
        {
            return [" "] + vouchertypes::orderBy('name')->pluck('name', 'id')->toArray();
        }
}



