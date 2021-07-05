<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function confirm(ReviewRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        // 表示用Review作成
        $values = $request->all();

        $review = new Review();
        $review->fill($values)->make();

        $data = compact([
            'product',
            'review',
        ]);

        return view('review.confirm', $data);
    }
    public function confirm_get()
    {
        return redirect()->route('error');
    }
    public function store(ReviewRequest $request)
    {
        $review = new Review();
        $review->fill($request->all());
        $review->user_id = Auth::id();
        $review->save();

        return view('review.store');
    }
}
