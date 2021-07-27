<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {


//        $map = \GoogleMaps::load('geocoding')
//            ->setEndpoint('json')
//            ->setParam(['address' => 'rock haven way',
//                'components' => [
//                    'administrative_area' => 'VA',
//                    'country' => 'US',
//                    'city' =>'Sterling',
//            ]
//            ])
//            ->get();
        $response = Cache::put('bar', 'baz', 200);
        $value = Cache::get('bar');
        $now = Carbon::now()->addDays(15);
        $testDatae = Cache::remember('sdfhg', $now, function () use ($now) {
            return ('sedfhb');
        });
//        dd(json_decode($map)->results[0]->geometry->location->lat);

        return $now;
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
