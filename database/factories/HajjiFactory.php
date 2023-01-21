<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class HajjiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'            => fake()->name(),
            'fathers_name'    => fake()->name(),
            'mothers_name'    => fake()->name(),
            'spouse_name'     => fake()->name(),
            'occupation'      => 'Govt Job',
            'mobile'          => Str::random(11),
            'nid'             => Str::random(17),
            'ng'              => Str::random(17),
            'tracking_number' => Str::random(17),
            'dob'             => now()->toDateString(),
            'district_id'     => District::factory(),
            'gender'          => 'Male',
            'address'         => fake()->address(),
        ];
    }
}
