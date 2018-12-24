<?php

namespace App\Http\Controllers;
use App\Models\Vehical;
use App\Models\Service;
use App\Models\Accident;
use App\Models\Driver;
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
            /* -------------- Service ------------------------- */

    public function viewAddServicing(){
        $vehicles = Vehical::all()->pluck('fullName','id');

        return view('vehicle.usage.servicing',compact('vehicles'));
    }

    public function serivceNotification(){
        
        //
       
    }

    public function storeServicing(Request $request){

        $request->validate([
            'vehical_id' => 'required',
            'date' => 'required',
            'meter_reading' => 'required',
            'details' => 'required',
            'cost' => 'required',
        ]);

        $service = new Service; 

        $service->vehical_id = $request->vehical_id;
        $service->date = $request->date;
        $service->meter_reading = $request->meter_reading;
        $service->details = $request->details;
        $service->cost = $request->cost;

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

        return view('vehicle.usageList.serviceList',compact('services'));
  
    }

    public function viewService(){

        $id = $_GET['id'];
        
        $service = DB::table('services')
        ->join('vehical', 'services.vehical_id', '=', 'vehical.id')
        ->select('services.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('services.id','=',$id)
        ->get();       
        

        return response($service); 

    }

    public function deleteService(Request $request){

        if($request->ajax() && $service = Service::find($request->id)){
                            
            $service->delete();

            Session::flash('success', 'Vehicle Servicing Deleted successfully !');
            return View::make('layouts/success');        
        }
        Session::flash('errors', 'Annual Licence Deleted Error !');
        return View::make('layouts/errors');

    }

    public function updateService(Request $request){
        if($request->ajax() && $service = Service::find($request->id)){ 
            
            $service->date = $request->date;
            $service->meter_reading = $request->meter_reading;
            $service->details = $request->details;
            $service->cost = $request->cost;

            $service->update();

            Session::flash('success', 'Vehicle Service Updated successfully !');
            return View::make('layouts/success');
        }

    }
    
            /* -------------- Annual Licence ------------------------- */

    public function viewAnnualLicences(){

        $vehicles = Vehical::all()->pluck('fullName','id');
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

        if($request->ajax() && $annualLicence = AnnualLicence::find($request->id)  ){
            
            if($licence_doc_id = $annualLicence->annual_licence_doc_id){
                // return $licence_doc_id;
                
                $oldlicence_file = $annualLicence->annualLicenceDoc->path;
                if(file_exists($oldlicence_file)){
                    unlink(public_path().'/'. $oldlicence_file);
                }

                $annualLicence->delete();

                $licence_doc = AnnualLicenceDoc::whereId($licence_doc_id)->first();
                $licence_doc->delete();

                Session::flash('success', 'Annual Licence Deleted successfully !');
                return View::make('layouts/success');

            }
                           
            
        }
        Session::flash('errors', 'Annual Licence Deleted Error !');
        return View::make('layouts/errors');
           
    }

    public function postTest(Request $request){
        
        $file_path = $request->input('file_path');  
        // return $file_path;
        return response()->download($file_path);       
    }

    public function viewAnnualLicenc(){

        $id = $_GET['id'];

        $annualLicence = AnnualLicence::find($id);

        if($annualLicence->annual_licence_doc_id == null){
            $licences = DB::table('annual_licences')
            ->join('vehical', 'annual_licences.vehical_id', '=', 'vehical.id') 
            ->select('annual_licences.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
            ->where('annual_licences.id','=',$id)
            ->get();       
        }
        else{
            $licences = DB::table('annual_licences')
            ->join('vehical', 'annual_licences.vehical_id', '=', 'vehical.id') 
            ->join('annual_licence_doc', 'annual_licences.annual_licence_doc_id', '=', 'annual_licence_doc.id') 
            ->select('annual_licences.*','annual_licence_doc.name as doc_name','annual_licence_doc.path as doc_path','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
            ->where('annual_licences.id','=',$id)
            ->get();
            
        }

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

                if ($request->hasFile('licence_file')) {

                    $licence_file = $request->file('licence_file');
                    $extension =  '.'.$licence_file->getClientOriginalExtension();
                    $oName = $licence_file->getClientOriginalName();
                    $name = md5($oName.Carbon::now()).$extension;
    
                    $path =  $licence_file->move('documents/licenceFile',$name);
    
                    if($annualLicence->annualLicenceDoc&&$licence_file = AnnualLicenceDoc::whereId($annualLicence->annualLicenceDoc->id)->first()){
                        $licence_file->name = $oName;
                        $licence_file->path = $path;
                        $licence_file->update();
                    }else{
                        $licence_file = new AnnualLicenceDoc;
                        $licence_file->path = $path;
                        $licence_file->name = $oName;
                        $licence_file->save();
                    }
    
    
                    if($annualLicence->annualLicenceDoc){
                        $oldlicence_file = $annualLicence->annualLicenceDoc->path;
                        if(file_exists($oldlicence_file)){
                            unlink(public_path().'/'. $oldlicence_file);
                        }
                    }
                    $annualLicence->annualLicenceDoc()->associate($licence_file);
                }
                

                $annualLicence->update(); 

                Session::flash('success', 'Annual Licence Updated successfully !');
                return View::make('layouts/success');

            }
        }
    }

            /* -------------- Accidents ------------------------- */

    public function viewVehicleAccidents(){

        $vehicles = Vehical::all()->pluck('fullName','id'); 
        $drivers = Driver::all()->pluck('fullName','id');

        return view('vehicle.usage.accidents',compact('vehicles','drivers'));

    }

    public function storeAccidents(Request $request){

        $request->validate([
            'vehical_id' => 'required',
            'date' => 'required',
            'place' => 'required',
            'description_of_damage' => 'required',
            'cost_of_repaire' => 'required',
            'action_taken_against_driver' => 'required',
            'driver_id' => 'required',
            
        ]);

        $accident = new Accident; 

        $accident->vehical_id = $request->vehical_id;
        $accident->date = $request->date;
        $accident->place = $request->place;
        $accident->description_of_damage = $request->description_of_damage;
        $accident->cost_of_repaire = $request->cost_of_repaire;
        $accident->date_of_recovery = $request->date_of_recovery;
        $accident->action_taken_against_driver = $request->action_taken_against_driver;
        $accident->police_station = $request->police_station;
        $accident->driver_id = $request->driver_id;

        $accident->save(); 

        return redirect()->back()->with(['success'=>'Vehicle Accident added successfully !']);
        

    }

    public function readVehicleAccidents(){

        $vid = $_GET['id'];

        $accidents = DB::table('accidents')
        ->join('vehical', 'accidents.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
        ->join('driver', 'accidents.driver_id', '=', 'driver.id') // join driver for get driver's name
        ->join('title', 'driver.title_id', '=', 'title.id') // join title for get driver's title
        ->select('accidents.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg','driver.firstname as firstname','driver.surname as surname','title.name as title')
        ->where('vehical_id','=',$vid)
        ->get();

        return view('vehicle.usageList.accidentList',compact('accidents'));
    }

    public function viewAccident(){

        $id = $_GET['id'];
        
        $accidents = DB::table('accidents')
        ->join('vehical', 'accidents.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
        ->join('driver', 'accidents.driver_id', '=', 'driver.id') // join driver for get driver's name
        ->join('title', 'driver.title_id', '=', 'title.id') // join title for get driver's title
        ->select('accidents.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg','driver.firstname as firstname','driver.surname as surname','title.name as title')
        ->where('accidents.id','=',$id)
        ->get();      
        

        return response($accidents);

    }


}
