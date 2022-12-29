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
// Route::post('/generate-pdf', function (Request $request) {
//     $dompdf = new Dompdf();

//     // Load the HTML
//     $dompdf->loadHtml($request->html);

//     // Render the PDF
//     $dompdf->render();

//     // Output the PDF as a download
//     $pdf = $dompdf->output();
//     return response($pdf, 200)
//         ->header('Content-Type', 'application/pdf')
//         ->header('Content-Disposition', 'attachment; filename="output.pdf"');
// });