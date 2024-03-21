<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call RolesTableSeeder
        $this->call(RolesTableSeeder::class);

        // Call UserTableSeeder
        $this->call(UserTableSeeder::class);

        // Call TravelTableSeeder
        $this->call(TravelTableSeeder::class);
        // Call TourTableSeeder
        $this->call(TourTableSeeder::class);
    }
}
