<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'postal1',
        'postal2',
        'address',
        'tel',
    ];
    
    /* リレーション */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /* ローカルスコープ */
    // $term(累計, 日間, 月間, 年間)
    public function scopeFilterByTerm($query, $term = '')
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

        return $query->where('created_at', '>', $date);
    }

    /* メソッド */
    public function getTotalPrice()
    {
        $total_price = $this->order_details()->sum(DB::raw('price * quantity'));
        return $total_price;
    }
}
