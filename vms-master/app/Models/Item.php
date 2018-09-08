<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Item
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $parts_replacement_or_repaires
 *
 * @package App\Models
 */
class Item extends Eloquent
{
	protected $table = 'item';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function parts_replacement_or_repaires()
	{
		return $this->hasMany(\App\Models\PartsReplacementOrRepaire::class);
	}
}
