<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;



class CartController extends Controller
{
    // 1. Ver el contenido del carrito
    public function index()
    {
        // Recuperamos el carrito de la sesión (si no existe, devolvemos un array vacío)
        $cart = session()->get('cart', []);

        return view('client.cart.index', compact('cart'));
    }

    // 2. Añadir un producto al carrito
    public function add(Request $request, Product $product)
    {
        // 1. Recogemos la cantidad que el usuario ha introducido (por defecto 1 si no viene nada)
        $quantity = (float) $request->input('quantity', 1);

        // 2. Validamos que la cantidad sea mayor a 0
        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'La cantidad debe ser mayor a 0.');
        }

        // 3. Verificamos si hay stock general
        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'El producto no tiene stock disponible.');
        }

        $cart = session()->get('cart', []);

        // Cantidad que ya tuviera este producto en el carrito previamente
        $currentQuantityInCart = isset($cart[$product->id]) ? $cart[$product->id]['quantity'] : 0;

        // 4. Verificamos que la suma total no supere el stock de la base de datos
        if (($currentQuantityInCart + $quantity) > $product->stock) {
            return redirect()->back()->with('error', 'No puedes añadir esa cantidad; supera el stock disponible.');
        }

        // 5. Si ya estaba en el carrito, sumamos la cantidad elegida; si no, lo creamos
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "id"          => $product->id,
                "name"        => $product->name,
                "quantity"    => $quantity,
                "price"       => $product->price,
                "unit_type"   => $product->unit_type,
                "stock"       => $product->stock
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', '¡Producto añadido al carrito correctamente!');
    }

    public function remove($id){
        //obtenemos el carrito actual de la sesion
        $cart = session()->get('cart');
       
        //Comprobamos si el carrito existe y si el id del producto esta dentro
        if(isset($cart[$id])) {
            //si esta se elimina
            unset($cart[$id]);
            //actualizamos la sesion con el nuevo carrito sin ese producto
            session()->put('cart', $cart);
        }
        //volvemos a la pagina de la cesta con un mensaje
        return redirect()->back()->with('success' , 'Producto Eliminado.');



    }
}