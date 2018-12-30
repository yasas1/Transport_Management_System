<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\IdCard;
use App\Models\Photo;
use App\Models\RegBook;
use App\Models\Vehical;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index(){
        $vehicles = Vehical::all();
        return view('vehicle.index',compact('vehicles'));
    }

    public function create(){
        $drivers = Driver::all()->pluck('fullName','id');
        return view('vehicle.create',compact('drivers'));
    }

    public function store(Request $request){

        $vehicle = new Vehical;
        $vehicle->name = $request->name;

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');
            $extension =  '.'.$photo->getClientOriginalExtension();
            $oName = $photo->getClientOriginalName();
            $name = $request->registration_no.md5($oName.Carbon::now()).$extension;

            $path =  $photo->move('images/van',$name);

            $photo = new Photo;
            $photo->path = $path;
            $photo->save();

            $vehicle->photo()->associate($photo);

        }

        if ($request->hasFile('id_card')) {

            $idCard = $request->file('id_card');
            $extension =  '.'.$idCard->getClientOriginalExtension();
            $oName = $idCard->getClientOriginalName();
            $name = $request->registration_no.md5($oName.Carbon::now()).$extension;

            $path =  $idCard->move('documents/idc',$name);

            $idCard = new IdCard;
            $idCard->path = $path;
            $idCard->name = $oName;
            $idCard->save();

            $vehicle->id_card()->associate($idCard);

        }

        if ($request->hasFile('reg_book')) {

            $regBook = $request->file('reg_book');
            $extension =  '.'.$regBook->getClientOriginalExtension();
            $oName = $regBook->getClientOriginalName();
            $name = $request->registration_no.md5($oName.Carbon::now()).$extension;

            $path =  $regBook->move('documents/regbook',$name);

            $regBook = new RegBook;
            $regBook->path = $path;
            $regBook->name = $oName;
            $regBook->save();

            $vehicle->reg_book()->associate($regBook);

        }
        $vehicle->journey_color = $request->journey_color;
        $vehicle->driver_id = $request->driver_id;
        $vehicle->registration_no = $request->registration_no;
        $vehicle->dept_no = $request->dept_no;
        $vehicle->date_of_registration = $request->date_of_registration;
        $vehicle->make_and_type = $request->make_and_type;
        $vehicle->chassis_no = $request->chassis_no;
        $vehicle->engine_no = $request->engine_no;
        $vehicle->type_of_body = $request->type_of_body;
        $vehicle->no_of_cylinders = $request->no_of_cylinders;
        $vehicle->horse_power = $request->horse_power;
        $vehicle->pay_load = $request->pay_load;
        $vehicle->bore = $request->bore;
        $vehicle->stroke = $request->stroke;
        $vehicle->carburettor_make_and_type = $request->carburettor_make_and_type;
        $vehicle->sizes_of_jets_main = $request->sizes_of_jets_main;
        $vehicle->sizes_of_jets_compensation = $request->sizes_of_jets_compensation;
        $vehicle->sizes_of_jets_choke = $request->sizes_of_jets_choke;
        $vehicle->fuel_injection_pump_make_and_make = $request->fuel_injection_pump_make_and_make;
        $vehicle->fuel_injection_pump_makers_no = $request->fuel_injection_pump_makers_no;
        $vehicle->atomisers_make = $request->atomisers_make;
        $vehicle->coil_or_magneto_make = $request->coil_or_magneto_make;
        $vehicle->coil_or_magneto_makers_no = $request->coil_or_magneto_makers_no;
        $vehicle->coil_or_magneto_type = $request->coil_or_magneto_type;
        $vehicle->coil_or_magneto_rotation = $request->coil_or_magneto_rotation;
        $vehicle->lighting_set_make = $request->lighting_set_make;
        $vehicle->lighting_set_type = $request->lighting_set_type;
        $vehicle->lighting_set_voltage = $request->lighting_set_voltage;
        $vehicle->tyres_size_front = $request->tyres_size_front;
        $vehicle->tyres_size_rear = $request->tyres_size_rear;
        $vehicle->tyres_pressure_front = $request->tyres_pressure_front;
        $vehicle->tyres_pressure_rear = $request->tyres_pressure_rear;
        $vehicle->battery_dimensions = $request->battery_dimensions;
        $vehicle->bettery_voltage = $request->bettery_voltage;
        $vehicle->battery_amperage = $request->battery_amperage;
        $vehicle->capacity_of_fuel_tank = $request->capacity_of_fuel_tank;
        $vehicle->capacity_of_reserve_tank = $request->capacity_of_reserve_tank;
        $vehicle->engine_crank_case = $request->engine_crank_case;
        $vehicle->gear_box = $request->gear_box;
        $vehicle->rear_axel = $request->rear_axel;
        $vehicle->oil_specifications_engine = $request->oil_specifications_engine;
        $vehicle->oil_specifications_gear_oil = $request->oil_specifications_gear_oil;
        $vehicle->oil_specifications_shock_absorber_fluid = $request->oil_specifications_shock_absorber_fluid;
        $vehicle->oil_specifications_differential_oil = $request->oil_specifications_differential_oil;
        $vehicle->perchase_price = $request->perchase_price;
        $vehicle->date_of_perchase = $request->date_of_perchase;
