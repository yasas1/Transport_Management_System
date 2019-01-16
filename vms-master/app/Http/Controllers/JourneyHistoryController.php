<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Session;
use View;
use function GuzzleHttp\Psr7\parse_header;
use App\Models\Division;
use App\Models\Driver;
use App\Models\FundsAllocatedFrom;
use App\Models\Journey;
use App\Models\ExternalVehicle;
use App\Models\JourneyStatus;
use App\Models\Vehical;
use App\Models\Employee;

class JourneyHistoryController extends Controller
{
    public function index()
    {
        if(Auth::user()->canViewMyJourneys()){

            $userid = Auth::user()->emp_id;
        
            $journeys = Journey::where('applicant_id','=',$userid)->get();

            //return $journeys;

            $vehicles = Vehical::all(); // for vehicle color button {delete}
            return view('journey.MyJourney',compact('journeys','vehicles'));

        }
        return redirect('home');
        
    }

    public function readMyJourney(){
            // for Completed journey calender view URL -> /journey/readCompleted
        //$journeys = Journey::completed();

        $userid = Auth::user()->emp_id;

        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('applicant_id','=',$userid)
        ->get();
        return response($journeys);
        
    
    }

    public function myJourneyByVehicle(){ 
        $vid = $_GET['id'];
        //$journeys = Journey::journeyByVehicleCompleted($vid); 

        $userid = Auth::user()->emp_id;

        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',$vid)->where('applicant_id','=',$userid)
        ->get();
        return response($journeys);
        
    }

    public function myJourneyExternal(){ 

        $userid = Auth::user()->emp_id;

        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.r_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',NULL)->where('applicant_id','=',$userid)
        ->get();
      
        return response($journeys);
        
  }

    public function clickMyJourneys(){

        $id = $_GET['id'];
      
        $journey = Journey::whereId($id)->first();

        if($journey->vehical_id==NULL){
            $vehicle_num = "External";
            $vehicle_name = NULL;
            $driver = "External";
            $driver_completed = NULL;
            $external = $journey->externalVehicle;
        }
        else{
            $vehicle_num = $journey->vehical->registration_no;
            $vehicle_name = $journey->vehical->name;
            $driver = $journey->driver->getFullNameAttribute();       
            $external = NULL;
            if($journey->driver_completed_at==NULL){
                $driver_completed = NULL;
            }
            else{
                $driver_completed = $journey->driver_completed_at->toDayDateTimeString();
            }
        }

        $applicant_name = $journey->applicant->getFullNameAttribute();
        $applicant_dept = $journey->applicant->division->dept_name;
        $applicant_email = $journey->applicant->emp_email;

        $devisional_head = $journey->divisional_head->getFullNameAttribute();

        // if($journey->approved_by==NULL){
        //     $approved_by = NULL;
        //     $approved_at = NULL;
        // }
        // else{
        //     $approved_by = $journey->approvedBy->getFullNameAttribute();
        //     if($journey->approved_at==NULL){
        //         $approved_at = NULL;
        //     }
        //     else{
        //         $approved_at = $journey->approved_at->toDayDateTimeString();
        //     }
            
        // }

        // if($journey->expected_start_date_time==NULL){
        //     $exp_start = NULL;
        //     $exp_end = NULL;
        // }
        // else{
        //     $exp_start = $journey->expected_start_date_time->toDayDateTimeString();
        //     $exp_end = $journey->expected_end_date_time->toDayDateTimeString();
  
        // }

        // if($journey->real_start_date_time==NULL){
        //     $real_start = NULL;
        //     $real_end = NULL;
        // }
        // else{
        //     $real_start = $journey->real_start_date_time->toDayDateTimeString(); 
        //     $real_end = $journey->real_end_date_time->toDayDateTimeString();
  
        // }   
        
        $data = json_encode(array(
            $journey , $vehicle_num ,$vehicle_name ,$driver ,$applicant_name , $applicant_dept, $applicant_email,
            $devisional_head,
            
        ));
        return response($data);
        
    }
}
