<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Post;

class PostsSeeder extends Seeder
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
        for ($x = 0; $x <= 500; $x++) { 
			$data = [ 
                'user_id' => rand(1,20),
                'title' => $faker->sentence,
                'content' => $faker->paragraphs(rand(3, 10), true),
                'published' => $faker->boolean,
				'created_at' => date('Y-m-d H:i:s'), 
				'updated_at' => date('Y-m-d H:i:s'), 
			]; 
			array_push($all_data, $data); 
		} 
         
		Post::insert($all_data);
    }
}
