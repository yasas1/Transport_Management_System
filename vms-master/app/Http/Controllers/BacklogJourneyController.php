<?php

namespace App\Http\Controllers;
use App\Models\Division;
use App\Models\Driver;
use App\Models\FundsAllocatedFrom;
use App\Models\Journey;
use App\Models\ExternalVehicle;
use App\Models\JourneyStatus;
use App\Models\Vehical;
use App\Models\Employee;
use Carbon\Carbon;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use function GuzzleHttp\Psr7\parse_header;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\CreateJourneyRequest;
use Session;
use View;

class BacklogJourneyController extends Controller
{
    
    public function createBacklog(){
        
        $divHeads = Division::all();
        $fundAlFroms = FundsAllocatedFrom::all();
        $drivers = Driver::all()->pluck('fullName','id');
        //$vehicles = Vehical::all()->pluck('fullName','id');
        $vehicles = Vehical::all();
        return view('journey.createBacklogJourney',compact('fundAlFroms','drivers','vehicles','divHeads'));
    
    }

    public function createAprrovedBacklog(){

        $userlogid = Auth::user()->emp_id; 

        $journeys = Journey::where('divisional_head_id','=',$userlogid)
                ->where('journey_status_id','=','8')->get();

        return view('journey.approveBacklog',compact('journeys'));
    
    }

    public function storeBacklog(Request $request){
        
        $this->validate($request , [
            'applicant_id' => 'required',
            'vehical_id' => 'required',
            'time_range' => 'required',
            'real_distance' => 'required',
            'divisional_head_id' => 'required',
            'purpose' => 'required', 
            'funds_allocated_from_id' => 'required',
        ]);
        
        $journey = new Journey;

        $journey->applicant_id = $request->applicant_id;
       
        if($request->vehical_id != 0){
            $journey->vehical_id = $request->vehical_id;
            if($request->driver_id == NULL){
                $vehicle = Vehical::whereId($request->vehical_id)->first();
                $journey->driver_id = $vehicle->driver->id;
            }
            else{
                $journey->driver_id = $request->driver_id;
            }
        }
        else{
            $journey->vehical_id = Null;
            $journey->driver_id = NULL;
        }

        $string=$request->time_range;
        $pos = strrpos($string, ' - ');
        $first = substr($string, 0, $pos);
        $second = substr($string, $pos + 3); 
        if($real_start_date_time = Carbon::parse($first)){
                $journey->real_start_date_time = $real_start_date_time;
        }
        if($real_end_date_time = Carbon::parse($second)){
            $journey->real_end_date_time = $real_end_date_time;
        }  

        $journey->purpose = $request->purpose;
        $journey->places_to_be_visited = $request->places_to_be_visited;
        $journey->number_of_persons = $request->number_of_persons;
        $journey->real_distance = $request->real_distance;

        //check long distance
        if($request->expected_distance>=150){
            $journey->is_long_distance = 1;
        }

        $journey->funds_allocated_from_id = $request->funds_allocated_from_id;
        $journey->divisional_head_id = $request->divisional_head_id;

        $journey->approved_by = $request->approved_by;

        if($request->approved_by != NULL){

            $approvedID = $request->approved_by;

                    /* Sending email -- send from webmaster email -- check after uploaded to sever */

            // $emailAddress = Employee::where('emp_id','=',$approvedID)->first()->emp_email.'@ucsc.cmb.ac.lk';

            $emailAddress= 'ranawaka.y@gmail.com'; // for testing

            // $msg= 'Place -  '.$journey->places_to_be_visited.'  Start -  '.$journey->real_start_date_time.'  End -  '.$journey->real_end_date_time.'  ';

            Mail::send(new ApprovedByMail($emailAddress,$msg));

            $journey->journey_status_id = '6';
            
        }
        else{
            $journey->journey_status_id = '8';
        }    

        //return $journey; 
        $journey->save();
        
        if($request->vehical_id == 0){
            
            $externalNew = new ExternalVehicle;       
            $externalNew->company_name = $request->company_name ;               
            $externalNew->cost = $request->cost ;                  
            $externalNew->journey_id = $journey->id;              
            $externalNew->save();

        }
        
        return redirect()->back()->with(['success'=>'Backlog Journey added successfully !']);
    }

    public function readBcaklogJourney(){ 
            // for creating Backlog journey calender view '
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.emp_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('journey_status_id','=','8')
        ->get();
        
        return response($journeys);
    }

    public function readExternalBacklog(){ 
            // for Backlog journey calender view External vehicle journeys' 
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.emp_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',NULL)->where('journey_status_id','=','8')
        ->get();
        
        return response($journeys);
    }

    public function ForCreateBacklogByVehicle(){ 
        $vid = $_GET['id'];
        //$journeys = Journey::journeyByVehicle($vid); 
        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.emp_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',$vid)->where('journey_status_id','=','8')
        ->get();
        return response($journeys);
    }

    public function approvalBacklog(Request $request, $id){

        // $this->validate($request , [
        //     'remarks' => 'required'
            
        // ]);    
        $userlogid = Auth::user()->emp_id; 

        if($journey = Journey::whereId($id)->first()){

            $journey->approved_at = Carbon::now();
            $journey->approved_by = $userlogid;
            $journey->approval_remarks = $request->remarks; 

            $journey->journey_status_id = '6';
            $journey->update();
            //return $journey;
            return redirect()->back()->with(['success'=>'Journey request approved successfully !']);
            
        }

    }

}
