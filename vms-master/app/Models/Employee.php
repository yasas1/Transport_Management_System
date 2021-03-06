<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 26 Apr 2018 04:26:31 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Employee
 * 
 * @property int $r_id
 * @property string $emp_id
 * @property string $emp_email
 * @property string $fp_id
 * @property string $emp_fullname
 * @property string $emp_firstname
 * @property string $emp_surname
 * @property string $emp_initials
 * @property \Carbon\Carbon $emp_dob
 * @property string $emp_nic
 * @property string $emp_gender
 * @property string $emp_title
 * @property string $emp_permanent_address
 * @property string $emp_tmp_address
 * @property string $emp_offic_num
 * @property string $emp_mobile_num
 * @property string $emp_designation
 * @property string $emp_designation_grade
 * @property \Carbon\Carbon $emp_des_start_date
 * @property \Carbon\Carbon $emp_last_increament_date
 * @property int $increament_scale
 * @property string $emp_state
 * @property string $emp_type
 * @property string $emp_divison_id
 * @property \Carbon\Carbon $emp_first_emp_date
 * @property string $emp_pic
 * @property string $emp_qulif_sort_form
 * @property int $emp_comment
 *
 * @package App\Models
 */
class Employee extends Eloquent
{
    protected $connection = 'con_employee';

	protected $table = 'employee';
	protected $primaryKey = 'r_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'increament_scale' => 'int',
		'emp_comment' => 'int'
	];

	protected $dates = [
		'emp_dob',
		'emp_des_start_date',
		'emp_last_increament_date',
		'emp_first_emp_date'
	];

	protected $fillable = [
		'emp_email',
		'fp_id',
		'emp_fullname',
		'emp_firstname',
		'emp_surname',
		'emp_initials',
		'emp_dob',
		'emp_nic',
		'emp_gender',
		'emp_title',
		'emp_permanent_address',
		'emp_tmp_address',
		'emp_offic_num',
		'emp_mobile_num',
		'emp_designation',
		'emp_designation_grade',
		'emp_des_start_date',
		'emp_last_increament_date',
		'increament_scale',
		'emp_state',
		'emp_type',
		'emp_divison_id',
		'emp_first_emp_date',
		'emp_pic',
		'emp_qulif_sort_form',
		'emp_comment'
	];


    public static function divisionalHead($email){

        if($employee = Employee::where('emp_email','=',$email)->first()){

            if($division = \App\Models\Employee\Division::where('dept_id','=', $employee->emp_divison_id)->first()){

                if ($division->head){

                    if ($division->head == $employee->emp_id){
//                    Directors Email is hardcoded because of data integrity of employee designation column
                        return '000147';

                    }else{
                        return $division->head;
                    }

                }

                return '000147';

            }
        }

        return false;
    }

    public function division(){

        return $this->belongsTo(\App\Models\Employee\Division::class,'emp_divison_id','dept_id');

    }

    public function designation(){

        return $this->belongsTo(\App\Models\Designation::class,'emp_designation','desig_id');

	}
	
    public function getFullNameAttribute(){
        return $this->emp_title.'. '.$this->emp_initials.'. '.$this->emp_surname;
	}
	
	public function getShortNameAttribute(){
        return $this->emp_title.'. '.$this->emp_initials.'. '.$this->emp_surname;
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class,'emp_id','emp_id');
    }

    public function divHead()
    {
        return $this->division->devHead;
    }
}
