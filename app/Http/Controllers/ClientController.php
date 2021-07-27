<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetClientsRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{

    public function index(GetClientsRequest $request)
    {
        $sortParams = $request['sortBy'] ?: ['id', 'DESC'];
        return ClientResource::collection(Client::withQuseryParams($request)->orderBy($sortParams[0], $sortParams[1])->paginate(3));
    }


    public function store(StoreClientRequest $request)
    {
        $cacheKey = $request->zip . $request->address1 . $request->address2;
        $geocod = Cache::rememberForever($cacheKey, function () use ($request) {
            $geocod = \GoogleMaps::load('geocoding')
                ->setEndpoint('json')
                ->setParam(['address' => $request->address1 . $request->address2,
                    'components' => [
                        'administrative_area' => $request->state,
                        'country' => $request->country,
                        'city' => $request->city,
                    ]
                ])
                ->get();
            return json_decode($geocod)->results[0]->geometry->location;
        });

        $additionalData = [
            'latitude' => $geocod->lat,
            'longitude' => $geocod->lng,
            'start_validity' => Carbon::now(),
            'end_validity' => Carbon::now()->addDays(15)
        ];

        $client = Client::create(array_merge($request->validated(), $additionalData));
        $client->users()->create($request->validated()['user']);
        return response()->noContent();
    }


}
