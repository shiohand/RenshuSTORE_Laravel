<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show($id)
    {
        $limit = 5;

        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $id)
            ->limit($limit)
            ->get();

        // レビュー済みか
        $is_exist = false;
        if (Auth::check()) {
            $is_exist = Review::where('product_id', $product->id)->where('user_id', Auth::id())->exists();
        }

        $data = compact([
            'product',
            'reviews',
            'is_exist',
        ]);

        return view('product.show', $data);
    }
    public function review($id)
    {
        $paginate = 10;

        $product = Product::findOrFail($id);
        $reviews = Review::where('product_id', $id)
            ->paginate($paginate)
            ->withQueryString();

        // レビュー済みか
        $is_exist = false;
        if (Auth::check()) {
            $is_exist = Review::where('product_id', $product->id)->where('user_id', Auth::id())->exists();
        }

        $data = compact([
            'product',
            'reviews',
            'is_exist',
        ]);

        return view('product.review', $data);
    }
}
