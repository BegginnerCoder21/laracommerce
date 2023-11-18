<?php

namespace Tests\Feature\products;

use App\Models\Product;
use App\Repositories\CartRepository;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{
   use RefreshDatabase;

   public function test_products_list_is_displayed():void
   {
       //arrange
       $this->assertDatabaseCount('products',0);
       Product::factory()->count(30)->create();

       //act
       $response = $this->get('/products');

       //assert
       $this->assertDatabaseCount('products',30);
       $response->assertOk()
                ->assertViewIs('products.index');


   }

   public function test_user_authenticated_add_products_in_the_cart():void
   {
       //arrange
       Product::factory(10)->create();
       $product = Product::first();

       $user = \App\Models\User::factory()->create();

       //act
       $res = $this->actingAs($user)->getJson('api/products');
       $response = $this->actingAs($user)->postJson('api/products',['productId' => $product->id]);

       //assert
       $res->assertOk()
           ->assertJson([
               'products' => [],
               'cartCount' => 0
           ]);
       $response->assertOk()
                ->assertJsonStructure(['count'])
                ->assertJson(['count' => 1]);
   }

   public function test_user_unauthenticated_add_products_in_the_cart():void
   {
       //arrange
       Product::factory(10)->create();
       $product = Product::first();

       //act
       $response = $this->postJson('api/products',['productId' => $product->id]);

       //assert
       $this->assertGuest();
       $response->assertStatus(401);
   }

   public function test_api_return_products_and_cart_count():void
   {
       //arrange
       Product::factory(10)->create();
       $product = Product::first();

       $user = \App\Models\User::factory()->create();

       //act
       $res = $this->actingAs($user)->getJson('api/products');
       $this->actingAs($user)->postJson('api/products',['productId' => $product->id]);
       $response = $this->actingAs($user)->getJson('api/products');

       //assert
       $this->assertAuthenticated();
       $res->assertOk()
           ->assertJson([
               'products' => [],
               'cartCount' => 0
           ]);
       $response->assertOk()
                ->assertJsonStructure(['products', 'cartCount'])
                ->assertJson(['cartCount' => 1]);
   }

}
