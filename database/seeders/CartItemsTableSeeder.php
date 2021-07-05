<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CartItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CartItem 3 product_id=1,2,3
        CartItem::factory(3)
        ->state(new Sequence(
            ['product_id' => 1],
            ['product_id' => 2],
            ['product_id' => 3],
        ))
        ->for(User::find(1))
        ->create();
    }
}
