<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke()
    {
        $limit = 5;

        // ranking
        $rank_products = Product::orderBySalesWithTerm('month')
            ->limit($limit)
            ->get();

        // products
        $new_products = Product::pastOnly()
            ->orderByDesc('released_at')
            ->limit($limit)
            ->get();

        // future
        $future_products = Product::futureOnly()
            ->orderBy('released_at')
            ->limit($limit)
            ->get();

        $data = compact(
            'rank_products',
            'new_products',
            'future_products',
        );
        
        return view('index', $data);
    }
}
