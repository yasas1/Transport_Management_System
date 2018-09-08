<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FuelConsumption
 * 
 * @property int $id
 * @property int $vehical_id
 * @property float $authorised_mpg_with_load
 * @property float $authorised_mpg_without_load
 * @property \Carbon\Carbon $tested_on
 * @property float $mpg_with_load
 * @property float $mpg_without_load
 * @property string $action
 * @property string $tested_by
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class FuelConsumption extends Eloquent
{
	protected $table = 'fuel_consumption';
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'authorised_mpg_with_load' => 'float',
		'authorised_mpg_without_load' => 'float',
		'mpg_with_load' => 'float',
		'mpg_without_load' => 'float'
	];

	protected $dates = [
		'tested_on'
	];

	protected $fillable = [
		'vehical_id',
		'authorised_mpg_with_load',
		'authorised_mpg_without_load',
		'tested_on',
		'mpg_with_load',
		'mpg_without_load',
		'action',
		'tested_by'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
