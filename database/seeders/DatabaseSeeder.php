<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Day;
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
                'name' => 'Principal',
                'location' => 'Sede Central',
                'phone' => '000-000-0000',
                'slug' => Str::slug('principal'),
            ]
        );

        User::create(
            [
                'name' => 'Administrador',
                'email' => "admin@atrion.com",
                'email_verified_at' => now(),
                'password' => Hash::make('admin1234'), // password
                'remember_token' => Str::random(10),
                'place_id' => 1,
                'slug' => Str::slug('Administrador'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        )->assignRole('admin');
        \App\Models\User::factory(15)->create()->each(function ($user) {
            $user->assignRole('Vendedor');
        });
        \App\Models\Client::factory(36)->create();
        Category::create([
            'name' => 'General',
            'meta' => 'Categoría genérica de productos sin clasificar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Company::create([
            'name'=>'Atrion Systems',
            'location'=>'Av. Independencia, No. 22, D. N.',
            'phone'=>'829-804-1907',
            'rnc'=>'402-2184412-2',
            'logo'=>'https://ui-avatars.com/api/?name=Atrion+Systems&color=7F9CF5&background=EBF4FF',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $days=['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo'];
        foreach ($days as $day) {
            Day::create([
                'name'=>$day,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
