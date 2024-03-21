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
            'id' => '9b9ccdd5-7ef0-48ea-957c-244ef1c960d3',
            'name' => 'admin',
        ]);

        // Create editor role
        Role::create([
            'id' => '9b9ccdd5-8076-42cf-8e92-07efd3d90674',
            'name' => 'editor',
        ]);
    }
}
