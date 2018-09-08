<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 03 Apr 2018 10:01:14 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Title
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $drivers
 *
 * @package App\Models
 */
class Title extends Eloquent
{
	protected $table = 'title';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function drivers()
	{
		return $this->hasMany(\App\Models\Driver::class);
	}
}
