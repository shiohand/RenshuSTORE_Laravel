<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // OrderDetail 2,3,5 product_id=1,2,3,4,5
        OrderDetail::factory(2)
            ->state(new Sequence(
                ['product_id' => 1],
                ['product_id' => 2],
            ))
            ->for(Order::find(1))
            ->create();

        OrderDetail::factory(3)
            ->state(new Sequence(
                ['product_id' => 1],
                ['product_id' => 2],
                ['product_id' => 3],
            ))
            ->for(Order::find(2))
            ->create();

        OrderDetail::factory(5)
            ->state(new Sequence(
                ['product_id' => 1],
                ['product_id' => 2],
                ['product_id' => 3],
                ['product_id' => 4],
                ['product_id' => 5],
            ))
            ->for(Order::find(3))
            ->create();
    }
}
