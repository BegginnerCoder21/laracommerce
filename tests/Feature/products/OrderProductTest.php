<?php

namespace Tests\Feature\products;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_order_list_to_user_unauthenticated_is_displayed():void
    {
        //arrange
        $this->seed();

        //act
        $response = $this->get('/dashboard');

        //assert
        $this->assertGuest();
        $response->assertStatus(302);


    }
    public function test_order_list_to_user_authenticated_is_displayed():void
    {
        //arrange
        $this->seed();
        $user = User::find(1);

        //act
        $response = $this->actingAs($user)->get('/dashboard');

        //assert
        $response->assertOk()
                ->assertViewIs('dashboard')
                ->assertViewHas('orders');
    }

    public function test_user_unauthenticated_order_creating():void
    {
        //arrange
        $this->assertDatabaseEmpty('orders');

        //act
        $response = $this->post('/orderproduct');

        //assert
        $this->assertGuest();
        $this->assertDatabaseEmpty('orders');
        $response->assertStatus(302);
    }

    public function test_user_authenticated_order_creating():void
    {
        //arrange
        $user = User::factory()->create();
        $product = Product::factory()->create();

        //act
        $this->actingAs($user)->postJson('api/products',['productId' => $product->id]);
        $response = $this->actingAs($user)->post('/orderproduct');

        //pre-assert
        $res = $this->actingAs($user)->getJson('api/products');
        $order = Order::find(1);

        //assert
        $this->assertAuthenticatedAs($user);
        $this->assertDatabaseCount('orders',1);
        $this->assertDatabaseCount('order_product',1);
        $this->assertDatabaseHas('orders',['order_number' => $order->order_number]);
        $response->assertOk();
        $res->assertJsonStructure(['products','cartCount']);
        $res->assertJson([
            'products' => [],
            'cartCount' => 0
        ]);
    }
}
