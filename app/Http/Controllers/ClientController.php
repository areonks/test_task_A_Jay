<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'end_validity' => Carbon::now()->addDays(14)
        ];

        $client = Client::create(array_merge($request->validated(), $additionalData));
        $client->users()->create($request->validated()['user']);
        return response()->noContent();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Client $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
