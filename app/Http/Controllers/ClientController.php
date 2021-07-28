<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetClientsRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use App\Repositories\ClientRepositoryInterface;

class ClientController extends Controller
{

    private $clientRepository;

    public function __construct(ClientRepositoryInterface $repository)
    {

        $this->clientRepository = $repository;
    }

    public function index(GetClientsRequest $request)
    {
        $clients = $this->clientRepository->getAll($request->validated());
        return ClientResource::collection($clients);
    }

    public function store(StoreClientRequest $request)
    {
        $this->clientRepository->create($request->validated());
        return response()->noContent();
    }


}
