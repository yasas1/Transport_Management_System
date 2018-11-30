<?php

namespace App\Http\Controllers;
use App\Models\Vehical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleUsageController extends Controller
{

    public function index(){
        return view('vehicle.usage.index');
    }

    public function viewAddServicing(){
        $vehicles = Vehical::all()->pluck('fullName','id');
        return view('vehicle.usage.servicing',compact('vehicles'));
    }


}
