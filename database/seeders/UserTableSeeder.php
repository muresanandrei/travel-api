<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user with admin role
        $userAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@travel.com',
            'password' => bcrypt('12345678'),
        ]);

        // Assign admin role to the user
        $userAdmin->roles()->attach(['9b9ccdd5-7ef0-48ea-957c-244ef1c960d3']);

        // Create editor role
        $userEditor = User::create([
            'name' => 'editor',
            'email' => 'editor@travel.com',
            'password' => bcrypt('12345678'),
        ]);

        // Assign editor role to the user
        $userEditor->roles()->attach(['9b9ccdd5-8076-42cf-8e92-07efd3d90674']);
    }
}
