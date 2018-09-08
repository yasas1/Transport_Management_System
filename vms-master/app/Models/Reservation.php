<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Apr 2018 06:31:24 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Reservation
 * 
 * @property int $id
 * @property int $vehical_id
 * @property int $driver_id
 * @property string $applicant_email
 * @property \Carbon\Carbon $reserve_date_time
 * @property \Carbon\Carbon $expected_time_of_arrival
 * @property float $expected_distance
 * @property string $purpose
 * @property int $number_of_persons
 * @property string $places_to_be_visited
 * @property int $funds_allocated_from_id
 * @property int $is_long_distance
 * 
 * @property \App\Models\Driver $driver
 * @property \App\Models\FundsAllocatedFrom $funds_allocated_from
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class Reservation extends Eloquent
{
	protected $table = 'reservation';
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'driver_id' => 'int',
		'expected_distance' => 'float',
		'number_of_persons' => 'int',
		'funds_allocated_from_id' => 'int',
		'is_long_distance' => 'int'
	];

	protected $dates = [
		'reserve_date_time',
		'expected_time_of_arrival'
	];

	protected $fillable = [
		'vehical_id',
		'driver_id',
		'applicant_email',
		'reserve_date_time',
		'expected_time_of_arrival',
		'expected_distance',
		'purpose',
		'number_of_persons',
		'places_to_be_visited',
		'funds_allocated_from_id',
		'is_long_distance'
	];

	public function driver()
	{
		return $this->belongsTo(\App\Models\Driver::class);
	}

	public function funds_allocated_from()
	{
		return $this->belongsTo(\App\Models\FundsAllocatedFrom::class);
	}

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
