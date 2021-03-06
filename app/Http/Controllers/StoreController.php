<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Good;
use App\Order;
use App\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

        return view('index', [
            'goods' => $goods,
            'balance' => $this->getBalance()
            ]
        );
    }

    public function goodsDetail($id)
    {
        $product = Good::find($id);

        return view('goodsDetail', [
            'product' => $product,
            'balance' => $this->getBalance()
            ]
        );
    }

    public function cart()
    {
        $cart = Session::has('cart') ? Session::get('cart') : new Cart(null);

        return view('cart', [
            'items'=> $cart->items,
            'totalPrice'=> $cart->totalPrice,
            'balance' => $this->getBalance()
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

        return redirect('cart');
    }

    public function decreaseByOne($id)
    {
        $cart = new Cart(Session::get('cart'));
        $cart->decreaseByOne($id);

        Session::put('cart', $cart);

        return redirect('cart');
    }

    public function removeItem($id)
    {
        $cart = new Cart(Session::get('cart'));
        $cart->removeItem($id);

        Session::put('cart', $cart);

        return redirect('cart');
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return view('orders', [
            'orders' => $orders,
            'balance' => $this->getBalance()
            ]
        );
    }

    public function orderItems($id)
    {
        $order = Order::find($id);

        return view('orderItem', [
            'order' => $order,
            'balance' => $this->getBalance()
            ]
        );
    }

    public function checkout()
    {
        $carts = Session::get('cart')->items;
        $totalPrice = Session::get('cart')->totalPrice;

        if ($this->getBalance() < $totalPrice) {
            return redirect('/cart')->with('error', '餘額不足!');
        }

        $order = new Order();
        $order->order_number = time();
        $order->user_id = Auth::id();
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

        Http::asForm()->put('192.168.56.102:8888/api/withdrawal/'.Auth::user()->name, [
            'money' => $totalPrice,
            'remark' => '<商城購物>訂單編號: '.$order->order_number,
        ]);

        return redirect('orders')->with('success', '下單成功!');
    }

    private function getBalance()
    {
        return Http::get('192.168.56.102:8888/api/user/'.Auth::user()->name)['balance'];
    }
}
