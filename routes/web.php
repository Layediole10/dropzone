<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadImageController;

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

Route::get('/', [UploadImageController::class, 'create'])->name('dropzone.create');
Route::post('/images-save', [UploadImageController::class, 'store'])->name('dropzone.store');
Route::post('/images-delete', [UploadImageController::class, 'destroy'])->name('dropzone.delete');
Route::get('/images-show', [UploadImageController::class, 'index'])->name('dropzone.show');
