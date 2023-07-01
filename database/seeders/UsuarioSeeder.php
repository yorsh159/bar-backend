<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' =>'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role'=>'admin',
            'codigo'=>'A0001',
            'estado'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' =>'maya',
            'email' => 'maya@maya.com',
            'password' => bcrypt('maya1234'),
            'role'=>'caja',
            'codigo'=>'C0001',
            'estado'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
    }
}
