<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WishController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\PortfolioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class,'list']);

Route::get('/wish/{id}', [PageController::class,'show']);

Route::resource('/wishes', WishController::class, ['only' => ['index','store']]);

Route::resource('/subscribes', SubscribeController::class, ['only' => ['index','show','store']]);

Route::get('/portfolio/{id}', [PortfolioController::class,'show']);
