<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        
        $userid = Auth::user()->emp_id;
        
        $journeys = Journey::where('applicant_id','=',$userid)->get();

        //return $journeys;

        $vehicles = Vehical::all(); // for vehicle color button {delete}
        return view('journey.MyJourney',compact('journeys','vehicles'));
        
    }

    public function readMyJourney(){
            // for Completed journey calender view URL -> /journey/readCompleted
        //$journeys = Journey::completed();

        $userid = Auth::user()->emp_id;

        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.emp_id')
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
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.emp_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',$vid)->where('applicant_id','=',$userid)
        ->get();
        return response($journeys);
        
    }

    

    public function myJourneyExternal(){ 

        $userid = Auth::user()->emp_id;

        $journeys = DB::table('journey')
        ->join('employee.employee as db2', 'journey.applicant_id', '=', 'db2.emp_id')
        ->join('journey_status', 'journey.journey_status_id', '=', 'journey_status.id')
        ->select('journey.*','journey_status.name as status', 'db2.emp_title', 'db2.emp_firstname', 'db2.emp_surname')
        ->where('vehical_id','=',NULL)->where('applicant_id','=',$userid)
        ->get();
      
        return response($journeys);
        
    }
}
