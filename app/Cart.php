<?php

namespace App;

use Illuminate\Support\Facades\Session;

class Cart
{
    public $items;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($good)
    {
        $storedItem = [
            'name' => $good->name,
            'image' => $good->image,
            'sum' => 0,
            'quantity' => 0
        ];

       // 檢查購物車是否已有此商品
        if($this->items) {
            // check if cart has existing product
            // if yes let storedItem = Cart Item
            if (array_key_exists($good->id, $this->items)) {
                $storedItem = $this->items[$good->id];
            }
        }

        // 更新商品數量,小計
        $storedItem['quantity']++;
        $storedItem['sum'] += $good->price;

        $this->items[$good->id] = $storedItem;

        // 更新購物車總價
        $this->totalPrice += $good->price;
    }

    public function increaseByOne($id)
    {
        // 更新商品數量,小計
        $this->items[$id]['sum'] += $this->items[$id]['sum'] / $this->items[$id]['quantity'];
        $this->items[$id]['quantity']++;

        // 更新購物車總價
        $this->totalPrice += $this->items[$id]['sum'] / $this->items[$id]['quantity'];
    }

    public function decreaseByOne($id)
    {
        // 更新商品數量,小計
        $this->items[$id]['sum'] -= $this->items[$id]['sum'] / $this->items[$id]['quantity'];
        $this->items[$id]['quantity']--;

        // 數量等於0,從購物車移除商品
        if($this->items[$id]['quantity'] == 0) {
            // 更新購物車總價
            $this->totalPrice = $this->items[$id]['sum'];

            unset($this->items[$id]);
        }else {
            // 更新購物車總價
            $this->totalPrice -= $this->items[$id]['sum'] / $this->items[$id]['quantity'];
        }
    }

    public function removeItem($id)
    {
        Session::forget('cart');
        // 更新購物車總價
        $this->totalPrice -= $this->items[$id]['sum'];

        unset($this->items[$id]);
    }
}
