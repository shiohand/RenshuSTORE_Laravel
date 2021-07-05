<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        return view('user.show');
    }
    public function reviewed()
    {
        $paginate = 10;

        $reviews = Review::with('product')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->paginate($paginate)
            ->withQueryString();

        $data = compact(
            'reviews',
        );
        return view('user.reviewed', $data);
    }
    public function ordered(Request $request)
    {
        $paginate = 10;
        $term = $request->term ?? 'month';

        $orders = Order::with('order_details.product')
            ->where('user_id', Auth::id())
            ->filterByTerm($request->term)
            ->orderByDesc('id')
            ->paginate($paginate)
            ->withQueryString();

        $data = compact(
            'orders',
            'term',
        );
        return view('user.ordered', $data);
    }
    public function edit()
    {
        return view('user.edit');
    }
    public function update(UserRequest $request)
    {
        // User更新
        $user = Auth::user();
        $user->fill($request->except(['password']));
        if ($request->new_password != '') {
            // new_passwordに入力があればpassword変更
            $user->password = Hash::make($request->new_password);
        }
        $user->save();

        return redirect()->route('user');
    }
    public function delete_confirm()
    {
        return view('user.delete_confirm');
    }
    public function destroy()
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();
        return view('user.destroy');
    }
}
