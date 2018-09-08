<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class FundsAllocatedFrom
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $reservations
 *
 * @package App\Models
 */
class FundsAllocatedFrom extends Eloquent
{
	protected $table = 'funds_allocated_from';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function reservations()
	{
		return $this->hasMany(\App\Models\Reservation::class);
	}
}
