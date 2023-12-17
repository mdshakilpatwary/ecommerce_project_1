<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteInfo;
use App\Models\IncludeAnother;
use DB;

class Info extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    //    site info  
        DB::table('site_infos')->insert([
            // site info data
        [
            'name' => 'DreamIT',
            'email' => 'dreamit@gmail.com',
            'phone' => '0155484511',
            'main_logo' => '',
            'address' => 'Dhanmondi,Dhaka'
            
        ]
        ]);
        
    //    additional info  
        DB::table('include_anothers')->insert([
            
        [
            'tax_vat' => 0,                       
        ]
        ]);


    }
}
