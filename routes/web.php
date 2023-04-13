<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DateContoller;
use App\Http\Controllers\TakleefListController;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

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
    // return view('welcome');
    return view('home');
});

Route::get('/dates-shift-a', [TakleefListController::class, 'shiftA']);
Route::get('/dates-shift-b', [TakleefListController::class, 'shiftB']);
Route::get('/dates-shift-c', [TakleefListController::class, 'shiftC']);
Route::get('/dates-shift-d', [TakleefListController::class, 'shiftD']);
Route::get('/dates', [TakleefListController::class, 'publicShift']);
Route::get('/search/{month}', [TakleefListController::class, 'takleefList']);
Route::get('/show/{id}/{month}', [TakleefListController::class, 'show']);
Route::get('/edit-takleef/{id}/{month}', [TakleefListController::class, 'edit'])->name('edit-takleef');
Route::post('/search/{month}', [TakleefListController::class, 'getTakleef'])->name('getTakleef');
Route::post('/update/{id}/{month}', [TakleefListController::class, 'update'])->name('update')->middleware('auth');
// Route::get('/takleef-december', [TakleefListController::class, 'december']);
Route::post('/submit', [TakleefListController::class, 'submit']);
// Route::post('/submit/december', [TakleefListController::class, 'submitDecember']);
Route::post('/add-new-employee', [DateContoller::class, 'addEmployee'])->name('addEmployee');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
