<?php

namespace Database\Factories;

use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class TravelFactory extends Factory
{
    protected $model = Travel::class;

    public function definition()
    {
      return [
        'id' => Str::uuid(),
        'name' => $this->faker->name,
        'slug' => Str::slug($this->faker->unique()->sentence),
        'description' => $this->faker->paragraph,
        'numberOfDays' => $this->faker->numberBetween(1, 30),
        'moods' => [
            'nature' => $this->faker->numberBetween(0, 100),
            'relax' => $this->faker->numberBetween(0, 100),
            'history' => $this->faker->numberBetween(0, 100),
            'culture' => $this->faker->numberBetween(0, 100),
            'party' => $this->faker->numberBetween(0, 100),
        ],
    ];
    }
}