<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\DeleteRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Lis all roles except the `superadmin` role.
     */
    public function index()
    {
        $users = Role::exceptSuperAdmin()
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($users);
    }

    /**
     * Create a new role.
     */
    public function store(CreateRoleRequest $request)
    {
        $role = Role::create($request->all());

        return response()->json($role);
    }

    /**
     * Update a role except the `superadmin` role.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());

        return response()->json($role);
    }

    /**
     * Delete a role except the `superadmin` role.
     */
    public function destroy(DeleteRoleRequest $request, Role $role)
    {
        $role->delete();

        return response()->json(null);
    }
}
