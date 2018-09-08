<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 19 May 2018 11:38:47 +0000.
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Role
 * 
 * @property int $id
 * @property string $name
 * 
 * @property \Illuminate\Database\Eloquent\Collection $privileges
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Role extends Eloquent
{
	protected $table = 'role';
	public $timestamps = false;

	protected $fillable = [
		'name'
	];

	public function privileges()
	{
		return $this->hasMany(\App\Models\Privilege::class);
	}

	public function users()
	{
		return $this->hasMany(\App\Models\User::class);
	}

    public static function notAssignedmodules($id)
    {
        if($result = DB::select("SELECT m.id FROM vms.module m, vms.role r, vms.privileges p
where r.id=".$id." and r.id = p.role_id and m.id = p.module_id")){

            $existingModules = array();
            foreach ($result as $item){
                array_push($existingModules,$item->id);
            }
            $modules = Module::whereNotIn('id',$existingModules)->get();

            return $modules;
        }

        return Module::all();
    }

}
