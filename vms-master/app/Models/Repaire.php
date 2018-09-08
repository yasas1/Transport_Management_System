<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Repaire
 * 
 * @property int $id
 * @property int $vehical_id
 * @property string $job_no
 * @property \Carbon\Carbon $date
 * @property string $authorized_by
 * @property string $executed_at
 * @property float $cost
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class Repaire extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'cost' => 'float'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'vehical_id',
		'job_no',
		'date',
		'authorized_by',
		'executed_at',
		'cost'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
