<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Service
 * 
 * @property int $id
 * @property int $vehical_id
 * @property \Carbon\Carbon $date
 * @property float $meter_reading
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class Service extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'meter_reading' => 'float'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'vehical_id',
		'date',
		'meter_reading'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
