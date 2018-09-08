<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Photo
 * 
 * @property int $id
 * @property string $path
 * 
 * @property \Illuminate\Database\Eloquent\Collection $vehicals
 *
 * @package App\Models
 */
class Photo extends Eloquent
{
	protected $table = 'photo';
	public $timestamps = false;

	protected $fillable = [
		'path'
	];

	public function vehicals()
	{
		return $this->hasMany(\App\Models\Vehical::class);
	}
}
