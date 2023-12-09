<?php

use App\Http\Controllers\sendEmailController;
use Illuminate\Support\Facades\Log;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/send_emails', [sendEmailController::class, 'form'])->name('send_emails_form');
Route::post('/send_emails', [sendEmailController::class, 'send_emails'])->name('send_emails');

Route::get('/log' , function () {
//    Log::channel('send_emails')->info('Emails  ', [
//
//    ]);
});



