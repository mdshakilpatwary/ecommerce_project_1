<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteInfo;
use DB;

class Info extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_infos')->insert([
            // admin login data
        [
            'name' => 'DreamIT',
            'email' => 'dreamit@gmail.com',
            'phone' => '0155484511',
            'main_logo' => '',
            'address' => 'Dhanmondi,Dhaka'
            
        ]
        ]);
    }
}
