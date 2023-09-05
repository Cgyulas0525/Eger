<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientsRequest;
use App\Http\Requests\UpdateClientsRequest;
use App\Repositories\ClientsRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Clients;
use App\Classes\LogitemClass;
use Illuminate\Http\Request;
use Response;
use DB;
use DataTables;
use myUser;

class ClientsController extends AppBaseController
{
    /** @var ClientsRepository $clientsRepository */
    private $clientsRepository;
    private $logitem;

    public function __construct(ClientsRepository $clientsRepo)
    {
        $this->clientsRepository = $clientsRepo;
        $this->logitem = new LogitemClass();
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';
                if ($row->validated == 0) {
                    $btn = $btn . '<a href="' . route('beforeValidation', [$row->id, 'Clients', 'clients']) . '"
                                         class="btn btn-danger btn-sm deleteProduct" title="Validálás"><i class="fas fa-user-edit"></i></a>';
                } else {
                    if ($row->active == 1) {
                        $btn = $btn . '<a href="' . route('clients.edit', [$row->id]) . '"
                                 class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="fa fa-paint-brush"></i></a>';
                        $btn = $btn . '<a href="' . route('beforeActivation', [$row->id, 'Clients', 'clients']) . '"
                                             class="btn btn-warning btn-sm deleteProduct" title="Deaktiválás"><i class="fas fa-user-check"></i></a>';
                    } else {
                        $btn = $btn . '<a href="' . route('beforeActivation', [$row->id, 'Clients', 'clients']) . '"
                                             class="btn btn-danger btn-sm deleteProduct" title="Aktiválás"><i class="fas fa-user-alt-slash"></i></a>';
                    }
                    $btn = $btn . '<a href="' . route('clientVouchers', [$row->id]) . '"
                                 class="edit btn btn-info btn-sm editProduct" title="Voucherek"><i class="fas fa-ticket-alt"></i></a>';
                    $btn = $btn . '<a href="' . route('clientQuestionnaries', [$row->id]) . '"
                                 class="edit btn btn-secondary btn-sm editProduct" title="Űrlapok"><i class="fas fa-question-circle"></i></a>';
                    $btn = $btn . '<a href="' . route('clientVouchers', [$row->id]) . '"
                                 class="edit btn btn-primary btn-sm editProduct" title="Sorsolások"><i class="fas fa-money-check-alt"></i></a>';
                }
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
        if (myUser::check()) {

            if ($request->ajax()) {

                $data = DB::table('clients as t1')
                    ->join('settlements as t3', 't3.id', '=', 't1.settlement_id')
                    ->select('t1.*', DB::raw('concat(t1.postcode, " ", t3.name, " ", t1.address) as fulladdress'), 't3.name as settlementName')
                    ->whereNull('t1.deleted_at')
                    ->where('t1.active', 1)
                    ->get();
                return $this->dwData($data, true);

            }

            return view('clients.index');
        }
    }

    public function clientsIndex(Request $request, $active = null, $validated = null, $local = null)
    {
        if (myUser::check()) {

            if ($request->ajax()) {

                $data = DB::table('clients as t1')
                    ->join('settlements as t3', 't3.id', '=', 't1.settlement_id')
                    ->select('t1.*', DB::raw('concat(t1.postcode, " ", t3.name, " ", t1.address) as fulladdress'), 't3.name as settlementName')
                    ->whereNull('t1.deleted_at')
                    ->where(function ($query) use ($active) {
                        if (is_null($active) || $active == -9999) {
                            $query->whereNotNull('t1.active');
                        } else {
                            $query->where('t1.active', '=', $active);
                        }
                    })
                    ->where(function ($query) use ($validated) {
                        if (is_null($validated) || $validated == 2) {
                            $query->whereNotNull('t1.validated');
                        } else {
                            $query->where('t1.validated', '=', $validated);
                        }
                    })
                    ->where(function ($query) use ($local) {
                        if (is_null($local) || $local == 2) {
                            $query->whereNotNull('t1.local');
                        } else {
                            $query->where('t1.local', '=', $local);
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
        $this->logitem->iudRecord(3, $clients->getTable(), $clients->id);

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
     * Show the form for editing the specified Client vouchers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function clientVouchers($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return redirect(route('clients.index'));
        }

        return view('clients.clientvouchers')->with('clients', $clients);
    }

    /**
     * Show the form for editing the specified Client questionnaries.
     *
     * @param int $id
     *
     * @return Response
     */
    public function clientQuestionnaries($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return redirect(route('clients.index'));
        }

        return view('clients.clientQuestionnaries')->with('clients', $clients);
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
        $this->logitem->iudRecord(4, $clients->getTable(), $clients->id);

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified Clients from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            return redirect(route('clients.index'));
        }

        $this->clientsRepository->delete($id);
        $this->logitem->iudRecord(5, $clients->getTable(), $clients->id);

        return redirect(route('clients.index'));
    }

    /*
     * Dropdown for field select
     *
     * return array
     */
    public static function DDDW(): array
    {
        return [" "] + clients::orderBy('name')->pluck('name', 'id')->toArray();
    }
}



