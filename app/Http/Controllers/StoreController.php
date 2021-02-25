<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Good;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    //商品列表
    public function index()
    {
        $goods = Good::all();

        return view('index', ['goods' => $goods]);
    }

    public function cart()
    {
        $cart = Session::has('cart') ? Session::get('cart') : new Cart(null);

        return view('cart',[
            'items'=> $cart->items,
            'totalPrice'=> $cart->totalPrice
            ]
        );
    }

    public function addToCart($id)
    {
        $product = Good::find($id);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product);

        Session::put('cart', $cart);
    }

    public function increaseByOne($id)
    {
        $cart = new Cart(Session::get('cart'));
        $cart->increaseByOne($id);

        Session::put('cart', $cart);

        return redirect()->action('StoreController@cart');
    }

    public function decreaseByOne($id)
    {
        $cart = new Cart(Session::get('cart'));
        $cart->decreaseByOne($id);

        Session::put('cart', $cart);

        return redirect()->action('StoreController@cart');
    }

    public function removeItem($id)
    {
        $cart = new Cart(Session::get('cart'));
        $cart->removeItem($id);

        Session::put('cart', $cart);

        return redirect()->action('StoreController@cart');
    }
}
