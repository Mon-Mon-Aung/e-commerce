<?php

use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Client\Response;
use App\Http\Controllers\AcumaticaController;

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

Route::get('/', function () {
    // (new SendWelcomeEmail())->handle();
    SendWelcomeEmail::dispatch()->delay(5);
    return view('welcome');
});


Route::get('/login-acumatica', [AcumaticaController::class,'login']);

Route::get('/products', [AcumaticaController::class, 'products']);