<?php

namespace Database\Seeders;

use App\Models\Place;
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
        Place::create(
            [
                'name'=>'Principal',
                'location'=>'Sede Central',
                'phone'=>'000-000-0000',
                'slug'=>Str::slug('principal'),
                'is_active'=>1,
            ]
            );
        \App\Models\User::factory(15)->create()->each( function ($user)
        {
            $user->assignRole('vendedor');
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
