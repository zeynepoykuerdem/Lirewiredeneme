<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Psy\Util\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    User::factory()->times(50)->state([
        'created_at'=> fn()=>now()->subMinutes(rand(0,59)),
    ])->create();
    }
}
