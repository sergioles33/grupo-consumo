<?php

use App\Http\Controllers\Producer\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Models\Product;

//ruta publica innicial

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    // Obtenemos los últimos 6 productos creados
    $products = Product::latest()->take(6)->get();

    return view('welcome', compact('products'));
});



// Modificamos la ruta /dashboard para que redirija según el rol
Route::get('/dashboard', function () {
    $user = Auth::user();

    // Redirección según el rol guardado en la base de datos
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'producer') {
        return redirect()->route('producer.dashboard');
    } elseif ($user->role === 'client') {
        return redirect()->route('client.dashboard');
    }

    // Por si acaso no tiene ningún rol definido, muestra el dashboard genérico
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//RUTAS PROTEGIDAS POR AUTENTIFICACION
Route::middleware(['auth'])->group(function () {

        //MODULOO ADMINISTRADOR
   // --- PANEL DE ADMINISTRADOR (Actualizado con controlador y botón de aprobar) ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/users/{user}/approve', [AdminController::class, 'approve'])->name('users.approve');
    });

        //MODULO PRODUCTOR
    // dashboard para el productor
    Route::get('/producer/dashboard', function (){
        return view('producer.dashboard');
    })->name('producer.dashboard');

    //rutas para CRUD Produtores
    Route::prefix('producer')->name('producer.')->group(function(){
    Route::resource('products', ProductController::class);
});

        //MODULO CLIENTE
    // dashboard para cliente
    Route::get('/client/dashboard', function (){
        return view('client.dashboard');
    })->name('client.dashboard');

    //ruta cliente Catalogo de Productos
    Route::prefix('client')->name('client.')->group(function(){
        //catalogo de productos
        Route::get('/products', [ClientProductController::class, 'index'])->name('products.index');
    }); 
    
    Route::prefix('client')->name('client.')->group(function () {
    
        // Rutas de productos existentes...
        Route::get('/products', [App\Http\Controllers\Client\ProductController::class, 'index'])->name('products.index');

        // --- RUTAS DEL CARRITO ---
        Route::post('/cart/add/{product}', [App\Http\Controllers\Client\CartController::class, 'add'])->name('cart.add');
        Route::get('/cart', [App\Http\Controllers\Client\CartController::class, 'index'])->name('cart.index');
        Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove'); 
    });

    

    
    // Rutas de perfil (generadas por Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';
