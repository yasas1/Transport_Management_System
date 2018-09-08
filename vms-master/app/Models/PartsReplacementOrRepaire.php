<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class PartsReplacementOrRepaire
 * 
 * @property int $id
 * @property int $vehical_id
 * @property int $item_id
 * @property \Carbon\Carbon $date
 * @property string $makers_no
 * @property string $description
 * @property string $remarks
 * @property string $oic
 * 
 * @property \App\Models\Item $item
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class PartsReplacementOrRepaire extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'item_id' => 'int'
	];

	protected $dates = [
		'date'
	];

	protected $fillable = [
		'vehical_id',
		'item_id',
		'date',
		'makers_no',
		'description',
		'remarks',
		'oic'
	];

	public function item()
	{
		return $this->belongsTo(\App\Models\Item::class);
	}

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
