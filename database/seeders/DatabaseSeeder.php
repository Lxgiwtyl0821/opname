<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'alamat' => 'admin',
            'no_telp' => '08821212',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'manager',
            'alamat' => 'manager',
            'no_telp' => '08821212',
            'email' => 'manager@manager.com',
            'password' => bcrypt('123'),
            'role' => 'manager',
        ]);

        DB::table('users')->insert([
            'name' => 'warehouse',
            'alamat' => 'warehouse',
            'no_telp' => '08821212',
            'email' => 'warehouse@warehouse.com',
            'password' => bcrypt('123'),
            'role' => 'warehouse',
        ]);

        $data_satuan = [
            [
                'name' => 'PCS',
            ],
            [
                'name' => 'SACHET',
            ],
            [
                'name' => 'PACK',
            ],
            [
                'name' => 'TAB',
            ], 
            [
                'name' => 'LBR',
            ],
            [
                'name' => 'LITER',
            ],
            [
                'name' => 'KG',
            ],
            [
                'name' => 'CUP',
            ],
        ];
        foreach($data_satuan as $ds){
            DB::table('satuan')->insert($ds);
        }
    }
}
