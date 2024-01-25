<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin SamariCode',
            'email' => 'admin@samaricode.my.id',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'group_id' => 1,
            'remember_token' => \Illuminate\Support\Str::random(10),
            'nik' => '1402020607084494',
            'pob' => 'Cirebon',
            'dob' => \Carbon\Carbon::create(1999, 8, 5)->startOfDay(),
        ]);

        \App\Models\User::factory(999)->create();
    }
}
