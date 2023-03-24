<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
 
//Route::get('/', function () {
//    return view('welcome');
//});
 
Route::get('/', [ProductsController::class, 'index']);
Route::get('/add-product', [ProductsController::class, 'add'])->name('products.add');
Route::post('/add-product',[ProductsController::class, 'create'])->name('products_create');
Route::get('cart', [ProductsController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductsController::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [ProductsController::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove_from_cart');