<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelUsage extends Model
{
    protected $table = 'fuel_usage';

    public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'meter_reading' => 'int',
		'fuel_liter' => 'float',
		'cost' => 'float',
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
        'vehical_id',
		'date',	
		'meter_reading',
		'fuel_liter',
		'cost',	

	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}

}
