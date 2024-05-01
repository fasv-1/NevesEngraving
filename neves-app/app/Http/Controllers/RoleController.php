<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Build some intructions to the controller
     */
    public function __construct()
    {
        // $this->middleware(['role:Dev']);
        // $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        // $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        // $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        // return view('roles.index', compact('roles'));
        return response()->json($roles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.create', compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Admin permissions
        // $permissions = [
        //     'profile',
        //     'user-list',
        //     'dashboard-list',
        //     'dashboard-create',
        //     'dashboard-edit',
        //     'product-list',
        //     'product-create',
        //     'product-edit',
        //     'product-delete'
        // ];
        // Super-Admin permissions
        // $permissions = [
        //     'role-list',
        //     'role-create',
        //     'role-edit',
        //     'role-delete',
        //     'product-list',
        //     'product-create',
        //     'product-edit',
        //     'product-delete',
        //     'profile',
        //     'user-list',
        //     'user-create',
        //     'user-edit',
        //     'user-delete',
        //     'dashboard-list',
        //     'dashboard-create',
        //     'dashboard-edit',
        //     'dashboard-delete',
        // ];
        // User permissions
        // $permissions = [
        //     'profile',
        //     'user-create',
        //     'user-edit',
        //     'user-delete',
        // ];

        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $permission = Permission::create(['name' => $request->input('permission')]);


        $role->syncPermissions($permission);

        // $role->syncPermissions($permissions);
        return response()->json(['msg' => 'Roles and permissions added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        // return view('roles.show', compact('role', 'rolePermissions'));
        return response()->json(['role' => $role, 'permission' => $rolePermissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();


        $role->syncPermissions($request->input('permission'));
        // $role->syncPermissions($permissions);

        return response()->json(['msg' => 'Roles and permissions added successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table("roles")->where('id', $id)->delete();
        // return redirect()->route('roles.index')
        // ->with('success', 'Role deleted successfully');
        return (['msg' => 'Role deleted successfully']);
    }
}
