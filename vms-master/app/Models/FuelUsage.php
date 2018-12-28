<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelUsage extends Model
{
    protected $table = 'fuel_usage';

    public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
        'driver_id' => 'int',
		'in_tank_liter' => 'float',
		'consumed' => 'float',
		'balance' => 'float',
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
        'vehical_id',
		'date',	
		'in_tank_liter',
		'drawn',
		'consumed',
		'balance'
		

	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}

}
