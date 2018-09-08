<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 07 May 2018 11:47:49 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class JourneyStatus
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $journeys
 *
 * @package App\Models
 */
class JourneyStatus extends Eloquent
{
	protected $table = 'journey_status';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function journeys()
	{
		return $this->hasMany(\App\Models\Journey::class);
	}

}
