<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
     
       // Ver los productos en la página de los clientes
    public function index(Request $request)
    {
        // 1. Obtenemos el texto que escribió el cliente en el buscador (si hay alguno)
        $search = $request->input('search');

        // 2. Iniciamos la consulta base con productos en stock
        $query = Product::where('stock', '>', 0);

        // 3. Si hay búsqueda, filtramos por nombre o descripción
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // 4. Obtenemos los resultados
        $products = $query->get();

        // 5. Pasamos $products y $search a la vista
        return view('client.products.index', compact('products', 'search'));
    }
    

}
