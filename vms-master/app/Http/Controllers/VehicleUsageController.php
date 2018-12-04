<?php

namespace App\Http\Controllers;
use App\Models\Vehical;
use App\Models\Service;

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

        $service = new Service; 

        $service->vehical_id = $request->vehical_id;
        $service->date = $request->date;
        $service->meter_reading = $request->meter_reading;

        $service->save(); 

        return redirect()->back()->with(['success'=>'Servicing added successfully !']);

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

    public function viewAnnualLicences(){

        $vehicles = Vehical::all()->pluck('fullName','id');
        return view('vehicle.usage.annualLicences',compact('vehicles'));
    }


}
