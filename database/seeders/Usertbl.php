<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Usertbl extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::insert([
            // admin login data
        [
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'Admin',
        ]
        ]);



        
    }
}

