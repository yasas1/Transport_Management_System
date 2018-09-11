<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JourneyCompleteController extends Controller
{

    public function confirmedJourneys(){

        $journeys = Journey::confirmed();
        return view('journey.complete',compact('journeys'));

    }

    public function complete(Request $request, $id){

        if($journey = Journey::whereId($id)->first()){

            $journey->real_start_date_time = Carbon::parse($request->real_start_date_time);
            $journey->real_end_date_time = Carbon::parse($request->real_end_date_time);
            $journey->real_distance = $request->real_distance;
            $journey->driver_remarks = $request->driver_remarks;

            $journey->driver_completed_at = Carbon::now();
//          $journey->driver_filled_by = Auth::user()->emp_id;
            $journey->journey_status_id = '6';
            $journey->update();
            return redirect()->back()->with(['success'=>'Journey completed successfully !']);
        }

    }

}


