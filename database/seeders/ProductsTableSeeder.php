<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 100 ; $i++) { 
            DB::table('products')->insert([
                'id' => $i,
                'prodName' => 'prod_id_'.$i,
                'prodPrice' => rand(599, 999),
                'prodDesc' => Str::random(50),
                'prodimg' => 'https://lorempixel.com/400/200/?' . Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
