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
        if(Auth::user()->role_id == 4){
            $driverEmp = Auth::user()->emp_id;
            $driverId = Driver::where('emp_id','=',$driverEmp)->first()->id;
            
            $journeys = Journey::where('journey_status_id','=','6')
            ->where('driver_id','=',$driverId)
            ->get();

            //return $journeys;

            $vehicles = Vehical::all(); // for vehicle color button {delete}
            return view('journey.completed',compact('journeys','vehicles'));
        }
        else{
            $journeys = Journey::completed();
            $vehicles = Vehical::all(); // for vehicle color button {delete}
            return view('journey.completed',compact('journeys','vehicles'));
        }
    }
}
