<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(
            [
            'name' => 'Super Admin',
            'email' => 'superadmin@smkn9bekasi.sch.id',
            'password'=> bcrypt('superadmin1'),
            'is_admin' => true
            ]
    );
    }
}
