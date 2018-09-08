<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Accident
 * 
 * @property int $id
 * @property int $vehical_id
 * @property string $description_of_damage
 * @property float $cost_of_repaire
 * @property \Carbon\Carbon $date_of_recovery
 * @property string $action_taken_against_driver
 * @property string $file_no
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class Accident extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'cost_of_repaire' => 'float'
	];

	protected $dates = [
		'date_of_recovery'
	];

	protected $fillable = [
		'vehical_id',
		'description_of_damage',
		'cost_of_repaire',
		'date_of_recovery',
		'action_taken_against_driver',
		'file_no'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
