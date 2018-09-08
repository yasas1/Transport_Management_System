<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 04:29:01 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Division
 * 
 * @property int $dept_id
 * @property string $dept_name
 * @property string $head
 * @property string $email
 * @property \Carbon\Carbon $start
 * @property \Carbon\Carbon $end
 * @property int $status
 * @property string $area
 *
 * @package App\Models
 */
class Division extends Eloquent
{
    protected $connection = 'con_employee';
	protected $table = 'division';
	protected $primaryKey = 'dept_id';
	public $timestamps = false;

	protected $casts = [
		'status' => 'int'
	];

	protected $dates = [
		'start',
		'end'
	];

	protected $fillable = [
		'dept_name',
		'head',
		'email',
		'start',
		'end',
		'status',
		'area'
	];

	public function head(){
        return $this->hasOne(\App\Models\Employee::class,'emp_divison_id','dept_id');
    }

}
