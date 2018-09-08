<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 19 May 2018 11:39:06 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Privilege
 * 
 * @property int $id
 * @property int $module_id
 * @property int $role_id
 * 
 * @property \App\Models\Module $module
 * @property \App\Models\Role $role
 * @property \Illuminate\Database\Eloquent\Collection $permissions
 *
 * @package App\Models
 */
class Privilege extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'module_id' => 'int',
		'role_id' => 'int'
	];

	protected $fillable = [
		'module_id',
		'role_id'
	];

	public function module()
	{
		return $this->belongsTo(\App\Models\Module::class);
	}

	public function role()
	{
		return $this->belongsTo(\App\Models\Role::class);
	}

	public function permissions()
	{
		return $this->belongsToMany(\App\Models\Permission::class, 'privileges_has_permissions', 'privileges_id', 'permissions_id');
	}
}
