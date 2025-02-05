<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class,'index'])->name('dashboard.product');
Route::get('/test/{id}', function ($id) {
     $product = Product::find($id);
     if (!$product) {
        return response()->json([
            'message' => 'Le produit avec cet ID n\'existe pas.'
        ], 404);
    }
    return $product;
});

// Produit Resources :
Route::resource('produit',ProductController::class)->only('store' , 'destroy');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
