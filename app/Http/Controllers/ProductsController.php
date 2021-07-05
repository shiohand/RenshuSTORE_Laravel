<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __invoke(Request $request)
    {
        $paginate = 20;
        $sort = $request->sort ?? 'date-desc';

        $products = Product::pastOnly()
            ->sortByColumn($request->sort)
            ->paginate($paginate)
            ->withQueryString();

        $data = compact(
            'products',
            'sort',
        );

        return view('products', $data);
    }
}
