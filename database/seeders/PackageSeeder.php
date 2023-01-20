<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            ['name'=>'A','price'=>'150000'],
            ['name'=>'B','price'=>'200000'],
            ['name'=>'C','price'=>'300000'],
        ];
        Package::insert($packages);
    }
}
