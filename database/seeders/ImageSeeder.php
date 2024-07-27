<?php

namespace Database\Seeders;

use App\Models\Image;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facker = Factory::create();

        for ($i = 1; $i <= 35; $i++)
        {
            DB::table('images')->insert([
//                'path' => $facker->imageUrl(),
                'path' => $facker->randomElement([
                    'files/1.jpg',
                    'files/2.jpg',
                    'files/3.jpg',
                    'files/4.jpg',
                    'files/5.jpg',
                    'files/6.jpg',
                    'files/7.jpg',
                    'files/8.jpg',
                    'files/9.jpg',
                    'files/10.jpg',
                    'files/11.jpg',
                    'files/12.jpg',
                    'files/13.jpg',
                    'files/14.jpg',
                    'files/15.jpg',
                ]),
                'imageable_type' => 'App\Models\Post',
                'imageable_id' => $i,
                'created_at' => $facker->dateTimeBetween('-3 months')
            ]);
        }
    }
}
