<?php

namespace App\Http\Controllers;
use App\Models\Vehical;
use App\Models\Service;
use App\Models\AnnualLicence;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function storeAnnualLicenc(Request $request){

        $request->validate([
            'vehical_id' => 'required',
            'from' => 'required',
            'to' => 'required',
            'licensing_authority' => 'required',
            'licence_no' => 'required',
            'licence_date' => 'required',
            'amount' => 'required',

        ]);

        //return $request;

        $annualLicence = new AnnualLicence; 

        $annualLicence->vehical_id = $request->vehical_id;
        $annualLicence->from = $request->from;
        $annualLicence->to = $request->to;
        $annualLicence->licensing_authority = $request->licensing_authority;
        $annualLicence->licence_no = $request->licence_no;
        $annualLicence->licence_date = $request->licence_date;
        $annualLicence->amount = $request->amount;
        

        $annualLicence->save(); 

        return redirect()->back()->with(['success'=>'Vehicle Annual Licence added successfully !']);

    }
  
    public function readAnnualLicenc(){

        $vid = $_GET['id'];

        $licences = DB::table('annual_licences')
        ->join('vehical', 'annual_licences.vehical_id', '=', 'vehical.id') 
        ->select('annual_licences.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('vehical_id','=',$vid)
        ->get();

        return view('vehicle.usageList.annLicenceList',compact('licences'));

        return response($services);   
     }

    public function deleteAnnualLicenc(Request $request){

        return response(['message'=>'Annual Licence delete successfull']);

        if($request->ajax()){

            //return $request->id;

           // AnnualLicence::destroy($request->id);
            return response(['message'=>'Annual Licence delete successfull']);

        }

           
     }


}
