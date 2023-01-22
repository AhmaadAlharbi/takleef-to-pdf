<?php

use App\Http\Controllers\DateContoller;
use App\Http\Controllers\TakleefListController;
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

// Route::get('/', function () {
//     // return view('welcome');
//     return view('home');
// });

Route::get('/dates-shift-a', [TakleefListController::class, 'shiftA']);
Route::get('/dates-shift-b', [TakleefListController::class, 'shiftB']);
Route::get('/dates-shift-c', [TakleefListController::class, 'shiftC']);
Route::get('/dates-shift-d', [TakleefListController::class, 'shiftD']);
Route::get('/dates', [TakleefListController::class, 'publicShift']);
Route::get('/', [TakleefListController::class, 'takleefList']);
Route::get('/show/{id}', [TakleefListController::class, 'show']);
Route::get('/edit-takleef/{id}', [TakleefListController::class, 'edit'])->name('edit-takleef');
Route::post('/search', [TakleefListController::class, 'getTakleef'])->name('getTakleef');
Route::post('/update/{id}', [TakleefListController::class, 'update'])->name('update');
// Route::get('/takleef-december', [TakleefListController::class, 'december']);
Route::post('/submit', [TakleefListController::class, 'submit']);
// Route::post('/submit/december', [TakleefListController::class, 'submitDecember']);
Route::post('/add-new-employee', [DateContoller::class, 'addEmployee'])->name('addEmployee');
