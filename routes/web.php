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
    // return view('welcome');
    return view('home');
});

Route::get('/dates-shift-a', [DateContoller::class, 'shiftA']);
Route::get('/dates-shift-b', [DateContoller::class, 'shiftB']);
Route::get('/dates-shift-c', [DateContoller::class, 'shiftC']);
Route::get('/dates-shift-d', [DateContoller::class, 'shiftD']);
Route::get('/dates', [DateContoller::class, 'publicShift']);
Route::post('/submit', [DateContoller::class, 'submit']);
Route::post('/add-new-employee', [DateContoller::class, 'addEmployee'])->name('addEmployee');
Route::get('/generatepdf', [DateContoller::class, 'generatepdf'])->name('user.pdf');