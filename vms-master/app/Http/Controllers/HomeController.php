<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehical;
use App\Models\Journey;
use App\Models\ExternalVehicle;

class HomeController extends Controller
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
    public function index()
    {
        $vehicles = Vehical::all();
        return view('home',compact('vehicles'));
    }
}
