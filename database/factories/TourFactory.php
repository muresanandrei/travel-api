<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TourFactory extends Factory
{
    protected $model = Tour::class;

    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'name' => $this->faker->sentence,
            'startDate' => $this->faker->date(),
            'endDate' => $this->faker->date(),
            'price' => 1000,
            'travelId' => Travel::factory()->create()->id, // Associate with a travel record
        ];
    }
}
