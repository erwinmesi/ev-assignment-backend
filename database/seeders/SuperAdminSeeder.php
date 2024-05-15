<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Super Admin
        $superAdmin = User::updateOrCreate(
            ['email' => config('app.superadmin.email')],
            [
                'firstname' => 'Super',
                'lastname' => 'Admin',
                'password' => bcrypt(config('app.superadmin.password')),
                'email_verified_at' => now(),
            ]
        );

        // Assign Super Admin Role to newly created Super Admin
        if ($superAdmin->wasRecentlyCreated) {
            // Get Super Admin Role
            $superAdminRole = Role::where('name', config('roles.default.superadmin.name'))->first();

            // Assign Super Admin Role to Super Admin
            $superAdmin->roles()->attach($superAdminRole->id);
        }
    }
}
