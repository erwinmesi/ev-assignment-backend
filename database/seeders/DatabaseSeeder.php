<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed the roles first because the `SuperAdminSeeder` needs the `superamin` role.
        $this->call(RolesSeeder::class);

        // Then seed the Super Admin
        $this->call(SuperAdminSeeder::class);
    }
}
