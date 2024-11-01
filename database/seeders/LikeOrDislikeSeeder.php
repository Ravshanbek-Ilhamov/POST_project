<?php

namespace Database\Seeders;

use App\Models\LikeOrDislike;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeOrDislikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LikeOrDislike::factory(60)->create();
    }
}