//        $vehicle->created_by = Auth::user()->id;
//		  $vehicle->updated_by = Auth::user()->id;
        $vehicle->save();

        if ($request->hasFile('documents')) {

            $documents = $request->file('documents');

            foreach ($documents as $document){

                $extension =  '.'.$document->getClientOriginalExtension();
                $oName = $document->getClientOriginalName();
                $name = $request->registration_no.md5($oName.Carbon::now()).$extension;

                $path =  $document->move('documents/other',$name);

                $document = new Document();
                $document->path = $path;
                $document->name = $oName;
                $document->vehical()->associate($vehicle);
                $document->save();
            }
        }

        return redirect()->back()->with(['success'=>'New vehicle added successfully !']);
    }

    public function edit($id){

        if ($vehicle = Vehical::whereId($id)->first()){
            $drivers = Driver::all()->pluck('fullName','id');
            $documents = $vehicle->documents()->get();
            return view('vehicle.edit',compact('vehicle','documents','drivers'));
        }

        return redirect('home');

    }

    public function update(Request $request, $id){

        if($vehicle = Vehical::whereId($id)->first()){

            if ($request->hasFile('photo')) {

                $photo = $request->file('photo');
                $extension =  '.'.$photo->getClientOriginalExtension();
                $oName = $photo->getClientOriginalName();
                $name = md5($oName.Carbon::now()).$extension;

                $path =  $photo->move('images/van',$name);

                if($vehicle->photo&&$photo = Photo::whereId($vehicle->photo->id)->first()){
                    $photo->path = $path;
                    $photo->update();
                }else{
                    $photo = new Photo;
                    $photo->path = $path;
                    $photo->save();
                }


                if($vehicle->photo){
                    $oldPhoto = $vehicle->photo->path;
                    if(file_exists($oldPhoto)){
                        unlink(public_path().'/'. $oldPhoto);
                    }
                }
                $vehicle->photo()->associate($photo);
            }
            $vehicle->journey_color = $request->journey_color;
            $vehicle->name = $request->name;
            $vehicle->registration_no = $request->registration_no;
            $vehicle->dept_no = $request->dept_no;
            $vehicle->date_of_registration = $request->date_of_registration;
            $vehicle->make_and_type = $request->make_and_type;
            $vehicle->chassis_no = $request->chassis_no;
            $vehicle->engine_no = $request->engine_no;
            $vehicle->type_of_body = $request->type_of_body;
            $vehicle->no_of_cylinders = $request->no_of_cylinders;
            $vehicle->horse_power = $request->horse_power;
            $vehicle->pay_load = $request->pay_load;
            $vehicle->bore = $request->bore;
            $vehicle->stroke = $request->stroke;
            $vehicle->carburettor_make_and_type = $request->carburettor_make_and_type;
            $vehicle->sizes_of_jets_main = $request->sizes_of_jets_main;
            $vehicle->sizes_of_jets_compensation = $request->sizes_of_jets_compensation;
            $vehicle->sizes_of_jets_choke = $request->sizes_of_jets_choke;
            $vehicle->fuel_injection_pump_make_and_make = $request->fuel_injection_pump_make_and_make;
            $vehicle->fuel_injection_pump_makers_no = $request->fuel_injection_pump_makers_no;
            $vehicle->atomisers_make = $request->atomisers_make;
            $vehicle->coil_or_magneto_make = $request->coil_or_magneto_make;
            $vehicle->coil_or_magneto_makers_no = $request->coil_or_magneto_makers_no;
            $vehicle->coil_or_magneto_type = $request->coil_or_magneto_type;
            $vehicle->coil_or_magneto_rotation = $request->coil_or_magneto_rotation;
            $vehicle->lighting_set_make = $request->lighting_set_make;
            $vehicle->lighting_set_type = $request->lighting_set_type;
            $vehicle->lighting_set_voltage = $request->lighting_set_voltage;
            $vehicle->tyres_size_front = $request->tyres_size_front;
            $vehicle->tyres_size_rear = $request->tyres_size_rear;
            $vehicle->tyres_pressure_front = $request->tyres_pressure_front;
            $vehicle->tyres_pressure_rear = $request->tyres_pressure_rear;
            $vehicle->battery_dimensions = $request->battery_dimensions;
            $vehicle->bettery_voltage = $request->bettery_voltage;
            $vehicle->battery_amperage = $request->battery_amperage;
            $vehicle->capacity_of_fuel_tank = $request->capacity_of_fuel_tank;
            $vehicle->capacity_of_reserve_tank = $request->capacity_of_reserve_tank;
            $vehicle->engine_crank_case = $request->engine_crank_case;
            $vehicle->gear_box = $request->gear_box;
            $vehicle->rear_axel = $request->rear_axel;
            $vehicle->oil_specifications_engine = $request->oil_specifications_engine;
            $vehicle->oil_specifications_gear_oil = $request->oil_specifications_gear_oil;
            $vehicle->oil_specifications_shock_absorber_fluid = $request->oil_specifications_shock_absorber_fluid;
            $vehicle->oil_specifications_differential_oil = $request->oil_specifications_differential_oil;
            $vehicle->perchase_price = $request->perchase_price;
            $vehicle->date_of_perchase = $request->date_of_perchase;
//        $vehicle->created_by = Auth::user()->id;
//		  $vehicle->updated_by = Auth::user()->id;
            $vehicle->update();

            if ($request->hasFile('documents')) {

                $documents = $request->file('documents');

                foreach ($documents as $document){

                    $extension =  '.'.$document->getClientOriginalExtension();
                    $oName = $document->getClientOriginalName();
                    $name = md5($oName.Carbon::now()).$extension;

                    $path =  $document->move('documents',$name);

                    $document = new Document();
                    $document->path = $path;
                    $document->name = $oName;
                    $document->vehical()->associate($vehicle);
                    $document->save();
                }
            }

            return redirect()->back()->with(['success'=>'Vehicle Updated Successfully !']);
        }

    }

    public function deleteDocumentById($id){

        if($document = Document::whereId($id)->first()){
            $document->delete();
            return redirect()->back()->with(['success'=>'Document deleted successfully']);
        }

    }

}
