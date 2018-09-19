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

    public function confirmAjax(Request $request){

        if($request->ajax()){ 

            if($journey = Journey::find($request->id)){

                //$journey->confirmation_remarks = $request->remarks;
                $journey->confirmed_at = Carbon::now();
                $journey->confirmed_by = '000004';
                $journey->confirmation_remarks = $request->confirmation_remarks;

                // if($request->is_confirm == '1'){
                //     return "sgsg";//response();
                // }
                
                if($request->is_confirm == '1'){
                    
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

                    //$journey->update(); 
                    // $redirect_url = route('/journey/requests/notconfirmed');

                    // $report = ['url' => $redirect_url];
                   
                    // return response()->json($report);
                    return response()->json([
                        'success' => true,
                        'message' => 'record updated'
                    ], 200);
                    //return response()->json(['success'=>'Journey request confirmed successfully !','result'=>$journey,'url'=> route('/journey/requests/notconfirmed')]);
                    //return redirect()->back()->with(['success'=>'Journey request confirmed successfully !' , 'url'=> route('/journey/requests/notconfirmed')]);

                }
               
                else{

                    $journey->journey_status_id = '5';
                    //$journey->update();
                    //return response($journey);
                    return redirect()->back()->with(['success'=>'Journey request confirmation denied successfully !']);

                }

            }
            
            //return response($journey);
        }

    }

    public function test(Request $request){
        return $request;
    }
}
