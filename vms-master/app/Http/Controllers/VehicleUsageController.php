<?php

namespace App\Http\Controllers;
use App\Models\Vehical;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VehicleUsageController extends Controller
{

    public function index(){
        return view('vehicle.usage.index');
    }

    public function viewAddServicing(){
        $vehicles = Vehical::all()->pluck('fullName','id');
        return view('vehicle.usage.servicing',compact('vehicles'));
    }

    public function storeServicing(Request $request){

       return $request;
    }

    public function readServicing(){

        $vid = $_GET['id'];

        $services = DB::table('services')
        ->join('vehical', 'services.vehical_id', '=', 'vehical.id')
        ->select('services.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('vehical_id','=',$vid)
        ->get();

        return response($services);

        
     }


}
