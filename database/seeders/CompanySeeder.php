<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // Grab the user we just created in DatabaseSeeder
        $user = User::first() ?? User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create a demo company for that user (idempotent)
        Company::firstOrCreate(
            ['user_id' => $user->id, 'name' => 'Acme Corp'],
            ['website' => 'https://acme.com', 'location' => 'New York']
        );
    }
}