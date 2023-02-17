<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientsRequest;
use App\Http\Requests\UpdateClientsRequest;
use App\Repositories\ClientsRepository;
use App\Http\Controllers\AppBaseController;

use App\Models\Clients;

use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class ClientsController extends AppBaseController
{
    /** @var ClientsRepository $clientsRepository*/
    private $clientsRepository;

    public function __construct(ClientsRepository $clientsRepo)
    {
        $this->clientsRepository = $clientsRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('clients.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
//                $btn = $btn.'<a href="' . route('beforeDestroys', ['Clients', $row["id"], 'clients']) . '"
//                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the Clients.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('clients as t1')
                    ->join('settlements as t3', 't3.id', '=', 't1.settlement_id')
                    ->select('t1.*', DB::raw('concat(t1.postcode, " ", t3.name, " ", t1.address) as fulladdress'), 't3.name as settlementName')
                    ->whereNull('t1.deleted_at')
                    ->where('t1.active', 1)
                    ->get();
                return $this->dwData($data);

            }

            return view('clients.index');
        }
    }

    public function clientsIndex(Request $request, $active = null)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('clients as t1')
                    ->join('settlements as t3', 't3.id', '=', 't1.settlement_id')
                    ->select('t1.*', DB::raw('concat(t1.postcode, " ", t3.name, " ", t1.address) as fulladdress'), 't3.name as settlementName')
                    ->whereNull('t1.deleted_at')
                    ->where( function($query) use ($active) {
                        if (is_null($active) || $active == -9999 ) {
                            $query->whereNotNull('t1.active');
                        } else {
                            $query->where('t1.active', '=', $active);
                        }
                    })
                    ->get();
                return $this->dwData($data);

            }

            return view('clients.index');
        }
    }

    /**
     * Show the form for creating a new Clients.
     *
     * @return Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created Clients in storage.
     *
     * @param CreateClientsRequest $request
     *
     * @return Response
     */
    public function store(CreateClientsRequest $request)
    {
        $input = $request->all();

        $clients = $this->clientsRepository->create($input);

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified Clients.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return redirect(route('clients.index'));
        }

        return view('clients.show')->with('clients', $clients);
    }

    /**
     * Show the form for editing the specified Clients.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return redirect(route('clients.index'));
        }

        return view('clients.edit')->with('clients', $clients);
    }

    /**
     * Update the specified Clients in storage.
     *
     * @param int $id
     * @param UpdateClientsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientsRequest $request)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return redirect(route('clients.index'));
        }

        $clients = $this->clientsRepository->update($request->all(), $id);

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified Clients from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return redirect(route('clients.index'));
        }

        $this->clientsRepository->delete($id);

        return redirect(route('clients.index'));
    }

        /*
         * Dropdown for field select
         *
         * return array
         */
        public static function DDDW() : array
        {
            return [" "] + clients::orderBy('name')->pluck('name', 'id')->toArray();
        }
}


