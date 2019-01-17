<?php

namespace App\Http\Controllers;
use App\Models\Vehical;
use App\Models\Service;
use App\Models\Accident; 
use App\Models\Division;
use App\Models\Repaire; 
use App\Models\TyreReplace;
use App\Models\TyrePositionChange;
use App\Models\VehicleMileage;
use App\Models\FuelUsage;
use App\Models\Driver; 
use App\Models\Journey;
use App\Models\AnnualLicence;
use App\Models\AnnualLicenceDoc;
use App\Models\TyreReplaceDoc;
use App\Models\EmissionTestDoc;
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
        $vehiclesNoti = Vehical::all();

        return view('vehicle.usage.servicing',compact('vehicles','vehiclesNoti'));
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
        // ->orderBy('services.date','DESC')
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

    public function serivceNotification(){
        
        // $services = DB::table('services')
        // ->select('services.date','services.vehical_id')
        // ->whereIn('id', function($query){
        //     $query->select(DB::raw('max(id) as id'))
        //         ->from('services')
        //         ->groupBy('services.vehical_id');
        // })->get();

        $services = DB::table('services')
            ->join('vehical', 'services.vehical_id', '=', 'vehical.id')
            ->select('services.date','services.vehical_id','vehical.mileage_service')
            ->orderBy('services.date', 'desc')
            ->get()
            ->unique('vehical_id');
            
        return response($services); 
       
    }

    public function distanceCount(){

        $vid = $_GET['vid']; 
        $date = $_GET['date'];

        $disCount = DB::table('journey')
            //->select(DB::raw("SUM(real_distance) as distance"))
            ->where('vehical_id','=',$vid)
            ->where('real_end_date_time','>=', $date)
            ->where('journey_status_id','=','6')->sum('real_distance');
            //->get(); 

        return response($disCount); 

    }
    
            /* -------------- Annual Licence ------------------------- */

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

        if ($request->hasFile('emission_file')) {

            $emission_file = $request->file('emission_file');
            $extension =  '.'.$emission_file->getClientOriginalExtension();
            $oName = $emission_file->getClientOriginalName();
            $name = $request->registration_no.md5($oName.Carbon::now()).$extension;

            $path =  $emission_file->move('documents/emissionFile',$name);

            $emission_file = new EmissionTestDoc;
            $emission_file->path = $path;
            $emission_file->name = $oName;
            $emission_file->save();

            $annualLicence->emissionTestDoc()->associate($emission_file);
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
        ->orderBy('annual_licences.licence_date','DESC')
        ->get();

        return view('vehicle.usageList.annLicenceList',compact('licences'));
   
    }

    public function deleteAnnualLicenc(Request $request){

        if($request->ajax() && $annualLicence = AnnualLicence::find($request->id)  ){

            $annualLicence->delete();
            
                /* Deleting annual licence document */
            if($licence_doc_id = $annualLicence->annual_licence_doc_id){
                         
                $oldlicence_file = $annualLicence->annualLicenceDoc->path;
                
                if( file_exists(public_path($oldlicence_file)) ){
                    unlink(public_path().'/'. $oldlicence_file);
                }

                $licence_doc = AnnualLicenceDoc::whereId($licence_doc_id)->first();
                $licence_doc->delete();

            
            }

                /* Deleting emission test details document */
            if($emission_doc_id = $annualLicence->emission_test_doc_id){
                          
                $oldemission_file = $annualLicence->emissionTestDoc->path;
                if(file_exists($oldemission_file)){
                    unlink(public_path().'/'. $oldemission_file);
                }

                $emission_doc = EmissionTestDoc::whereId($emission_doc_id)->first();
                $emission_doc->delete();
        
            }
             
           

            Session::flash('success', 'Annual Licence Deleted successfully !');
            return View::make('layouts/success');
            
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

        if($annualLicence->annual_licence_doc_id == null && $annualLicence->emission_test_doc_id == null ){
            $licences = DB::table('annual_licences')
            ->join('vehical', 'annual_licences.vehical_id', '=', 'vehical.id') 
            ->select('annual_licences.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
            ->where('annual_licences.id','=',$id)
            ->get();       
        }
        else  if($annualLicence->annual_licence_doc_id != null && $annualLicence->emission_test_doc_id == null){
            $licences = DB::table('annual_licences')
            ->join('vehical', 'annual_licences.vehical_id', '=', 'vehical.id') 
            ->join('annual_licence_doc', 'annual_licences.annual_licence_doc_id', '=', 'annual_licence_doc.id') 
            ->select('annual_licences.*','annual_licence_doc.name as doc_name','annual_licence_doc.path as doc_path','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
            ->where('annual_licences.id','=',$id)
            ->get();    
        }
        else  if($annualLicence->emission_test_doc_id != null && $annualLicence->annual_licence_doc_id == null){
            $licences = DB::table('annual_licences')
            ->join('vehical', 'annual_licences.vehical_id', '=', 'vehical.id') 
            ->join('emission_test_doc', 'annual_licences.emission_test_doc_id', '=', 'emission_test_doc.id') 
            ->select('annual_licences.*','emission_test_doc.name as emi_doc_name','emission_test_doc.path as emi_doc_path','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
            ->where('annual_licences.id','=',$id)
            ->get();    
        }
        else{
            $licences = DB::table('annual_licences')
            ->join('vehical', 'annual_licences.vehical_id', '=', 'vehical.id') 
            ->join('annual_licence_doc', 'annual_licences.annual_licence_doc_id', '=', 'annual_licence_doc.id') 
            ->join('emission_test_doc', 'annual_licences.emission_test_doc_id', '=', 'emission_test_doc.id') 
            ->select('annual_licences.*','annual_licence_doc.name as doc_name','annual_licence_doc.path as doc_path','emission_test_doc.name as emi_doc_name','emission_test_doc.path as emi_doc_path','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
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

                if ($request->hasFile('emission_file')) {

                    $emission_file = $request->file('emission_file');
                    $extension =  '.'.$emission_file->getClientOriginalExtension();
                    $oName = $emission_file->getClientOriginalName();
                    $name = md5($oName.Carbon::now()).$extension;
    
                    $path =  $emission_file->move('documents/emissionFile',$name);
    
                    if($annualLicence->emissionTestDoc && $emission_file = EmissionTestDoc::whereId($annualLicence->emissionTestDoc->id)->first()){
                        $emission_file->name = $oName;
                        $emission_file->path = $path;
                        $emission_file->update();
                    }else{
                        $emission_file = new EmissionTestDoc;
                        $emission_file->path = $path;
                        $emission_file->name = $oName;
                        $emission_file->save();
                    }
    
    
                    if($annualLicence->emissionTestDoc){
                        $oldEmission_file = $annualLicence->emissionTestDoc->path;
                        if(file_exists($oldEmission_file)){
                            unlink(public_path().'/'. $oldEmission_file);
                        }
                    }
                    $annualLicence->emissionTestDoc()->associate($emission_file);
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
            'driver_id' => 'required',
            
        ]);

        $accident = new Accident; 

        $accident->vehical_id = $request->vehical_id;
        $accident->date = $request->date;
        $accident->place = $request->place;
        $accident->description_of_damage_and_remarks = $request->description_of_damage_and_remarks;
        $accident->cost_of_repaire = $request->cost_of_repaire;
        $accident->date_of_recovery = $request->date_of_recovery;
        $accident->description_of_accident = $request->description_of_accident;
        $accident->details_of_police_station = $request->police_station;
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
        ->orderBy('accidents.date','DESC')
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

    public function deleteAccident(Request $request){

        if($request->ajax() && $accident = Accident::find($request->id)  ){

            $accident->delete();

            Session::flash('success', 'Vehicle Accident Deleted successfully !');
            return View::make('layouts/success');

        }
        Session::flash('errors', 'Vehicle Accident Deleted Error !');
        return View::make('layouts/errors');
    }
    
    public function updateAccident(Request $request){       

        if($request->ajax() && $accident = Accident::find($request->id)){ 

            $accident->date = $request->date;
            $accident->place = $request->place;
            $accident->description_of_damage = $request->description_of_damage;
            $accident->cost_of_repaire = $request->cost_of_repaire;
            $accident->date_of_recovery = $request->date_of_recovery;
            $accident->action_taken_against_driver = $request->action_taken_against_driver;
            $accident->police_station = $request->police_station;
            $accident->driver_id = $request->driver_id;

            $accident->update();

            Session::flash('success', 'Vehicle Accident Updated successfully !');
            return View::make('layouts/success');
        }
        Session::flash('errors', 'Vehicle Acciden Updating Error !');
        return View::make('layouts/errors');
    }

            /*----------------- Repaires ------------------------- */
    
    public function viewRepairsPage(){

        $vehicles = Vehical::all()->pluck('fullName','id'); 
        $divHeads = Division::all();

        return view('vehicle.usage.repairs',compact('vehicles','divHeads'));

    }

    public function storeRepairs(Request $request){  

        $request->validate([
            'vehical_id' => 'required',
            'workshop_in_date' => 'required',
            'meter_reading_out' => 'required',
            'executed_at' => 'required',
            'authorized_by' => 'required',
            'invoice_no' => 'required',
            'invoice_date' => 'required',
            
        ]);

        //return $request->authorized_by;

        $repaire = new Repaire; 

        $repaire->vehical_id = $request->vehical_id;
        $repaire->workshop_in_date = $request->workshop_in_date;
        $repaire->workshop_out_date = $request->workshop_out_date;
        $repaire->meter_reading_in = $request->meter_reading_in;
        $repaire->meter_reading_out = $request->meter_reading_out;
        $repaire->works_and_parts = $request->works_and_parts;
        $repaire->invoice_no = $request->invoice_no;
        $repaire->invoice_date = $request->invoice_date;
        $repaire->authorized_by = $request->authorized_by;
        $repaire->executed_at = $request->executed_at;
        $repaire->cost = $request->cost;

        $repaire->save(); 

        return redirect()->back()->with(['success'=>'Vehicle Repair added successfully !']);
    }

    public function readVehicleRepairs(){

        $vid = $_GET['id'];

        $repaires = DB::table('repaires')
        ->join('vehical', 'repaires.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
        ->select('repaires.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('vehical_id','=',$vid)
        ->orderBy('repaires.workshop_in_date','DESC')
        ->get();

        return view('vehicle.usageList.repairList',compact('repaires'));
    } 

    public function viewRepair(){

        $id = $_GET['id'];
        
        $repaire = DB::table('repaires')
        ->join('vehical', 'repaires.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
        ->select('repaires.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('repaires.id','=',$id)
        ->get();      
        

        return response($repaire);

    }

    public function deleteRepaire(Request $request){

        if($request->ajax() && $repaire = Repaire::find($request->id)  ){

            $repaire->delete();

            Session::flash('success', 'Vehicle Repaire Deleted successfully !');
            return View::make('layouts/success');

        }
        Session::flash('errors', 'Vehicle Repaire Deleted Error !');
        return View::make('layouts/errors');
    }

    public function updateRepair(Request $request){

        if($request->ajax() && $repaire = Repaire::find($request->id)){ 

            $repaire->workshop_in_date = $request->workshop_in_date;
            $repaire->workshop_out_date = $request->workshop_out_date;
            $repaire->meter_reading_in = $request->meter_reading_in;
            $repaire->meter_reading_out = $request->meter_reading_out;
            $repaire->works_and_parts = $request->works_and_parts;
            $repaire->invoice_no = $request->invoice_no;
            $repaire->invoice_date = $request->invoice_date;
            $repaire->authorized_by = $request->authorized_by;
            $repaire->executed_at = $request->executed_at;
            $repaire->cost = $request->cost;

            $repaire->update();

            Session::flash('success', 'Vehicle Repair Updated successfully !');
            return View::make('layouts/success');
        }
        Session::flash('errors', 'Vehicle Repaire Updating Error !');
        return View::make('layouts/errors');

    }

            /* ----------------- Tyres ------------------------- */
    
    public function viewTyresPage(){

        $vehicles = Vehical::all()->pluck('fullName','id'); 

        return view('vehicle.usage.tyres',compact('vehicles'));

    }

    public function storeTyreReplacement(Request $request){  

        $request->validate([
            'vehical_id' => 'required',
            'position' => 'required',
            'date' => 'required'
        ]);

        $tyreReplace = new TyreReplace; 

        $tyreReplace->vehical_id = $request->vehical_id;
        $tyreReplace->date = $request->date;
        $tyreReplace->position = $request->position;
        $tyreReplace->size = $request->size;
        $tyreReplace->type = $request->type;
        $tyreReplace->meter_reading = $request->meter_reading;
        $tyreReplace->cost = $request->cost;
        $tyreReplace->invoice = $request->invoice;
        $tyreReplace->remarks = $request->remarks;

        if ($request->hasFile('invoice_file')) {

            $invoice_file = $request->file('invoice_file');
            $extension =  '.'.$invoice_file->getClientOriginalExtension();
            $oName = $invoice_file->getClientOriginalName();
            $name = $request->registration_no.md5($oName.Carbon::now()).$extension;

            $path =  $invoice_file->move('documents/tyreInvoiceFile',$name);

            $invoice_file = new TyreReplaceDoc;
            $invoice_file->path = $path;
            $invoice_file->name = $oName;
            $invoice_file->save();

            $tyreReplace->tyreReplaceDoc()->associate($invoice_file);
        }
       
        $tyreReplace->save(); 

        return redirect()->back()->with(['success'=>'Tyre Replacement Added Successfully !']);
    }

    public function storeTyrePositionChange(Request $request){  

        $request->validate([
            'vehical_id' => 'required',
            'position_one_pre' => 'required',
            'position_one_after' => 'required',
            'position_two_pre' => 'required',
            'position_two_after' => 'required',
            'date' => 'required'
        ]);

        $tyrePositionChange = new TyrePositionChange; 

        $tyrePositionChange->vehical_id = $request->vehical_id;
        $tyrePositionChange->date = $request->date;
        $tyrePositionChange->position_one_pre = $request->position_one_pre;       
        $tyrePositionChange->position_one_after = $request->position_one_after;  
        $tyrePositionChange->position_two_pre = $request->position_two_pre;       
        $tyrePositionChange->position_two_after = $request->position_two_after;  
        $tyrePositionChange->meter_reading = $request->meter_reading;
        $tyrePositionChange->remarks = $request->remarks;
       
        $tyrePositionChange->save(); 

        return redirect()->back()->with(['success'=>'Tyre Position Changing Added Successfully !']);
    }

    public function readTyreReplacement(){

        $vid = $_GET['id'];

        $tyreReplaces = DB::table('tyre_replaces')
        ->join('vehical', 'tyre_replaces.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
        ->select('tyre_replaces.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('vehical_id','=',$vid)
        ->orderBy('tyre_replaces.date','DESC')
        ->get();

        return view('vehicle.usageList.tyreReplaceList',compact('tyreReplaces'));
    }

    public function vehicleTyreDetails(){
        $vid = $_GET['id'];

        $tyreDetails = DB::table('vehical')
        ->select('tyres_size_front')
        ->where('id','=',$vid)
        ->get();

        return response($tyreDetails);
    }

    public function readTyrePositionChanges(){

        $vid = $_GET['id'];

        $tyrePositionChanges = DB::table('tyre_position_changes')
        ->join('vehical', 'tyre_position_changes.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
        ->select('tyre_position_changes.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('vehical_id','=',$vid)
        ->orderBy('tyre_position_changes.date','DESC')
        ->get();

        return view('vehicle.usageList.tyrePositionChangeList',compact('tyrePositionChanges'));
    }

    public function viewTyreReplacement(){

        $id = $_GET['id'];
         
        $tyreReplace = TyreReplace::find($id);
        
        if($tyreReplace->tyre_replace_doc_id == null){
            $tyreReplaces = DB::table('tyre_replaces')
            ->join('vehical', 'tyre_replaces.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
            ->select('tyre_replaces.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
            ->where('tyre_replaces.id','=',$id)
            ->get();      
        }
        else{
            $tyreReplaces = DB::table('tyre_replaces')
            ->join('vehical', 'tyre_replaces.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
            ->join('tyre_replaces_doc', 'tyre_replaces.tyre_replace_doc_id', '=', 'tyre_replaces_doc.id') 
            ->select('tyre_replaces.*','tyre_replaces_doc.name as doc_name','tyre_replaces_doc.path as doc_path','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
            ->where('tyre_replaces.id','=',$id)
            ->get(); 
        }
        
        return response($tyreReplaces);

    }

    public function updateTyreReplacement(Request $request){

        if($request->ajax() && $tyreReplace = TyreReplace::find($request->id)){ 

            $tyreReplace->date = $request->date;
            $tyreReplace->position = $request->position;
            $tyreReplace->size = $request->size;
            $tyreReplace->type = $request->type;
            $tyreReplace->meter_reading = $request->meter_reading;
            $tyreReplace->cost = $request->cost;
            $tyreReplace->invoice = $request->invoice;
            $tyreReplace->remarks = $request->remarks;

            if ($request->hasFile('invoice_file')) {

                $invoice_file = $request->file('invoice_file');
                $extension =  '.'.$invoice_file->getClientOriginalExtension();
                $oName = $invoice_file->getClientOriginalName();
                $name = md5($oName.Carbon::now()).$extension;

                $path =  $invoice_file->move('documents/tyreInvoiceFile',$name);

                if($tyreReplace->tyreReplaceDoc && $invoice_file = TyreReplaceDoc::whereId($tyreReplace->tyreReplaceDoc->id)->first()){
                    $invoice_file->name = $oName;
                    $invoice_file->path = $path;
                    $invoice_file->update();
                }else{
                    $invoice_file = new TyreReplaceDoc;
                    $invoice_file->path = $path;
                    $invoice_file->name = $oName;
                    $invoice_file->save();
                }


                if($tyreReplace->tyreReplaceDoc){
                    $oldinvoice_file = $tyreReplace->tyreReplaceDoc->path;
                    if(file_exists($oldinvoice_file)){
                        unlink(public_path().'/'. $oldinvoice_file);
                    }
                }
                $tyreReplace->tyreReplaceDoc()->associate($invoice_file);
            }

            $tyreReplace->update();

            Session::flash('success', 'Vehicle Tyre Replacement Updated successfully !');
            return View::make('layouts/success');
        }
        Session::flash('errors', 'Vehicle Tyre Replacement Updating Error !');
        return View::make('layouts/errors');

    }

    public function viewTyrePositionChange(){

        $id = $_GET['id'];
        
        $tyreReplaces = DB::table('tyre_position_changes')
        ->join('vehical', 'tyre_position_changes.vehical_id', '=', 'vehical.id') // join vehicle for get vehicle name
        ->select('tyre_position_changes.*','vehical.name as vehicle_name', 'vehical.registration_no as vehicle_reg')
        ->where('tyre_position_changes.id','=',$id)
        ->get();      
        

        return response($tyreReplaces);

    }

    public function updateTyrePositionChange(Request $request){

        if($request->ajax() && $tyrePositionChange = TyrePositionChange::find($request->id)){ 

            $tyrePositionChange->date = $request->date;
            $tyrePositionChange->position_one_pre = $request->position_one_pre;       
            $tyrePositionChange->position_one_after = $request->position_one_after;  
            $tyrePositionChange->position_two_pre = $request->position_two_pre;       
            $tyrePositionChange->position_two_after = $request->position_two_after;      
            $tyrePositionChange->meter_reading = $request->meter_reading;
            $tyrePositionChange->remarks = $request->remarks;

            $tyrePositionChange->update();

            Session::flash('success', 'Vehicle Tyre Position Changing Updated successfully !');
            return View::make('layouts/success');
        }
        Session::flash('errors', 'Vehicle Tyre Position Changing Updating Error !');
        return View::make('layouts/errors');

    }

    public function deleteTyreReplacement(Request $request){

        if($request->ajax() && $tyreReplace = TyreReplace::find($request->id)  ){

            $tyreReplace->delete();

            if($invoice_doc_id = $tyreReplace->tyre_replace_doc_id){
                         
                $oldinvoice_file = $tyreReplace->tyreReplaceDoc->path;
                
                if( file_exists(public_path($oldinvoice_file)) ){
                    unlink(public_path().'/'. $oldinvoice_file);
                }

                $invoice_doc = TyreReplaceDoc::whereId($invoice_doc_id)->first();
                $invoice_doc->delete();

            }

            Session::flash('success', 'Vehicle Tyre Replacement Deleted successfully !');
            return View::make('layouts/success');

        }
        Session::flash('errors', 'Vehicle Tyre Replacement Deleted Error !');
        return View::make('layouts/errors');
    }

    public function deleteTyrePositionChange(Request $request){

        if($request->ajax() && $tyrePositionChange = TyrePositionChange::find($request->id)  ){

            $tyrePositionChange->delete();

            Session::flash('success', 'Vehicle Tyre Position Changing Deleted successfully !');
            return View::make('layouts/success');

        }
        Session::flash('errors', 'Vehicle Tyre Position Changing Deleted Error !');
        return View::make('layouts/errors');
    }

    /* ----------------- Fuel Usage ------------------------- */

    public function viewFuelPage(){

        $vehicles = Vehical::all()->pluck('fullName','id'); 

        return view('vehicle.usage.fuelUsage',compact('vehicles'));

    }

    public function storeFuelUsage(Request $request){  

        $request->validate([
            'vehical_id' => 'required',
            'date' => 'required',
            'meter_reading' => 'required',
            'fuel_liter' => 'required',
            'cost' => 'required',
            
        ]);

        $fuelUsage = new FuelUsage; 

        $fuelUsage->vehical_id = $request->vehical_id;
        $fuelUsage->date = $request->date;
        $fuelUsage->meter_reading = $request->meter_reading;
        $fuelUsage->fuel_liter = $request->fuel_liter;
        $fuelUsage->cost = $request->cost;       

        $fuelUsage->save(); 

        return redirect()->back()->with(['success'=>'Vehicle Fuel Usage added successfully !']);
    }

    // public function getVehicleMileage(){

    //     $vid = $_GET['vid'];
    //     $date = $_GET['date'];

    //     $tyreReplaces = DB::table('vehicle_mileage')
    //     ->select('vehicle_mileage.kilometer_per_liter','vehicle_mileage.mileage')
    //     ->where('vehicle_mileage.vehical_id','=',$vid)
    //     ->where('vehicle_mileage.date','=',$date)
    //     ->get();      
        
    //     return response($tyreReplaces);

    // }

    /* ----------------- Vehicle Mileage ------------------------- */

    public function viewMileagePage(){

        $vehicles = Vehical::all()->pluck('fullName','id'); 

        return view('vehicle.usage.vehicleMileage',compact('vehicles'));

    }

    public function storeVehicleMileage(Request $request){  

        $request->validate([
            'vehical_id' => 'required',
            'date' => 'required',
            'meter_reading_day_begin' => 'required',
            'meter_reading_day_end' => 'required',
            
        ]);

        $vehicleMileage = new VehicleMileage; 

        $vehicleMileage->vehical_id = $request->vehical_id;
        $vehicleMileage->date = $request->date;
        $vehicleMileage->meter_reading_day_begin = $request->meter_reading_day_begin;
        $vehicleMileage->meter_reading_day_end = $request->meter_reading_day_end;
        $vehicleMileage->meter_reading_mileage = $request->meter_reading_mileage;
        $vehicleMileage->journey_mileage = $request->journey_mileage; 
        $vehicleMileage->remarks = $request->remarks;
        

        $vehicleMileage->save(); 

        return redirect()->back()->with(['success'=>'Vehicle Mileage added successfully !']);
    }

}
