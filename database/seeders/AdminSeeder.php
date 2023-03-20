<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        \App\Models\User::factory()->create([
            'name' => 'TesUser',
            'email' => 'test@example.com',
            'password' => 'secret',
        ])->assignRole(\Spatie\Permission\Models\Role::create(['name' => 'admin']));
    }
}
