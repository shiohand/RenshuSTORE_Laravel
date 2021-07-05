<?php

namespace App\Services;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

// __construct()

// 取得
// items()
// totalPrice()
// totalQuantity()

// 操作
// login()
// find($product_id)
// push($product_id, $qunatity)
// put($updates)
// pull($product_ids)
// destroy()

// 補助
// refresh()
// exists($product_id)
// doesntExist($product_ids)
// notOnSale($product_id)
// error()
// message()

class CartService
{
    private bool $auth;
    private EloquentCollection $items;
    private bool $error = false;
    private string $message = 'エラーが発生しました。';

    public function __construct() {
        if (Auth::check()) {
            $this->auth = true;
            $this->items = CartItem::where('user_id', Auth::id())->get();
        } else {
            $this->auth = false;
            $this->items = session('cart_items', new EloquentCollection());
        }
        // productsからのデータを追加
        $this->items = $this->items->load('product:id,img,name,price');
    }


    public function login() {
        $this->auth = true;
    }
    public function items() {
        return $this->items;
    }
    public function total_price()
    {
        return $this->items->reduce(fn ($total, $item) => $total + ($item->product->price * $item->quantity));
    }
    public function total_quantity()
    {
        return $this->items->sum('quantity');
    }

    public function find($product_id) {
        return $this->items->where('product_id', $product_id)->first();
    }
    public function push($product_id, $qunatity)
    {
        // 追加済み, 未発売を弾く
        if ($this->exists($product_id)) {
            $this->message = '既にカートに入っていました。';
            return;
        }
        if ($this->notOnSale($product_id)) {
            return;
        }

        // モデル作成
        $item = CartItem::make([
            'user_id' => Auth::id(),
            'product_id' => $product_id,
            'quantity' => $qunatity,
        ]);
        // 保存
        if ($this->auth) {
            $item->save();
        } else {
            $this->items->push($item);
            session(['cart_items' => $this->items]);
        }
        $this->refresh();
    }
    public function put($updates)
    {
        $this->doesntExist(array_column($updates, 'product_id'));

        foreach ($updates as $data) {
            $item = $this->find($data['product_id']);
            $item->quantity = $data['quantity'];

            // 更新
            if ($this->auth) {
                $item->save();
            } else {
                session(['cart_items' => $this->items]);
            }
        }
        $this->refresh();
    }
    public function pull($product_ids)
    {
        if (!is_array($product_ids)) {
            $product_ids = [$product_ids];
        }
        $this->doesntExist($product_ids);

        // 実行
        if ($this->auth) {
            CartItem::whereIn('product_id', $product_ids)->delete();
        } else {
            $this->items = $this->items->whereNotIn('product_id', $product_ids);
            session(['cart_items' => $this->items]);
        }
        $this->refresh();
    }
    public function destroy()
    {
        if ($this->auth) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart_items');
        }
        $this->refresh();
    }

    public function refresh() {
        if (Auth::check()) {
            $this->items = CartItem::where('user_id', Auth::id())->get();
        } else {
            $this->items = session('cart_items', new EloquentCollection());
        }
        $this->items = $this->items->load('product:id,img,name,price');
    }

    public function exists($product_id)
    {
        $is_exists = $this->items->where('product_id', $product_id)->isNotEmpty();
        if ($is_exists) {
            $this->error = true;
            return true;
        }
        return false;
    }
    public function doesntExist($product_ids)
    {
        if (is_array($product_ids)) {
            $product_ids = [$product_ids];
        }
        $is_not_exists = $this->items->whereIn('product_id', $product_ids)->isEmpty();
        if ($is_not_exists) {
            $this->error = true;
            return true;
        }
        return false;
    }
    public function notOnSale($product_id)
    {
        $is_not_on_sale = Product::futureOnly()->where('id', $product_id)->exists();
        if ($is_not_on_sale) {
            $this->error = true;
            return true;
        }
        return false;
    }
    public function error()
    {
        return $this->error;
    }
    public function message()
    {
        return $this->message;
    }
}
