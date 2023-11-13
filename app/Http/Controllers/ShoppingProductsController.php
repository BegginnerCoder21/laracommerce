<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class ShoppingProductsController extends Controller
{
    public function index()
    {
        return view('products.shoppingProducts');
    }

    public function destroy($id)
    {
        (new CartRepository())->remove($id);
    }

    public function increase($id)
    {
        (new CartRepository())->increase($id);
    }
    public function decrease($id)
    {
        (new CartRepository())->decrease($id);
    }
}
