<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        return view('cart.show');
    }
    public function update(Request $request)
    {
        // 選択されているアイテムを削除
        $deletes = $request->delete ?? array();
        if (!empty($deletes)) {
            Cart::pull($deletes);
        }

        // quantity_で始まり、idが$deletes(削除済み)に存在しない項目を更新
        $updates = [];
        foreach ($request->all() as $key => $value) {
            if (Str::startsWith($key, 'quantity_') && !in_array(substr($key, 9), $deletes)) {
                $updates[] = [
                    'product_id' => substr($key, 9),
                    'quantity' => $value,
                ];
            }
        }
        Cart::put($updates);

        return view('cart.show');
    }
    public function store(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        // アイテムを追加
        Cart::push($product_id, $quantity);
        if (Cart::error()) {
            $message = Cart::message();
            return redirect()->route('error')->with('error_message', $message);
        }

        // 表示用new_item
        $new_item = Cart::find($product_id);
        // recommends
        $recommends = $new_item->product->getRecommendProducts();

        $data = compact([
            'new_item',
            'recommends',
        ]);

        return view('cart.store', $data);
    }
    public function store_get()
    {
        return redirect()->route('error');
    }
    public function destroy()
    {
        Cart::destroy();
        return view('cart.destroy');
    }
}
