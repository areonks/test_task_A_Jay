<?php

namespace App\Repositories;

use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{

    public function getAll($searchParams)
    {
        $sortParams[0] = array_key_exists('sort_field', $searchParams) ? $searchParams['sort_field'] : 'id';
        $sortParams[1] = array_key_exists('sort_order', $searchParams) ? $searchParams['sort_order'] : 'DESC';

        return Client::withQueryParams($searchParams)->orderBy($sortParams[0], $sortParams[1])->paginate(3);
    }

    public function create($newClient)
    {
        $client = Client::create($newClient);
        $client->users()->create($newClient['user']);
    }


}
