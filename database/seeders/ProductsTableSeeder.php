<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * name, product_id挿入用
         * Product::factory()->state()
         */
        $arr = range(1, 50);
        $product_names = [];
        foreach ($arr as $val) {
            array_push($product_names, ['name' => 'product'.$val]);
        }
        // Product 50
        Product::factory(50)
        ->state(new Sequence(...$product_names))
        ->create();
    }
}
