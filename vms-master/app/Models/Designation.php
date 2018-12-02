<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 11 Mar 2018 13:23:29 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Designation
 * 
 * @property int $r_id
 * @property string $desig_id
 * @property string $desig_type
 * @property string $des_name
 * @property int $status
 * @property string $salary_code
 * @property string $service
 * @property string $comment
 *
 * @package App\Models
 */
class Designation extends Eloquent
{
    protected $connection = 'con_employee';

	protected $table = 'designation';
	protected $primaryKey = 'desig_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'r_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		'r_id',
		'desig_type',
		'des_name',
		'status',
		'salary_code',
		'service',
		'comment'
	];
}
