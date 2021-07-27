<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{

    public function getSearched($request)
    {
        $sortParams = $request['sortBy'] ?: ['id', 'DESC'];
        return Client::withQuseryParams($request)->orderBy($sortParams[0], $sortParams[1])->paginate(3);
    }

    public function post($request)
    {
        $client = Client::create($request);
        $client->users()->create($request['user']);
    }


}
