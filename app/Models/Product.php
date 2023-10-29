<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public static function getProducts() {
        $products = DB::table('products')->select('*')->get();
        return $products;
    }
}
