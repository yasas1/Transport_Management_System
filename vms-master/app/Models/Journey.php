<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 07 May 2018 15:20:43 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Journey
 * 
 * @property int $id
 * @property string $applicant_id
 * @property int $vehical_id
 * @property int $driver_id
 * @property int $funds_allocated_from_id
 * @property \Carbon\Carbon $expected_start_date_time
 * @property \Carbon\Carbon $expected_end_date_time
 * @property \Carbon\Carbon $real_start_date_time
 * @property \Carbon\Carbon $real_end_date_time
 * @property float $expected_distance
 * @property float $real_distance
 * @property string $purpose
 * @property int $number_of_persons
 * @property string $places_to_be_visited
 * @property int $is_long_distance
 * @property string $divisional_head_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $approved_at
 * @property string $approved_by
 * @property string $confirmed_by
 * @property int $journey_status_id
 * @property string $approval_remarks
 * @property string $confirmation_remarks
 * 
 * @property \App\Models\Driver $driver
 * @property \App\Models\FundsAllocatedFrom $funds_allocated_from
 * @property \App\Models\JourneyStatus $journey_status
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class Journey extends Eloquent
{
	protected $table = 'journey';

	protected $casts = [
		'vehical_id' => 'int',
		'driver_id' => 'int',
		'funds_allocated_from_id' => 'int',
		'expected_distance' => 'float',
		'real_distance' => 'float',
		'number_of_persons' => 'int',
		'is_long_distance' => 'int',
		'journey_status_id' => 'int'
	];

	protected $dates = [
		'expected_start_date_time',
		'expected_end_date_time',
		'real_start_date_time',
		'real_end_date_time',
		'approved_at',
        'confirmed_at',
        'confirmed_start_date_time',
        'confirmed_end_date_time',
        'driver_completed_at'
	];

	protected $fillable = [
		'applicant_id',
		'vehical_id',
		'driver_id',
		'funds_allocated_from_id',
		'expected_start_date_time',
		'expected_end_date_time',
		'real_start_date_time',
		'real_end_date_time',
		'expected_distance',
		'real_distance',
		'purpose',
		'number_of_persons',
		'places_to_be_visited',
		'is_long_distance',
		'divisional_head_id',
		'approved_at',
		'approved_by',
		'confirmed_by',
        'confirmed_at',
		'journey_status_id',
		'approval_remarks',
		'confirmation_remarks',
        'driver_remarks',
        'confirmed_start_date_time',
        'confirmed_end_date_time',
        'driver_completed_at',
        'driver_filled_by'
	];

	public function driver()
	{
		return $this->belongsTo(\App\Models\Driver::class);
	}

	public function funds_allocated_from()
	{
		return $this->belongsTo(\App\Models\FundsAllocatedFrom::class);
	}

	public function journey_status()
	{
		return $this->belongsTo(\App\Models\JourneyStatus::class);
	}

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}

    public function applicant()
    {
        return $this->belongsTo(\App\Models\Employee::class,'applicant_id','emp_id');
    }

    public function divisional_head()
    {
        return $this->belongsTo(\App\Models\Employee::class,'divisional_head_id','emp_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(\App\Models\Employee::class,'approved_by','emp_id');
    }

    public function confirmedBy(){
        return $this->belongsTo(\App\Models\Employee::class,'confirmed_by','emp_id');
    }

    public static function notApproved(){
		//return only not approved journeys
        return Journey::where('journey_status_id','=','1')->where('is_long_distance', '=', '0')->get();
	}

	public static function notApprovedLongDistance(){
		       //return not approved long distance journeys
        return Journey::where('journey_status_id','=','1')->where('is_long_distance', '=', '1')->get();
	}
	
    public static function approved(){
        return Journey::where('journey_status_id','=','2')->get();
	}
	
    public static function notConfirmed(){
        return Journey::where('journey_status_id','=','2')->get();
	}
	
    public static function confirmed(){
        return Journey::where('journey_status_id','=','4')->get();
	}
	
    public static function completed(){
        return Journey::where('journey_status_id','=','6')->get();
	}
	public static function journeyByVehicle($vid){
        return Journey::where('vehical_id','=',$vid)->get();
	}
	
	public static function journeyByVehicleNotConfirmed($vid){
        return Journey::where('vehical_id','=',$vid)->where('journey_status_id','=','2')->get();
    }

}
