<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{

    public function getAll($searchParams)
    {
        $sortParams = $searchParams['sortBy'] ?: ['id', 'DESC'];
        return Client::withQueryParams($searchParams)->orderBy($sortParams[0], $sortParams[1])->paginate(3);
    }

    public function create($newClient)
    {
        $client = Client::create($newClient);
        $client->users()->create($newClient['user']);
    }


}
