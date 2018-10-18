<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ExternalVehicle extends Model
{
    protected $table = 'external_vehicle';

    protected $fillable = [
		'company_name',
        'cost',
        'journey_id'	
    ];
    
    public function journey()
	{
		return $this->belongsTo(\App\Models\Journey::class);
	}
}
