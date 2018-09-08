<?php

namespace App;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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


    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class,'emp_id','emp_id');
    }

    /** 
     |--------------------------------------------------------------------------
     | Check Privileges Driver
     |--------------------------------------------------------------------------
     * */
    public function canCreateDriver(){

        return $this->checkPrivilege('Driver','Create');
    }

    public function canReadDriver(){

        return $this->checkPrivilege('Driver','Read');
    }

    public function canUpdateDriver(){

        return $this->checkPrivilege('Driver','Update');
    }

    public function canDeleteDriver(){

        return $this->checkPrivilege('Driver','Delete');
    }

    /**
    |--------------------------------------------------------------------------
    | Check Privileges Vehicle
    |--------------------------------------------------------------------------
     * */
    public function canCreateVehicle(){

        return $this->checkPrivilege('Vehicle','Create');
    }

    public function canReadVehicle(){

        return $this->checkPrivilege('Vehicle','Read');
    }

    public function canUpdateVehicle(){

        return $this->checkPrivilege('Vehicle','Update');
    }

    public function canDeleteVehicle(){

        return $this->checkPrivilege('Vehicle','Delete');
    }

    /**
    |--------------------------------------------------------------------------
    | Check Privileges Journey
    |--------------------------------------------------------------------------
     * */
    public function canCreateJourney(){

        return $this->checkPrivilege('Journey','Create');
    }

    public function canReadJourney(){

        return $this->checkPrivilege('Journey','Read');
    }

    public function canUpdateJourney(){

        return $this->checkPrivilege('Journey','Update');
    }

    public function canDeleteJourney(){

        return $this->checkPrivilege('Journey','Delete');
    }

    public function canRequestJourney(){

        return $this->checkPrivilege('Journey','Request');
    }

    public function canApproveJourney(){

        return $this->checkPrivilege('Journey','Approve');
    }

    public function canConfirmJourney(){

        return $this->checkPrivilege('Journey','Confirm');
    }

    public function canCompleteJourney(){

        return $this->checkPrivilege('Journey','Complete');
    }

    public function canViewOngoingJourneys(){

        return $this->checkPrivilege('Journey','View Ongoing Journeys');
    }

    public function canViewCompletedJourneys(){

        return $this->checkPrivilege('Journey','View Completed Journeys');
    }



    /**
     * @return bool
     */
    private function checkPrivilege(String $module_name, String $permission_name): bool
    {
        foreach ($this->role->privileges as $privilege) {

            $module = $privilege->module;

            if ($module->name == $module_name) {

                $permissions = $privilege->permissions;

                foreach ($permissions as $permission) {
                    if ($permission->name == $permission_name) {
                        return true;
                    }
                }

            }

        }

        return false;
    }

}
