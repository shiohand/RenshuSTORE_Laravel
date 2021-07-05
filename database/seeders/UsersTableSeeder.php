<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\CartItem;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * product_id挿入用
         * Review::factory()->state()
         */
        $arr = range(1, 40); // 10個はレビューなし確認用に残したいので40
        $product_ids = [];
        foreach ($arr as $val) {
        array_push($product_ids, ['product_id' => $val]);
        }
        $shuffle_ids = function () use ($product_ids) {
            shuffle($product_ids);
            return $product_ids;
        };

        // User name=memberA
        //   Order 3
        //   Review 3 product_id=1,2,3

        User::factory()
        ->state(['name' => 'memberA'])
        ->has(
            Order::factory(3)
            ->state(function (array $attributes, User $user) {
                return [
                    'email' => $user->email,
                    'name' => $user->name,
                    'postal1' => $user->postal1,
                    'postal2' => $user->postal2,
                    'address' => $user->address,
                    'tel' => $user->tel,
                ];
            })
        )
        ->has(
            Review::factory(3)
            ->state(new Sequence(
                ['product_id' => 1],
                ['product_id' => 2],
                ['product_id' => 3],
            ))
        )
        ->create();

        // User name=memberB

        User::factory()
        ->state(['name' => 'memberB'])
        ->create();

        // User 10
        //   Order 3
        //   Review 3

        User::factory(10)
        ->has(
            Order::factory(3)
            ->state(function (array $attributes, User $user) {
                return [
                    'email' => $user->email,
                    'name' => $user->name,
                    'postal1' => $user->postal1,
                    'postal2' => $user->postal2,
                    'address' => $user->address,
                    'tel' => $user->tel,
                ];
            })
        )
        ->has(
            Review::factory(3)
            ->state(new Sequence(...$shuffle_ids()))
        )
        ->create();
    }
}
