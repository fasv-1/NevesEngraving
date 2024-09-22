<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use PhpParser\Node\Stmt\Foreach_;

class CartController extends Controller
{
    /**
     * Display a listing of the cart
     */
    public function showCart()
    {
        $cart_products = collect(request()->session()->get('cart'));

        $cart_total = 0;
        if (session('cart')) {
            foreach ($cart_products as $key => $product) {

                $cart_total += $product['quantity'];
            }
        }

        /*dd($cart_total);*/
        // $products = Produto::latest()->limit(10)->get();
        $total_products_count = request()->session()->get('cart') ? count(request()->session()->get('cart')) : 0;
        // return view('cart',compact('products','cart_products','cart_total','total_products_count'));
        return response()->json(['cart_products' => $cart_products, 'cart_total' => $cart_total, 'total_products_count' => $total_products_count]);
        //return view('frontend.cart.mini-cart-render',compact('cart_products'));
    }

    /**
     * Add a new product to the cart 
     */
    public function addToCart(Request $request)
    {
        $product = Produto::findOrFail($request->product_id);

        $cart = $request->session()->get('cart', []);

        if ($cart != null) {

            $i = 0;

            foreach ($cart as $key => $cart_product) {
                if ($cart_product['productId'] == $product->id && $cart_product['color'] == $request->color && $cart_product['text'] == $request->text) {
                    $cart[$key]['quantity']++;
                } else {
                    $i ++;
                }
            }

            if ($i == count($cart)) {
                array_push($cart, [
                    'productId' => $product->id,
                    "title" => $product->nome,
                    "quantity" => $request->quantity,
                    "color" => $request->color,
                    "text" => $request->text,
                    "discount_price" => $product->desconto_id,
                    "strike_price" => $product->valor,
                ]);
            }
        } else {
            array_push($cart, [
                'productId' => $product->id,
                "title" => $product->nome,
                "quantity" => $request->quantity,
                "color" => $request->color,
                "text" => $request->text,
                "discount_price" => $product->desconto_id,
                "strike_price" => $product->valor,
            ]);
        }


        $request->session()->put('cart', $cart);

        $cart_products = collect(request()->session()->get('cart'));
        $cart_total = 0;
        foreach ($cart_products as $key => $product) {

            $cart_total += $product['quantity'];
        }

        // $renderHTML = view('frontend.cart.mini-cart-render', compact('cart_products', 'cart_total'))->render();
        $total_products_count = count(request()->session()->get('cart'));
        return response()->json(['cart_products' => $cart_products, 'cart_total' => $cart_total, 'total_products_count' => $total_products_count], 200);
    }

    /**
     * Updates the quantity of the product
     */
    public function update(Request $request)
    {

        if (isset($request->product_id) && isset($request->quantity)) {
            $cart = $request->session()->get('cart');

            $cart[$request->product_id]['quantity'] = $request->quantity;
            $request->session()->put('cart', $cart);

            $update_amount_of_product = $cart[$request->product_id]['quantity'];

            $cart_products = collect(request()->session()->get('cart'));
            $cart_total = 0;

            if (session('cart')) {
                foreach ($cart_products as $key => $product) {

                    $cart_total += $product['quantity'];
                }
            }

            return response()->json(['success' => true, 'update_amount_of_product' => $update_amount_of_product, 'cart_total' => $cart_total]);
        }
    }

    /**
     * Based on the id recived from request, deletes the product
     */
    public function destroy(Request $request)
    {
        $id = $request->product_id;

        $cart = $request->session()->get('cart');
        if (isset($cart[$id])) {

            unset($cart[$id]);
        }
        $request->session()->put('cart', $cart);

        return response()->json(['success' => true, 'msg' => 'Produto eliminado do seu carrinho']);
    }
}
