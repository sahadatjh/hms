<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PreRegistrationFactory extends Factory
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
            'mobile'          => fake()->numerify('##########'),
            'nid'             => fake()->numerify('############'),
            'ng'              => fake()->numerify('##########'),
            'tracking_number' => fake()->numerify('#######'),
            'dob'             => now()->toDateString(),
            'district_id'     => random_int(1,64),
            'gender'          => 'Male',
            'address'         => fake()->address(),
            'remarks'         => fake()->sentence(1),
            'package_id'      =>random_int(1,3),
        ];
    }
}
