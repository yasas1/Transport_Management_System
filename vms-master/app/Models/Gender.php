<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 01 Mar 2018 10:01:06 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Gender
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $employees
 *
 * @package App\Models
 */
class Gender extends Eloquent
{
    protected $connection = 'con_employee';
	protected $table = 'gender';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function employees()
	{
		return $this->hasMany(\App\Models\Employee::class);
	}
}
