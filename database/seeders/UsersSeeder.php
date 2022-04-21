<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $all_data = []; 
        for ($x = 0; $x < 20; $x++) { 
			$data = [ 
				'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('secret'),
                'api_token' => Str::random(60),
                'remember_token' => Str::random(10), 
				'created_at' => date('Y-m-d H:i:s'), 
				'updated_at' => date('Y-m-d H:i:s'), 
			]; 
			array_push($all_data, $data); 
		} 
         
		User::insert($all_data);  
    }
}
