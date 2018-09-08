<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 27 Mar 2018 09:18:45 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Deficiency
 * 
 * @property int $id
 * @property int $ownership_transfers_id
 * @property string $description
 * @property float $quantity
 * @property string $action_taken
 * @property string $reference_to_correspondence
 * 
 * @property \App\Models\OwnershipTransfer $ownership_transfer
 *
 * @package App\Models
 */
class Deficiency extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'ownership_transfers_id' => 'int',
		'quantity' => 'float'
	];

	protected $fillable = [
		'ownership_transfers_id',
		'description',
		'quantity',
		'action_taken',
		'reference_to_correspondence'
	];

	public function ownership_transfer()
	{
		return $this->belongsTo(\App\Models\OwnershipTransfer::class, 'ownership_transfers_id');
	}
}
