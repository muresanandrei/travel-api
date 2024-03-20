<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin role
        Role::create([
            'name' => 'admin',
        ]);

        // Create editor role
        Role::create([
            'name' => 'editor',
        ]);
    }
}
