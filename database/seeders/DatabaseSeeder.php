<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                RoleSeeder::class
            ]
        );
        \App\Models\User::factory(15)->create()->each( function ($user)
        {
            $user->assignRole('worker');
        });
        User::create(
            [
                'name' => 'Administrador',
                'email' => "admin@atrion.com",
                'email_verified_at' => now(),
                'password' => Hash::make('admin1234'), // password
                'remember_token' => Str::random(10),
                'is_active' => 1,
                'slug' => Str::slug('Administrador'),
                'created_at' => now(),
                'updated_at' => now(),
            ])->assignRole('admin');
        
    }
}
