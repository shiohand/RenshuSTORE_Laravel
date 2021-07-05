<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Facades\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class OrderController extends Controller
{
    public function create()
    {
        return view('order.create');
    }
    public function create_member()
    {
        return view('order.create_member');
    }
    public function confirm(OrderRequest $request)
    {
        return view('order.confirm');
    }
    public function confirm_get()
    {
        return redirect()->route('error');
    }
    public function store(OrderRequest $request)
    {
        // 登録用の$cart_itemsを取得してクリア
        $cart_items = Cart::items();
        Cart::destroy();

        // 注文と同時に登録の場合 ユーザー登録, (ログアウト), ログイン
        if ($request->with_signup == 'signup') {
            $user = new User();
            $user->fill($request->except(['password']));
            $user->password = Hash::make($request->password);
            $user->save();

            event(new Registered($user));
            if (Auth::check()) {
                Auth::logout();
            }
            Auth::login($user);
        }

        // Orderの作成
        $order = new Order;
        $order->fill($request->all());
        // ログインユーザーの場合はuser_idを設定
        if (Auth::check()) {
            $order->user_id = Auth::id();
        }
        $order->save();

        // OrderDetailの作成
        $order_id = $order->id;
        foreach ($cart_items as $cart_item) {
            OrderDetail::create([
                'order_id' => $order_id,
                'product_id' => $cart_item->product_id,
                'price' => $cart_item->product->price,
                'quantity' => $cart_item->quantity,
            ]);
        }

        $data = compact([
            'order', // 表示用
        ]);

        return view('order.store', $data);
    }
    public function store_member()
    {
        // 登録用の$cart_itemsを取得してクリア
        $cart_items = Cart::items();
        Cart::destroy();

        // Orderの作成
        $user = Auth::user();
        $values = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'postal1' => $user->postal1,
            'postal2' => $user->postal2,
            'address' => $user->address,
            'tel' => $user->tel,
        ];

        $order = new Order;
        $order->fill($values)->save();

        // OrderDetailの作成
        $order_id = $order->id;
        foreach ($cart_items as $item) {
            OrderDetail::create([
                'order_id' => $order_id,
                'product_id' => $item->product_id,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
            ]);
        }

        $data = compact([
            'order', // 表示用
        ]);

        return view('order.store', $data);
    }
}
