<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleMileage extends Model
{
    protected $table = 'vehicle_mileage';

    public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
        'driver_id' => 'int',
        'kilometer_per_liter' => 'float'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
        'vehical_id',
        'driver_id',
		'date',	
		'meter_reading_out',
		'meter_reading_in',
		'mileage',
		'kilometer_per_liter'
		

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
