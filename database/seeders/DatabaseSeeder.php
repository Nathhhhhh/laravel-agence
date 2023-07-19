<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Option;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'email' => 'john@doe.fr'
        ]);
        User::factory(1)->unverified()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => 'patate24',
            'remember_token' => Str::random(10),
        ]);
        $options = Option::factory(10)->create();
        Property::factory(50)
            ->hasAttached($options->random(3))
            ->create();
    }
}
