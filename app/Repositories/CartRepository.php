<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Product;

class CartRepository
{
    public function add(Product $product)
    {
        \Cart::session(auth()->user()->id)->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return $this->count();
    }

    public function content()
    {
        return \Cart::session(auth()->user()->id)->getContent();
    }

    public function count()
    {
        return 1;
    }
}