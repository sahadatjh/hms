<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DistrictSeeder extends Seeder
{
    private $jsonPath = 'json/district.json';

    public function run()
    {
        $jsonData     = file_exists(public_path($this->jsonPath)) ? File::get(public_path($this->jsonPath)) : [];
        $districts = json_decode($jsonData);

        foreach ($districts as $district) {
            District::create([
                'id'          => $district->id,
                'division_id' => $district->division_id,
                'name'        => $district->name,
                'name_bn'     => $district->bn_name,
                'lat'         => $district->lat,
                'long'        => $district->long
            ]);
        }
    }
}
