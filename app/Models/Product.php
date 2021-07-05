<?php

namespace App\Models;

use App\Models\Review;
use App\Models\CartItem;
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'detail',
        'price',
        'img',
        'released_at',
    ];

    protected $casts = [
        'released_at' => 'date',
    ];

    /* リレーション */
    public function cart_items()
    {
        return $this->hasMany(CartItem::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /* ローカルスコープ */
    // scopePastOnly()
    // scopeFutureOnly()
    // scopeSortByColumns($sort)
    // scopeOrderBySalesWithTerms($term)
    // getRecommendProducts()
    // scopeAddRating()
    // getRating()

    // 発売中
    public function scopePastOnly($query)
    {
        return $query->where('released_at', '<=', Carbon::now());
    }
    // 発売予定
    public function scopeFutureOnly($query)
    {
        return $query->where('released_at', '>', Carbon::now());
    }
    // ソート $sort(発売日順, 価格asc, 価格desc, レビュー順)
    public function scopeSortByColumn($query, $sort = '')
    {
        $order = ['released_at', 'desc'];
        switch($sort) {
        case 'date-asc':
            $order = ['released_at', 'asc'];
            break;
        case 'date-desc':
            break;
        case 'price-asc':
            $order = ['price', 'asc'];
            break;
        case 'price-desc':
            $order = ['price', 'desc'];
            break;
        case 'rating':
            $order = ['rating', 'desc'];
            $query = $query->addRating(); // ratingを追加
            break;
        default:
            break;
        }
        return $query->orderBy($order[0], $order[1]);
    }
    // 売上順 $term(累計, 日間, 月間, 年間)
    public function scopeOrderBySalesWithTerm($query, $term = '')
    {
        // 集計期間を設定
        $date = Carbon::now();
        switch($term)
        {
        case 'day':
            $date = $date->subDay();
            break;
        case 'month':
            $date = $date->subMonthNoOverflow();
            break;
        case 'year':
            $date = $date->subYear();
            break;
        default:
            $date = new Carbon('2000-01-01 00:00:00');
            break;
        }

        $product_sales = OrderDetail::select('product_id', DB::raw('SUM(price * quantity) AS sales'))->where('created_at', '>', $date)->groupBy('product_id');

        return $query
            ->leftJoinSub($product_sales, 'product_sales',
                fn($join) => $join->on('products.id', '=', 'product_sales.product_id'))
            ->orderByDesc('product_sales.sales');
    }
    // 評価平均(rating)カラム追加
    public function scopeAddRating($query)
    {
        $rating_avgs = Review::select(
            'product_id',
            DB::raw('truncate(AVG(rating)+0.05,1) AS rating_avg')
            )->groupBy('product_id');

        return $query->select()->addSelect(DB::raw('COALESCE(rating_avg, 0) AS rating'))
            ->leftJoinSub($rating_avgs, 'rating_avgs',
                fn($join) => $join->on('products.id', '=', 'rating_avgs.product_id'));
    }

    /* メソッド */
    // 一緒に購入されている商品
    public function getRecommendProducts($limit = 5)
    {

        // productを持つorder_detailsのorder_id
        $order_ids = $this->order_details()->get('order_id');

        // $order_idsを持つ全てのorder_details(自分を除く)
        // そのproduct_idでグループ化したそれぞれの個数(カウント)
        $order_details = OrderDetail::select('product_id', DB::raw('count(product_id) as count'))
            ->whereIn('order_id', $order_ids)
            ->where('product_id', '!=', $this->id)
            ->groupBy('product_id');

        $recommend_products = Product::select('id', 'img', 'name', 'price')
            ->joinSub($order_details, 'order_details',
                fn($join) => $join->on('products.id', '=', 'order_details.product_id'))
            ->orderByDesc('order_details.count')
            ->limit($limit)
            ->get();

        return $recommend_products;
    }
    // product_idからratingを取得 いまのところ用途がない
    public function getRating()
    {
        return Review::where('reviews.product_id', $this->id)
            ->groupBy('product_id')
            ->value(DB::raw('COALESCE(truncate(AVG(rating)+0.05,1), 0)'));
    }
}
