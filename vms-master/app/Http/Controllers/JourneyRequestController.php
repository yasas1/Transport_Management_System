<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JourneyRequestController extends Controller
{

    public function approval(Request $request, $id){


        if($journey = Journey::whereId($id)->first()){

            $journey->approved_at = Carbon::now();
            $journey->approved_by = '000046';
            $journey->approval_remarks = $request->remarks; 

            if($request->is_approved == '1'){
                $journey->journey_status_id = '2';
                $journey->update();
                return redirect()->back()->with(['success'=>'Journey request approved successfully !']);
            }else{
                $journey->journey_status_id = '3';
                $journey->update();
                return redirect()->back()->with(['success'=>'Journey request denied successfully !']);
            }

        }

    }


}
