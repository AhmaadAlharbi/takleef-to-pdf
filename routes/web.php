<?php

use App\Http\Controllers\DateContoller;
use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dates', [DateContoller::class, 'index']);
Route::post('/submit', [DateContoller::class, 'submit']);
Route::get('/generatepdf/{id}', [DateContoller::class, 'generatepdf'])->name('user.pdf');