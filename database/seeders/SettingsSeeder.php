<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'site_logo',
                'value' => 'images/settings/157953324_32e953b4-6c44-4811-b0c5-f527556d7b4f.png',
            ],
            [
                'key' => 'site_name',
                'value' => 'Book Heaven',
            ],
            [
                'key' => 'site_phone',
                'value' => '0123456789',
            ],
            [
                'key' => 'site_email',
                'value' => 'abcd@gmail.com'],
            [
                'key' => 'vat_percentage',
                'value' => '7.5'],
        ];
        Settings::insert($settings);
    }
}
