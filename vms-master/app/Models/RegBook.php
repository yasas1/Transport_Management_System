<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Apr 2018 05:21:12 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RegBook
 * 
 * @property int $id
 * @property string $name
 * @property string $path
 * 
 * @property \Illuminate\Database\Eloquent\Collection $vehicals
 *
 * @package App\Models
 */
class RegBook extends Eloquent
{
	protected $table = 'reg_book';
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
