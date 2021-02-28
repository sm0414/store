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

    public function create()
    {
        return view('manage.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            '名稱' => 'required',
            '價格' => [
                'required',
                'regex:/^([1-9][0-9]*)$/'
            ],
            'image' => 'image|nullable|max:1999'
        ]);

        if($request->hasFile('image')){
            // 獲取圖片檔名及格式
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // 獲取圖片檔名
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // 獲取圖片格式
            $extension = $request->file('image')->getClientOriginalExtension();
            // 要儲存的名稱
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // 上船圖檔
            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
            return $path;
            // make thumbnails
            $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('image')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/image/'.$thumbStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $goods = new Good();
        $goods->name = $request->input('名稱');
        $goods->price = $request->input('價格');
        $goods->description = $request->input('描述');
        $goods->image = $fileNameToStore;
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
