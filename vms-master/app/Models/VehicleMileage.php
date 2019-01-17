<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMileage extends Model
{
    protected $table = 'vehicle_mileage';

    public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'meter_reading_day_begin' => 'int',
		'meter_reading_day_end' => 'int',
		'meter_reading_mileage' => 'float',
		'journey_mileage' => 'float'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
        'vehical_id',
		'date',	
		'meter_reading_day_begin',
		'meter_reading_day_end',
		'meter_reading_mileage',
		'journey_mileage',
		'remarks'	

	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}

	public function driver()
	{
		return $this->belongsTo(\App\Models\Driver::class);
	}
}
