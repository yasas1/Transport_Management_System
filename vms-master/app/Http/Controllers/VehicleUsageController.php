<?php

namespace App\Http\Controllers;
use App\Models\Vehical;
use App\Models\Service;
use App\Models\AnnualLicence;
use App\Models\AnnualLicenceDoc;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Session;
use View;

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
        $annualLicence->emission_test_details = $request->emission_test_details;

        if ($request->hasFile('licence_file')) {

            $licence_file = $request->file('licence_file');
            $extension =  '.'.$licence_file->getClientOriginalExtension();
            $oName = $licence_file->getClientOriginalName();
            $name = $request->registration_no.md5($oName.Carbon::now()).$extension;

            $path =  $licence_file->move('documents/licenceFile',$name);

            $licence_file = new AnnualLicenceDoc;
            $licence_file->path = $path;
            $licence_file->name = $oName;
            $licence_file->save();

            $annualLicence->annualLicenceDoc()->associate($licence_file);
        }

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
   
    }

    public function deleteAnnualLicenc(Request $request){

        if($request->ajax()){
            
            AnnualLicence::destroy($request->id);
            Session::flash('success', 'Annual Licence Deleted successfully !');
            return View::make('layouts/success');
        }
        Session::flash('errors', 'Annual Licence Deleted successfully !');
        return View::make('layouts/errors');
           
    }

    public function viewAnnualLicenc(){

        $id = $_GET['id'];

        $licences = DB::table('annual_licences')
        ->join('vehical', 'annual_licences.vehical_id', '=', 'vehical.id') 
        ->select('annual_licences.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('annual_licences.id','=',$id)
        ->get();

        return response($licences); 

    }

    public function updateAnnualLicenc(Request $request){
        if($request->ajax()){ 

            if($annualLicence = AnnualLicence::find($request->id)){

                $annualLicence->from = $request->from; 
                $annualLicence->to = $request->to;
                $annualLicence->licensing_authority = $request->licensing_authority;
                $annualLicence->licence_no = $request->licence_no;
                $annualLicence->licence_date = $request->licence_date;
                $annualLicence->amount = $request->amount;
                $annualLicence->emission_test_details = $request->emission_test_details;
                

                $annualLicence->update(); 

                Session::flash('success', 'Annual Licence Updated successfully !');
                return View::make('layouts/success');

            }
        }
    }


}
