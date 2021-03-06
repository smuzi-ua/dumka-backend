<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        School::factory(10)->create();
    }
}
