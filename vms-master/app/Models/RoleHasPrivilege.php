<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 14 May 2018 09:54:09 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class RoleHasPrivilege
 * 
 * @property int $role_id
 * @property int $privileges_id
 * 
 * @property \App\Models\Privilege $role
 * @property \App\Models\Role $role
 *
 * @package App\Models
 */
class RoleHasPrivilege extends Eloquent
{
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'role_id' => 'int',
		'privileges_id' => 'int'
	];

	public function privilege()
	{
		return $this->belongsTo(\App\Models\Privilege::class, 'privileges_id');
	}

	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class);
	}
}
