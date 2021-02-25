<?php

namespace App\Http\Controllers;

use App\Good;
use Illuminate\Http\Request;

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
        $data = ['goods'=>$goods];
        return view('index',$data);
    }
}
