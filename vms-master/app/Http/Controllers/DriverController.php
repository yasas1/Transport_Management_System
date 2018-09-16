<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Title;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDriverRequest;

class DriverController extends Controller
{
    public function index(){
        $drivers = Driver::all();
        return view('driver.index',compact('drivers'));
    }

    public function create(){
        $titles = Title::all()->pluck('name','id');
        return view('driver.create',compact('titles'));
    }

    public function store(CreateDriverRequest $request){

        /* $this->validate($request,[
            'title_id'=>'required',
            'firstname'=>'required',
            'surname'=>'required',
            'nic'=>'required',
            'licence_no'=>'required',
            'mobile'=>'required',
        ],[
            'title_id.required'=>'Driver title is required.'
        ]); */

        $driver = new Driver;
        $driver->title_id = $request->title_id;
        $driver->firstname = $request->firstname;
        $driver->surname = $request->surname;
        $driver->initials = $request->initials;
        $driver->nic = $request->nic;
        $driver->licence_no = $request->licence_no;
        $driver->licence_expire_date = Carbon::parse($request->licence_expire_date);
        $driver->mobile = $request->mobile;

        $driver->save();

        return redirect()->back()->with(['success'=>'Driver added successfully !']);

    }

    public function edit($id){

        $titles = Title::all()->pluck('name','id');
        if($driver = Driver::whereId($id)->first()){
            return view('driver.edit',compact('driver','titles'));
        }

        return redirect('/driver/')->withErrors(['Driver not found.']);
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'title_id'=>'required',
            'firstname'=>'required',
            'surname'=>'required',
            'nic'=>'required',
            'licence_no'=>'required',
            'mobile'=>'required',
        ],[
            'title_id.required'=>'Driver title is required.'
        ]);

        if($driver = Driver::whereId($id)->first()){

            $driver->title_id = $request->title_id;
            $driver->firstname = $request->firstname;
            $driver->surname = $request->surname;
            $driver->initials = $request->initials;
            $driver->nic = $request->nic;
            $driver->licence_no = $request->licence_no;
            $driver->licence_expire_date = Carbon::parse($request->licence_expire_date);
            $driver->mobile = $request->mobile;

            $driver->save();

            return redirect()->back()->with(['success'=>'Driver updated successfully !']);

        }

        return redirect('driver')->withErrors(['Driver not found.']);

    }

    public function destroy($id){

         if($driver = Driver::whereId($id)->first()){

            $driver->delete();
            return redirect('driver')->with(['success'=>'Driver Deleted successfully !']);
         }

        // return redirect('driver')->withErrors(['Driver not found.']);

        // $driver = Driver::whereId($id)->delete();
        // return redirect()->back()->with(['success'=>'Driver Deleted successfully !']);
    }

}
