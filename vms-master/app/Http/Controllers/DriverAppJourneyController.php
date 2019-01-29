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
    public function confirmedJourneys(Request $request){

        $request->email;

        $email =$request->email; //Auth::user()->email;

        $driverid = Driver::where('email','=',$email)->first()->id;

        $journeys = Journey::where('driver_id','=',$driverid)->get();//->where('journey_status_id','=','4')->get();


        $data = [
            
            "details" => $request->email
                           
            
        ];
            
        return response()->json($data);
        
    }
}
