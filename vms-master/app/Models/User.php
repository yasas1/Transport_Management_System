<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 14 May 2018 09:54:01 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $role_id
 * @property int $is_active
 * @property string $token
 * @property string $avatar
 * @property string $emp_id
 * 
 * @property \App\Models\Role $role
 *
 * @package App\Models
 */
class User extends Eloquent
{

    protected $connection = 'mysql';

	protected $casts = [
		'role_id' => 'int',
		'is_active' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'token',
        'access_token',
        'refresh_token'
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'remember_token',
		'role_id',
		'is_active',
		'token',
		'avatar',
		'emp_id',
        'access_token',
        'refresh_token'
	];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class,'emp_id','emp_id');
    }

    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

}
