<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehical;
use App\Models\Journey;
use App\Models\ExternalVehicle;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function map()
    {
        return view('map.map');
    }

    
}
