<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 21 May 2018 04:13:42 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permission
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $modules
 * @property \Illuminate\Database\Eloquent\Collection $privileges
 *
 * @package App\Models
 */
class Permission extends Eloquent
{
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function modules()
	{
		return $this->belongsToMany(\App\Models\Module::class, 'module_has_permissions', 'permissions_id');
	}

	public function privileges()
	{
		return $this->belongsToMany(\App\Models\Privilege::class, 'privileges_has_permissions', 'permissions_id', 'privileges_id');
	}
}
