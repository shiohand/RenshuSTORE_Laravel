<?php

namespace App\Http\ViewComposers;

use App\Facades\Cart;
use Illuminate\View\View;

class CartComposer
{
    public function compose(View $view)
    {
        $cart_items = Cart::items();
        $total_price = Cart::total_price();
        $total_quantity = Cart::total_quantity();

        $data = compact([
            'cart_items',
            'total_price',
            'total_quantity',
        ]);

        $view->with($data);
    }
}
