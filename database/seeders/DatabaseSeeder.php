<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(18)->create();

        User::factory()->create([
            'uuid' => Str::uuid(),
            'name' => 'Aliyev Ali',
            'description' => 'Baku, Azerbaijan',
            'email' => 'aliyev.ali@erp-intel.az',
            'password' => bcrypt('Salam123'),
            'role' => 'Excellent',
        ]);
    }
}
