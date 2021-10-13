<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ArticulosHomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CategoriasHomeController;
use App\Http\Controllers\OrdenesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\WebHooks;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\PaymentOrder;


/* Rutas del Home */
Route::get('/', [ArticulosHomeController::class, 'index'])->name('home.index');
Route::get('busqueda', SearchController::class)->name('search');
Route::get('articulo/{articulo}', [ArticulosHomeController::class, 'show'])->name('article.show');
Route::get('categoria/{categoria}', [CategoriasHomeController::class, 'show'])->name('category.show');
Route::get('carrito', ShoppingCart::class)->name('shopping-cart');

/* Rutas de Administrador */
Route::resource('categorias', CategoriaController::class)->names('admin.categories');
Route::resource('usuarios', UsuariosController::class)->names('admin.users');

/* Rutas de Vendedor */
Route::resource('articulos', ArticuloController::class)->names('articulos');
Route::resource('ventas', OrdenesController::class)->names('ventas');
Route::get('download-pdf', [PDFController::class, 'PDF'])->name('descargarPDF');
Route::get('download-excel', [ArticuloController::class, 'exportExcel'])->name('descargarExcel');

/* Rutas de Ordenes */
Route::middleware(['auth'])->group(function() {
    Route::get('ordenes', [OrderController::class, 'index'])->name('orders.index');
    Route::get('ordenes/crear', CreateOrder::class)->name('orders.create');
    Route::get('ordenes/{orden}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('orders/{orden}', [OrderController::class, 'success'])->name('orders.success');
    Route::get('ordenes/{orden}/pagar', PaymentOrder::class)->name('orders.payment');
    Route::post('webhooks', WebHooks::class);
});

/* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); */