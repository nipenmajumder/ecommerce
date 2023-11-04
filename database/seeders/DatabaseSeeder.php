<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class
        ]);

        User::factory()->create([
            'name' => 'Nipen Majumder',
            'email' => 'amitmojumder356@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user = User::query()->where('email', 'amitmojumder356@gmail.com')->first();
        $user->assignRole('admin');
    }
}
