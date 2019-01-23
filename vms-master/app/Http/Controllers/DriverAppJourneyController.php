<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\ExternalVehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;

class DriverAppJourneyController extends Controller
{
    public function confirmedJourneys(){

        $userlogid = Auth::user()->emp_id;

        if(Auth::user()->canCompleteJourney()){

            if(Auth::user()->role_id == 4){

                $email = Auth::user()->email;

                $driverid = Driver::where('email','=',$email)->first()->id;

                $journeys = Journey::where('driver_id','=',$driverid)->where('journey_status_id','=','4')->get();

            }
            else{
                $journeys = Journey::confirmed();
            }   
            return respone('journeys');
        }
        

    }
}
