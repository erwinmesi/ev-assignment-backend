<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\UpsertUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Lis all roles except the `superadmin` role.
     */
    public function index()
    {
        $users = User::exceptSuperAdmin()
            ->when(request('role_id'), function ($query, $role_id) {
                return $query->whereHas('roles', function ($query) use ($role_id) {
                    $query->where('roles.id', $role_id);
                });
            })
            ->with('roles:id,name')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($users);
    }

    /**
     * Create a new user.
     */
    public function store(UpsertUserRequest $request)
    {
        // Create a new user with a random password
        $user = User::create(
            array_merge(
                $request->all(),
                ['password' => app(AuthHelper::class)->generateRandomPassword()]
            )
        );

        // Assign roles to the user
        $user->roles()->attach($request->role_ids);

        return response()->json($user->load('roles'));
    }

    /**
     * Update a user.
     */
    public function update(UpsertUserRequest $request, User $user)
    {
        $user->update($request->all());

        // Assign new roles to the user
        $user->roles()->sync($request->role_ids);

        return response()->json($user);
    }

    /**
     * Delete a user except the `superadmin` user.
     */
    public function destroy(DeleteUserRequest $request, User $user)
    {
        $user->delete();

        return response()->json(null);
    }
}
