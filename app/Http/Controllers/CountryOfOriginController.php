<?php

namespace App\Http\Controllers;

use App\Models\CountryOfOrigin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryOfOriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country_of_origin = CountryOfOrigin::all();
        return response([
            'country_of_origins' => $country_of_origin->toArray(),
        ]);
    }
}
