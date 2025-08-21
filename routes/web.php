<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/', fn () => to_route('product.index'));

Route::middleware('auth')->group(function () {   // ←任意（付けた方が自然）
    Route::resource('products', ProductController::class)->names([
        'index'   => 'product.index',
        'create'  => 'product.create',
        'store'   => 'product.store',
        'show'    => 'product.show',
        'edit'    => 'product.edit',
        'update'  => 'product.update',
        'destroy' => 'product.destroy',
    ]);
});

require __DIR__.'/auth.php';