<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $products = Product::factory()->count(random_int(1,10));
        $orders = Order::factory()->count(random_int(1,3));
        $order_product = ['total_price' => random_int(10000,100000),
            'total_quantity' => random_int(1,5)
        ];

        User::factory()->count(10)->has($orders->hasAttached($products, $order_product))->create();
    }
}
