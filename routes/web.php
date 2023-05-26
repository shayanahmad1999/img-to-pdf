<?php

use App\Http\Controllers\ImgToPdfController;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\PDF;
use Dompdf\Options;

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

Route::post('/Image', [ImgToPdfController::class, 'convertToPDF'])->name('image.pdf');
