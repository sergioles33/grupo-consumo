<?php

namespace App\Http\Controllers\Producer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        // Solo muestra los productos del productor logueado actualmente
        $products = Product::where('user_id', Auth::id())->get();
        return view('producer.products.index', compact('products'));
    }

    public function create()
    {
        return view('producer.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'unit_type' => 'required|string|in:kg,unidad,docena,litro',
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'unit_type' => $request->unit_type,
        ]);

        return redirect()->route('producer.products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function edit(Product $product)
    {
        // Seguridad: Asegurar que el producto pertenece al productor actual
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        return view('producer.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'unit_type' => 'required|string|in:kg,unidad,docena,litro',
        ]);

        $product->update($request->all());

        return redirect()->route('producer.products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('producer.products.index')->with('success', 'Producto eliminado exitosamente.');
    }
}

