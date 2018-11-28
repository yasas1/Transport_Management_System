<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use App\Models\Privilege;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    public function index(){
        $roles = Role::all();
        return view('role.index',compact('roles'));
    }

    public function assignNewModule($id){
        $role = Role::whereId($id)->first();
        $modules = Role::notAssignedmodules($id);
        return view('role.assignNewModule',compact('role','modules'));
    }

    public function getPermissionsByModuleId($id){

        if ($id !='' && $module = Module::whereId($id)->first()){
            return response($module->permissions,'200');
        }

        return response('Not Found','501');

    }

    public function getPermissionsByModule(Request $request){

        if ($request->moduleId && $module = Module::whereId($request->moduleId)->first()){
            return response($module->permissions,'200');
        }

        return response('Not Found','501');

    }

    public function storeNewModule(Request $request){

        if($role = Role::whereId($request->role_id)->first()){

            $privilege = new Privilege;
            $privilege->module_id = $request->module_id;
            $privilege->role_id = $request->role_id;
            $privilege->save();

            $privilege->permissions()->attach($request->permission_ids);
            $privilege->update();

            return redirect()->back()->with(['success'=>'User module assigned successfully!.']);

        }


    }

    public function editPerimssionsByModule($rId,$mId){

        if($rId!=''){
            if($role = Role::whereId($rId)->first()){
                $permissions =  $role->privileges->where('module_id','=',$mId)->first()->permissions;
                $module = Module::whereId($mId)->first();
                return view('role.editPrivilegesByModule',compact('role','permissions','module'));
            }
        }

    }

    public function updatePermissionsByModule(Request $request){

        if($role = Role::whereId($request->role_id)->first()){

            $privilege = Privilege::whereRoleId($request->role_id)->whereModuleId($request->module_id)->first();
            $privilege->permissions()->detach();
            $privilege->permissions()->attach($request->permission_ids);
            $privilege->update();

            return redirect()->back()->with(['success'=>$privilege->module->name." module's permissions updated successfully!"]);

        }

    }

    public function deletePrivilege($id){

        if($privilege = Privilege::whereId($id)->first()){
            $role = $privilege->role;
            $module = $privilege->module;
            $privilege->delete();
            return redirect()->back()->with(['success'=>$module->name.' module deleted from '.$role->name.' successfully!.']);
        }

        return redirect()->back()->withErrors(['error'=>'Sorry. module cannot find !']);

    }

    public function create(){
        $modules = Module::all();
        return view('role.create',compact('modules'));
    }

    public function store(Request $request){
       $this->validate($request,[
           'name'=>'required'
       ]);

       if ($request->name){
           $role = new Role;
           $role->name = $request->name;
           $role->save();
       }

        if ($request->permissions){
            foreach ($request->permissions as $permission)
            $privilege = new Privilege;
            $privilege->module_id = $permission->module_id;
        }

    }

}
