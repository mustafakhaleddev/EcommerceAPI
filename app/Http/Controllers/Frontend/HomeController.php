<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Support\Str;

class HomeController
{
    //Dashboard Home
    public function index()
    {
        return view('frontend.home');
    }

    //Landing page Products
    public function products()
    {
        $products = Product::paginate(2);
        return view('frontend.products', compact('products'));
    }

    //Add Product To Cart
    public function addToCart(Product $product)
    {


        \Cart::add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        session()->flash('message', 'Product successfully added to cart.');
        return redirect()->back();
    }

    //Empty the cart
    public function empty_cart()
    {
        \Cart::clear();
        session()->flash('message', 'Car successfully cleared.');
        return redirect()->back();
    }


    //Delete Item From Cart
    public function delete_item_from_cart($id)
    {
        \Cart::remove($id);
        session()->flash('message', 'Car successfully updated.');
        return redirect()->back();
    }
}
