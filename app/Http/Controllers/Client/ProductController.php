<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //ver los prooductos en la pajina de los cientes
    public function index(){

        $products = product::where('stock','>', 0)->get();

        return view('client.products.index', compact('products'));
    }
    
}
