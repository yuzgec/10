<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin kullanıcısı oluştur
        User::create([
            'name' => 'Admin',
            'email' => 'olcayy@gmail.com',
            'password' => Hash::make('DEneme1911'),
            'email_verified_at' => now(),
        ])->assignRole('admin');

        // Test kullanıcısı oluştur
        User::create([
            'name' => 'Editor',
            'email' => 'editor@editor.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ])->assignRole('editor');
    }
}
