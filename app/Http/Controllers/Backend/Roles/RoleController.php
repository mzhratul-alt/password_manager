<?php

namespace App\Http\Controllers\Backend\Roles;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //Role Index Page
    public function roleIndex()
    {
        $allRole = Role::select('id', 'name')->get()->except(1);
        return view('backend.roles.roleIndex', compact('allRole'));
    }


    //Role Store

    public function roleStore(Request $request)
    {
        $newrole = $request->validate([
            'name' => 'required',
        ]);

        Role::create($newrole);
        return back();
    }

    //Role Show
    public function roleShow(Request $request, $id)
    {
        $role = Role::find($id, ['id', 'name', 'guard_name']);
        $allPermission = Permission::select('id', 'name', 'group_name')->get()->groupBy('group_name');
        return view('backend.roles.roleShow', compact('role', 'allPermission'));
    }
    //Role Update
    public function roleUpdate(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'name' => 'required|unique:roles,name,' . $request->id,
        ]);

        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->save();

        if (!empty($request->permissions)) {
            $role = Role::findByName($request->name);

            $role->syncPermissions($request->permissions);
        }
        return back();
    }

    //Role Delete Option
    public function roleDelete(Request $request, $id){
        $role = Role::find($id);

        $role->delete();

        return redirect()->route('admin.role.index');
    }
}
