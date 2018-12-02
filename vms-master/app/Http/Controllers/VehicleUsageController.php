<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VehicleUsageController extends Controller
{
   public function index(){
       return view('vehicle.usage.index');
   }
}
