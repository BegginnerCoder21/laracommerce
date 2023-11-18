<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function count()
    {
        $count = (new CartRepository())->count();

        return response()->json([
            'count' => $count
        ]);
    }
    public function index()
    {
        $products = (new CartRepository())->content();
        $cartCount = (new CartRepository())->count();

        return response()->json([
            'products' => $products,
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = Product::where('id',$request->productId)->first();

        $count = (new CartRepository())->add($product);

        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
