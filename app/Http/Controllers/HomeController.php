<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchClientsRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\Country;

class HomeController extends Controller
{
    public function index()
    {
        $clients = Client::where('active', true)->get();
        $countries = Country::all();

        return view('home')->with(['clients' => $clients, 'countries' => $countries]);
    }

    public function search(SearchClientsRequest $request)
    {
        $search = $request->input('search');
        $countries = $request->input('countries', []);

        $clients = Client::with('country')
            ->search($search)
            ->filterByCountries($countries)
            ->get();

        return ClientResource::collection($clients);
    }
}
