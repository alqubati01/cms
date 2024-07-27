<?php

namespace Database\Seeders;

use App\Models\Podcast;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaggableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facker = Factory::create();

        for ($i = 1; $i <= 50; $i++)
        {
            DB::table('taggables')->insert([
                'tag_id' => mt_rand(1, 10),
                'taggable_type' => 'App\Models\Post',
                'taggable_id' => mt_rand(1, 25),
                'created_at' => $facker->dateTimeBetween('-3 months')
            ]);

            DB::table('taggables')->insert([
                'tag_id' => mt_rand(1, 10),
                'taggable_type' => 'App\Models\Video',
                'taggable_id' => mt_rand(1, 25),
                'created_at' => $facker->dateTimeBetween('-3 months')
            ]);

            DB::table('taggables')->insert([
                'tag_id' => mt_rand(1, 10),
                'taggable_type' => 'App\Models\Podcast',
                'taggable_id' => mt_rand(1, 25),
                'created_at' => $facker->dateTimeBetween('-3 months')
            ]);
        }
    }
}
