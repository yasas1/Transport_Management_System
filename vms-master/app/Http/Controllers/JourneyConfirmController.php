<?php

namespace App\Http\Controllers;

use App\Models\Journey;
use App\Models\ExternalVehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use View;
use Illuminate\Support\Facades\Auth;

class JourneyConfirmController extends Controller
{
    // public function confirm(Request $request, $id){


    //     if($journey = Journey::whereId($id)->first()){

    //         $journey->confirmation_remarks = $request->remarks;
    //         $journey->confirmed_at = Carbon::now();
    //         $journey->confirmed_by = '000004';
    //         $journey->confirmation_remarks = $request->confirmation_remarks;

    //         if($request->submitType=='CONFIRM'){

    //             $journey->journey_status_id = '4';

    //             if($journey->driver_id!=$request->driver_id){
    //                 $journey->driver_id = $request->driver_id;
    //             }

    //             if($journey->vehical_id!=$request->vehical_id){
    //                 $journey->vehical_id = $request->vehical_id;
    //             }
                
    //             if($journey->expected_start_date_time != Carbon::parse($request->confirmed_start_date_time)){
    //                 $journey->confirmed_start_date_time = Carbon::parse($request->confirmed_start_date_time);
    //             }

    //             if($journey->expected_end_date_time != Carbon::parse($request->confirmed_end_date_time)){
    //                 $journey->confirmed_end_date_time = Carbon::parse($request->confirmed_end_date_time);
    //             }

    //             $journey->update();
    //             return redirect()->back()->with(['success'=>'Journey request confirmed successfully !']);

    //         }else if ($request->submitType=='DENY'){

    //             $journey->journey_status_id = '5';
    //             $journey->update();
    //             return redirect()->back()->with(['success'=>'Journey request confirmation denied successfully !']);

    //         }
    //     }

    // }

    public function confirmAjax(Request $request){

        // $this->validate($request,[
        //     'confirmation_remarks'=>'required'       
        // ]);
        if($request->ajax()){ 

            if($journey = Journey::find($request->id)){

                $journey->confirmed_at = Carbon::now();
                $journey->confirmed_by = Auth::user()->emp_id;
                $journey->confirmation_remarks = $request->confirmation_remarks;

                //return $request->vehical_id ;
                    
                $journey->journey_status_id = '4';
                $journey->confirmed_start_date_time = Carbon::parse($request->confirmed_start_date_time);
                $journey->confirmed_end_date_time = Carbon::parse($request->confirmed_end_date_time);


                if($request->vehical_id == 0){
                    $journey->vehical_id = Null;
                    $journey->driver_id = NULL;
                    
                    $journey->update();
                    
                    $externalNew = new ExternalVehicle;
                    
                    $externalNew->company_name = $request->company_name ;
                    
                    $externalNew->cost = $request->cost ;
                    
                    $externalNew->journey_id = $request->id;
                    
                    
                    $externalNew->save();
                    Session::flash('success', 'Journey request confirmed successfully !');
                    return View::make('layouts/success');
                    //return $externalNew;
                }
                else{
                    if($request->driver_id != NULL && $journey->driver_id != $request->driver_id){
                        $journey->driver_id = $request->driver_id;
                    }

                    if($request->vehical_id != NULL &&  $journey->vehical_id != $request->vehical_id){
                        $journey->vehical_id = $request->vehical_id;
                    }

                    $journey->update(); 
                    Session::flash('success', 'Journey request confirmed successfully !');
                    return View::make('layouts/success');
                    //return response($journey);
                }
            }           
            //return response($journey);
        }
    }

    public function deny(Request $request){
        
        $id = $request->id ;
        
        if($journey = Journey::whereId($id)->first()){

            $journey->journey_status_id = "5";
            $journey->update();
            return redirect()->back()->with(['success'=>'Journey request confirmation denied successfully!']);     
        }
    }

}
