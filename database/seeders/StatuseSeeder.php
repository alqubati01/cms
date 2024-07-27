<?php

namespace Database\Seeders;

use App\Models\Statuse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatuseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = collect(['Pending', 'Publish', 'Draft']);

        $statuses->each(function ($statusName) {
            $status = new Statuse();
            $status->name = $statusName;
            $status->save();
        });
    }
}
