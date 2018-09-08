<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JourneyConfirmController extends Controller
{
    public function confirm(Request $request, $id){


        if($journey = Journey::whereId($id)->first()){

            $journey->confirmation_remarks = $request->remarks;
            $journey->confirmed_at = Carbon::now();
            $journey->confirmed_by = '000004';
            $journey->confirmation_remarks = $request->confirmation_remarks;

            if($request->submitType=='CONFIRM'){

                $journey->journey_status_id = '4';

                if($journey->driver_id!=$request->driver_id){
                    $journey->driver_id = $request->driver_id;
                }

                if($journey->vehical_id!=$request->vehical_id){
                    $journey->vehical_id = $request->vehical_id;
                }

                if($journey->vehical_id!=$request->vehical_id){
                    $journey->vehical_id = $request->vehical_id;
                }

                if($journey->expected_start_date_time != Carbon::parse($request->confirmed_start_date_time)){
                    $journey->confirmed_start_date_time = Carbon::parse($request->confirmed_start_date_time);
                }

                if($journey->expected_end_date_time != Carbon::parse($request->confirmed_end_date_time)){
                    $journey->confirmed_end_date_time = Carbon::parse($request->confirmed_end_date_time);
                }

                $journey->update();
                return redirect()->back()->with(['success'=>'Journey request confirmed successfully !']);

            }else if ($request->submitType=='DENY'){

                $journey->journey_status_id = '5';
                $journey->update();
                return redirect()->back()->with(['success'=>'Journey request confirmation denied successfully !']);

            }
        }

    }

    public function test(Request $request){
        return $request;
    }
}
