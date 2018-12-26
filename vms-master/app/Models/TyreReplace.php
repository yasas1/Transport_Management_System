<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TyreReplace
 * 
 * @property int $id
 * @property int $vehical_id
 * @property \Carbon\Carbon $date
 * @property string $position
 * @property float $milometer_reading
 * @property string $remarks
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class TyreReplace extends Eloquent
{
	protected $table = 'tyre_replaces';

	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'milometer_reading' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'vehical_id',
		'date',
		'position',
		'size',
		'type',
		'meter_reading',
		'remarks'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
