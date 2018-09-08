<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Document
 * 
 * @property int $id
 * @property string $path
 * @property int $vehical_id
 * @property string $name
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class Document extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int'
	];

	protected $fillable = [
		'path',
		'vehical_id',
		'name'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
