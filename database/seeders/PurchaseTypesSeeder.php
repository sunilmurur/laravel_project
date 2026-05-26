<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('purcahse_types')->delete(); // optional reset

        DB::table('purcahse_types')->insert([
            [
                'type' => 'Akki',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Kai',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Oil',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        
    }
}