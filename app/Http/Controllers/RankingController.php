<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function __invoke(Request $request)
    {
        $pagenate = 10;
        $term = $request->term ?? 'month';

        $rank_products = Product::pastOnly()
            ->orderBySalesWithTerm($request->term)
            ->limit($pagenate)
            ->get();

        $data = compact(
            'rank_products',
            'term',
        );
        return view('ranking', $data);
    }
}
