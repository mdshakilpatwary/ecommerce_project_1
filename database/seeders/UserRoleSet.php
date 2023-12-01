<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleSet extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =User::find(1);

        if($user == true){ 
          $user->assignRole('superadmin');   
        }
        $user->update();
    }
}
