<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\User;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::create([
            'name' => 'Acme Corp',
            'website' => 'https://acme.com',
            'location' => 'New York',
            'user_id' => User::first()->id ?? 1, // fallback if no user exists
        ]);
    }
}