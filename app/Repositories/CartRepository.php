<?php

namespace App\Repositories;

use App\Models\Product;

class CartRepository
{
    public function add(Product $product)
    {

        //rencontre d'erreur car le package de cart n'etait pas installé
        \Cart::session(auth()->user()->id)->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'quantity' => 1,
        ));

        return $this->count();
    }

    public function content()
    {
        return \Cart::session(auth()->user()->id)->getContent();
    }

    public function count()
    {
        return $this->content()->sum('quantity');
    }
}
