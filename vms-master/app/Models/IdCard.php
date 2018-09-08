<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Apr 2018 05:21:27 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class IdCard
 * 
 * @property int $id
 * @property string $name
 * @property string $path
 * 
 * @property \Illuminate\Database\Eloquent\Collection $vehicals
 *
 * @package App\Models
 */
class IdCard extends Eloquent
{
	protected $table = 'id_card';
	public $timestamps = false;

	protected $fillable = [
		'name',
		'path'
	];

	public function vehicals()
	{
		return $this->hasMany(\App\Models\Vehical::class);
	}
}
