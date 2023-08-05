<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Nipen Majumder',
            'email' => 'amitmojumder356@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        Role::insert(
            [
                [
                    'name' => 'admin',
                    'guard_name' => 'web'
                ],
                [
                    'name' => 'customer',
                    'guard_name' => 'web'
                ]
            ]

        );
    }
}
