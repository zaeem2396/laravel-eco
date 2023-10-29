<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['custom.url'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/products',[ ProductController::class, 'products']);
    
});





