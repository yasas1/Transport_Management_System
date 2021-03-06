<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehical;
use App\Models\Journey;
use App\Models\ExternalVehicle;
use Illuminate\Support\Facades\DB;

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
        // $externalCount = ExternalVehicle::count();   
        // $v1Count = Journey::where(['vehical_id' => 2])->get()->count();
        // $v2Count = Journey::where(['vehical_id' => 3])->get()->count();
        // $v3Count = Journey::where(['vehical_id' => 4])->get()->count();
        return view('home',compact('vehicles'));
    }

    // public function chart()
    // {
        
    //     $journeyCount = DB::table('journey')
    //                 ->select('vehical_id', DB::raw('count(id) as total'))
    //                 ->groupBy('vehical_id')
    //                 ->get();
       
    //     return view('home',compact('journeyCount'));
    // }
}
