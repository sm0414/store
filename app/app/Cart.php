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

    public function add($product)
    {
        $storedItem = [
            'name' => $product->name,
            'image' => $product->image,
            'sum' => 0,
            'quantity' => 0
        ];

       // 檢查購物車是否已有此商品
        if($this->items) {
            if (array_key_exists($product->id, $this->items)) {
                $storedItem = $this->items[$product->id];
            }
        }

        // 更新商品數量,小計
        $storedItem['quantity']++;
        $storedItem['sum'] += $product->price;

        $this->items[$product->id] = $storedItem;

        // 更新購物車總價
        $this->totalPrice += $product->price;
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
        // 商品單價
        $price = $this->items[$id]['sum'] / $this->items[$id]['quantity'];

        // 更新商品數量,小計
        $this->items[$id]['quantity']--;
        $this->items[$id]['sum'] -= $price;

        // 判斷商品數量是否等於0
        if($this->items[$id]['quantity'] == 0) {
            unset($this->items[$id]);
        }

        // 更新購物車總價
        $this->totalPrice -= $price;

    }

    public function removeItem($id)
    {
        // 更新購物車總價
        $this->totalPrice -= $this->items[$id]['sum'];

        unset($this->items[$id]);
    }
}
