<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class DriverChange
 * 
 * @property int $id
 * @property int $vehical_id
 * @property string $name_of_driver
 * @property \Carbon\Carbon $from
 * @property \Carbon\Carbon $to
 * @property string $changed_by
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class DriverChange extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int'
	];

	protected $dates = [
		'from',
		'to'
	];

	protected $fillable = [
		'vehical_id',
		'name_of_driver',
		'from',
		'to',
		'changed_by'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
