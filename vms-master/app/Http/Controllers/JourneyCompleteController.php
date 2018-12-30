<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\ExternalVehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JourneyCompleteController extends Controller
{

    public function confirmedJourneys(){

        if(Auth::user()->canCompleteJourney()){

            $journeys = Journey::confirmed();
            return view('journey.complete',compact('journeys'));
        }
        return redirect('home');

    }

    public function complete(Request $request, $id){

        if(Auth::user()->canCompleteJourney() && $journey = Journey::whereId($id)->first()){

            $journey->real_start_date_time = Carbon::parse($request->real_start_date_time);
            $journey->real_end_date_time = Carbon::parse($request->real_end_date_time);
            $journey->real_distance = $request->real_distance;

            if($journey->vehical_id==NULL && $journey->driver_id == NULL && $externalExis = ExternalVehicle::where('journey_id','=',$id)->first() ){

                $externalExis->complete_remarks = $request->remarks;
                $externalExis->completed_at = Carbon::now();
                $externalExis->complete_filled_by = Auth::user()->emp_id;

                $journey->journey_status_id = '6';
                $journey->update();
                $externalExis->update();
                //return $externalExis;
                return redirect()->back()->with(['success'=>'Journey completed successfully !']);

            }
            else{
                $journey->driver_remarks = $request->remarks;
                $journey->driver_completed_at = Carbon::now();
                //$journey->driver_filled_by = Auth::user()->emp_id;
                $journey->journey_status_id = '6';
                $journey->update();
                return redirect()->back()->with(['success'=>'Journey completed successfully !']);
            }
        }
        return redirect('home');
    }

}


