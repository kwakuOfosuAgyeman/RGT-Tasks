<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CSVReaderController;
use App\Http\Controllers\ExcelReaderController;
use App\Http\Controllers\PDFController;

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

Route::get('/allView', [ExcelReaderController::class, 'readExcel'])->name('readExcel');
Route::get('/view/{order_id}', [ExcelReaderController::class, 'viewPage'])->name('view');
Route::get('/csv', [CSVReaderController::class, 'readCsv'])->name('csvFile');
Route::get('/pdf', [PDFController::class, 'generatePdf'])->name('genertepdf');
