<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'=>'Mr Shahadat', 'district_id'=>5, 'mobile'=>'01910922069', 'address'=>'Banasree, Rampura, Dhaka', 'photo'=>'avatar-1.jpg'],
            ['name'=>'Mr Rubel', 'district_id'=>44, 'mobile'=>'01756603812', 'address'=>'panthapath, Dhanmondi, Dhaka', 'photo'=>'avatar-1.jpg'],
        ];

        Agent::insert($data);
    }
}
