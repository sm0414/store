<?php

namespace App\Http\Controllers\Manage;

use App\Good;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageController extends Controller
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

    public function index()
    {
        if (Auth::user()->email != 'admin@gmail.com') {
            return redirect('/');
        }

        $goods = Good::all();

        return view('manage.index', ['goods' => $goods]);
    }

//    public function members()
//    {
//        if (Auth::user()->email != 'admin@gmail.com') {
//            return redirect('/');
//        }
//
//        $users = User::all();
//
//        return view('manage.members', ['users' => $users]);
//    }
//
//    public function memberOrders($id)
//    {
//        $orders = Order::all();
//
//        return view('manage.orders', ['orders' => $orders]);
//    }
}
