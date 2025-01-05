<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
class RoleController extends Controller
{
    public function AllPermission()
    {
        $permissions = Permission::all();
        return view('admin.backend.pages.permission.all_permission', compact('permissions'));

    } // End of method

    public function AddPermission()
    {
        return view('admin.backend.pages.permission.add_permission');

    } // End of method

    public function StorePermission(Request $request)
    {

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);
        $notification = array(
            'message' => $request->name . ' Permission is created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);

    } // End of method
    public function EditPermission($id)
    {
        $permission = Permission::find($id);
        return view('admin.backend.pages.permission.edit_permission', compact('permission'));

    } // End of method
    public function UpdatePermission(Request $request)
    {
        $permission_id = $request->id;
        Permission::find($permission_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);
        $notification = array(
            'message' => $request->name . ' Permission is Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);

    } // End of method
    public function DeletePermission($id)
    {
        $permission = Permission::find($id)->delete();
        $notification = array(
            'message' => 'Permission is Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);

    } // End of method


    //////////////////////////////// Roles start here ///////////////////////////////////////////////////
    public function AllRoles()
    {
        $roles = Role::all();

        return view('admin.backend.pages.role.all_role', compact('roles'));
    } // End of method
    public function AddRole()
    {
        return view('admin.backend.pages.role.add_role');
    } // End of method
    public function StoreRole(Request $request)
    {

        Role::create([
            'name' => $request->name
        ]);
        $notification = array(
            'message' => $request->name . ' Role is created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    } // End of method
    public function EditRole($id)
    {
        $role = Role::find($id);
        return view('admin.backend.pages.role.edit_role', compact('role'));
    } // End of method
    public function UpdateRole(Request $request)
    {
        Role::find($request->id)->update([
            'name' => $request->name
        ]);
        $notification = array(
            'message' => $request->name . ' Role is Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    } // End of method
    public function DeleteRole($id)
    {
        Role::find($id)->delete();
        $notification = array(
            'message' => ' Role is Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);
    } // End of method


    //////////////////////////////// Add Roles Permission start here ///////////////////////////////////////////////////
    public function AddRolesPermission()
    {
        $role = Role::all();
        $permissions = Permission::all();
        $permission_group = User::getpermissionGroups();
        return view('admin.backend.pages.rolesetup.add_roles_permission', compact('permissions', 'role', 'permission_group'));
    } // End of method
    public function RolePermissionStore(Request $request)
    {
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }


        $notification = array(
            'message' => ' Role Permission Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);


    } // End of method
    public function AllRolePermission(Request $request)
    {
        $roles = Role::all();
        return view('admin.backend.pages.rolesetup.all_roles_permission', compact('roles'));
    } // End of method
    public function AdminEditRolePermission($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_group = User::getpermissionGroups();
        return view('admin.backend.pages.rolesetup.edit_roles_permission', compact('permissions', 'role', 'permission_group'));
    } // End of method
    public function AdminUpdateRolePermission(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        // Fetch permissions by their IDs and extract names
        $permissions = $request->permission;
        if (!empty($permissions)) {
            $permissionNames = Permission::whereIn('id', $permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames); // Sync with permission names
        }

        $notification = array(
            'message' => 'Role Permission Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }    // End of method
    public function AdminDeleteRolePermission($id)
    {
        $role = Role::findOrFail($id);

        if (!is_null($role)) {
            $role->delete();
        }

        $notification = array(
            'message' => 'Role Permission Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }    // End of method
    public function ImportPermissions()
    {

        return view('admin.backend.pages.permission.importPermissions');
    }    // End of method

}
