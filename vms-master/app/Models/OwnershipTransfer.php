<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class OwnershipTransfer
 * 
 * @property int $id
 * @property int $vehical_id
 * @property \Carbon\Carbon $date
 * @property string $transferor
 * @property string $transferee
 * 
 * @property \App\Models\Vehical $vehical
 * @property \Illuminate\Database\Eloquent\Collection $deficiencies
 *
 * @package App\Models
 */
class OwnershipTransfer extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'vehical_id',
		'date',
		'transferor',
		'transferee'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}

	public function deficiencies()
	{
		return $this->hasMany(\App\Models\Deficiency::class, 'ownership_transfers_id');
	}
}
