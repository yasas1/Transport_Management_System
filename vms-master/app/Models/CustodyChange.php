<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class CustodyChange
 * 
 * @property int $id
 * @property int $vehical_id
 * @property \Carbon\Carbon $date
 * @property string $in_custody
 * @property string $to_custody
 * @property int $is_approved
 * @property string $approved_by
 * @property \Carbon\Carbon $approved_at
 * @property int $is_accepted
 * @property \Carbon\Carbon $accepted_at
 * 
 * @property \App\Models\Vehical $vehical
 *
 * @package App\Models
 */
class CustodyChange extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'vehical_id' => 'int',
		'is_approved' => 'int',
		'is_accepted' => 'int'
	];

	protected $dates = [
		'date',
		'approved_at',
		'accepted_at'
	];

	protected $fillable = [
		'vehical_id',
		'date',
		'in_custody',
		'to_custody',
		'is_approved',
		'approved_by',
		'approved_at',
		'is_accepted',
		'accepted_at'
	];

	public function vehical()
	{
		return $this->belongsTo(\App\Models\Vehical::class);
	}
}
