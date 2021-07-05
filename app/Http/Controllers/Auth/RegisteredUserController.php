<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        // セッションから$cart_itemsを取得
        $cart_items = Cart::items();
        Cart::destroy();

        // User作成
        $user = new User();
        $user->fill($request->except(['password']));
        $user->password = Hash::make($request->password);
        $user->save();

        event(new Registered($user));
        Auth::login($user);

        // データベースに$cart_itemsを登録
        Cart::login();
        foreach ($cart_items as $item) {
            Cart::push($item->product_id, $item->quantity);
        }

        return redirect(RouteServiceProvider::HOME);
    }

    public function confirm(UserRequest $request)
    {
        $inputs = $request->all();

        $data = compact([
            'inputs',
        ]);

        return view('auth.register_confirm', $data);
    }
    public function confirm_get()
    {
        return redirect()->route('error');
    }
}
