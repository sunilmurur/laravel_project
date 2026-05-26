<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment_types')->delete(); // optional reset

        DB::table('payment_types')->insert([
            [
                'payment_type' => 'Cash',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_type' => 'UPI',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'payment_type' => 'Net Banking',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        
    }
}