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
        'token',
        'refresh_token'
    ];


    public function role()
    {
        return $this->belongsTo(\App\Models\Role::class);
    }

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class,'emp_id','r_id');
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

    public function canCancelJourney(){ 

        return $this->checkPrivilege('Journey','Cancel');
    }

    public function canChangeJourneyDetails(){

        return $this->checkPrivilege('Journey','Change Journey Details');
    }

    public function canRequestJourney(){

        return $this->checkPrivilege('Journey','Request');
    }

    public function canApproveJourney(){

        return $this->checkPrivilege('Journey','Approve');
    }
    public function canApproveLongDistanceJourney(){

        return $this->checkPrivilege('Journey','Approve Long Distance Journey');
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
    public function canViewCancelledJourneys(){

        return $this->checkPrivilege('Journey','View Cancelled Journeys');
    }

    public function canViewCompletedJourneys(){

        return $this->checkPrivilege('Journey','View Completed Journeys');
    }

    public function canViewMyJourneys(){

        return $this->checkPrivilege('Journey','View My Journey Requests');
    }

    public function canCreateViewBacklogJourneys(){

        return $this->checkPrivilege('Journey','Create View Backlog Journey');
    }
    public function canApproveBacklogJourneys(){
        
        return $this->checkPrivilege('Journey','Approve Backlog Journey');
    }

    /// Vehicle servicing

    public function canCreateVehicleSeriving(){
        
        return $this->checkPrivilege('Vehicle Servicing','Create');
    }

    public function canReadVehicleSeriving(){
        
        return $this->checkPrivilege('Vehicle Servicing','Read');
    }

    public function canUpdateVehicleSeriving(){

        return $this->checkPrivilege('Vehicle Servicing','Update');
    }
    public function canDeleteVehicleSeriving(){
        
        return $this->checkPrivilege('Vehicle Servicing','Delete');
    }

    /// Vehicle Repair

    public function canCreateVehicleRepair(){

        return $this->checkPrivilege('Vehicle Repair','Create');
    }

    public function canUpdateVehicleRepair(){

        return $this->checkPrivilege('Vehicle Repair','Update');
    }
    public function canDeleteVehicleRepair(){
        
        return $this->checkPrivilege('Vehicle Repair','Delete');
    }

    /// Vehicle Annual Licences

    public function canCreateVehicleLicence(){

        return $this->checkPrivilege('Vehicle Licence','Create');
    }

    public function canUpdateVehicleLicence(){

        return $this->checkPrivilege('Vehicle Licence','Update');
    }
    public function canDeleteVehicleLicence(){
        
        return $this->checkPrivilege('Vehicle Licence','Delete');
    }

    /// Vehicle Accident

    public function canCreateVehicleAccident(){

        return $this->checkPrivilege('Vehicle Accident','Create');
    }

    public function canUpdateVehicleAccident(){

        return $this->checkPrivilege('Vehicle Accident','Update');
    }
    public function canDeleteVehicleAccident(){
        
        return $this->checkPrivilege('Vehicle Accident','Delete');
    }

    /// Vehicle Mileage
    
    public function canCreateVehicleMileage(){

        return $this->checkPrivilege('Vehicle Mileage','Create');
    }

    public function canUpdateVehicleMileage(){

        return $this->checkPrivilege('Vehicle Mileage','Update');
    }
    public function canDeleteVehicleMileage(){
        
        return $this->checkPrivilege('Vehicle Mileage','Delete');
    }

    /// Vehicle Fuel Usage

    public function canCreateVehicleFuelUsage(){

        return $this->checkPrivilege('Vehicle FuelUsage','Create');
    }

    public function canUpdateVehicleFuelUsage(){

        return $this->checkPrivilege('Vehicle FuelUsage','Update');
    }
    public function canDeleteVehicleFuelUsage(){
        
        return $this->checkPrivilege('Vehicle FuelUsage','Delete');
    }

    /// Vehicle Tyre Replacement

    public function canCreateTyreReplacement(){

        return $this->checkPrivilege('Vehicle Tyre Replacement','Create');
    }

    public function canUpdateTyreReplacement(){

        return $this->checkPrivilege('Vehicle Tyre Replacement','Update');
    }
    public function canDeleteTyreReplacement(){
        
        return $this->checkPrivilege('Vehicle Tyre Replacement','Delete');
    }

    /// Vehicle Tyre Position Change

    public function canCreateTyrePositionChange(){

        return $this->checkPrivilege('Vehicle Tyre Position Change','Create');
    }

    public function canUpdateTyrePositionChange(){

        return $this->checkPrivilege('Vehicle Tyre Position Change','Update');
    }
    public function canDeleteTyrePositionChange(){
        
        return $this->checkPrivilege('Vehicle Tyre Position Change','Delete');
    }

    public function division(){

        if ($employee = Employee::where('emp_email','=',$this->email)->first()){

            if($division = Division::where('dept_id','=',$employee->emp_divison_id)->first()){

                return $division->dept_name;

            }

        }

        return null;

    }

    public function designation(){

        if ($employee = Employee::where('emp_email','=',$this->email)->first()){

            if($division = Designation::where('desig_id','=',$employee->emp_designation)->first()){

                return $division->des_name;

            }

        }

        return null;
    }

    public function canViewUser(){

        return $this->checkPrivilege('User','Read');
    }

    public function canUpdateUser(){

        return $this->checkPrivilege('User','Update');
    }

    public function canCreateRole(){

        return $this->checkPrivilege('Role','Create');
    }

    public function canReadRole(){

        return $this->checkPrivilege('Role','Read');
    }

    public function canUpdateRole(){

        return $this->checkPrivilege('Role','Update');
    }

    public function canDeleteRole(){

        return $this->checkPrivilege('Role','Delete');
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
