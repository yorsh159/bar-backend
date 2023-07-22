<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company')->insert([
            'razon_social' => 'PUB BAR',
            'ruc' => '20605053671',
            'direccion'=>'CAL. GENERAL RAMON VARGAS MACH NRO. 410 URB. LOS FICUS LIMA - LIMA - SANTA ANITA',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
