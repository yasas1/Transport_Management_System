<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class JourneyRequestController extends Controller
{

    public function approval(Request $request, $id){

        // $this->validate($request , [
        //     'remarks' => 'required'
            
        // ]);     

        if($journey = Journey::whereId($id)->first()){

            $journey->approved_at = Carbon::now();
            $journey->approved_by = Auth::user()->emp_id;
            $journey->approval_remarks = $request->remarks; 

            if($request->is_approved == '1'){
                $journey->journey_status_id = '2';
                $journey->update();
                //return $journey;
                return redirect()->back()->with(['success'=>'Journey request approved successfully !']);
            }else{
                $journey->journey_status_id = '3';
                //return $journey;
                $journey->update();
                return redirect()->back()->with(['success'=>'Journey request denied successfully !']);
            }

        }

    }

}
