<?php

namespace App\Http\Middleware;

use Closure;
use App\Facades\Cart;
use Illuminate\Http\Request;

class OrderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Cart::items()->count() === 0) {
            $message = 'カートに商品がありません。';
            return redirect()->route('error')->with('error_message', $message);
        }
        return $next($request);
    }
}
