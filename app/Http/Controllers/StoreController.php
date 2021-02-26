<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Good;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Facades\Auth;
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

    public function goodsDetail($id)
    {
        $product = Good::find($id);

        return view('goodsDetail', ['product' => $product]);
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

    public function orders()
    {
        $orders = Order::all();

        return view('orders', ['orders' => $orders]);
    }

    public function orderItems($id)
    {
        $order = Order::find($id);

        return view('orderItem', ['order' => $order]);
    }

    public function checkout()
    {
        $carts = Session::get('cart')->items;
        $totalPrice = Session::get('cart')->totalPrice;

        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->total = $totalPrice;
        $order->save();

        foreach ($carts as $id => $item){
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $id;
            $orderItem->product_name = $item['name'];
            $orderItem->product_quantity = $item['quantity'];
            $orderItem->sum = $item['sum'];
            $orderItem->save();
        }

        Session::forget('cart');

        return redirect()->action('StoreController@orders');
    }
}
