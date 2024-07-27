<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            StatuseSeeder::class,
            PostSeeder::class,
            VideoSeeder::class,
            PodcastSeeder::class,
            TagSeeder::class,
            TaggableSeeder::class,
            CommentSeeder::class,
            ImageSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserRoleSeeder::class,
            PaymentPlatformSeeder::class,
            CurrencySeeder::class,
            PlanSeeder::class,
        ]);
    }
}
