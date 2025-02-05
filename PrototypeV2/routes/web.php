<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/csrf-token', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});

Route::get('/dashboard', function () {
    return view('welcome');
});
Route::get('/dashboard/{any}', function () {
    return view('welcome');
})->where('any', '.*');
// Route::get('/dashboard', function () {
//     return view('Dashboard');
// });

Route::get('/products',[ProductController::class,'index']);
Route::post('/products',[ProductController::class,'store']);
Route::get('/products/{id}',[ProductController::class,'show']);
Route::put('/products/{id}',[ProductController::class,'update']);
Route::delete('/products/{id}',[ProductController::class,'destroy']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
