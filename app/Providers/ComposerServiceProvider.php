<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\CartComposer;
use App\Http\ViewComposers\UserComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            ['*'],
            UserComposer::class
        );
        View::composer(
            ['cart.*', 'components.cart-items-s'],
            CartComposer::class
        );
    }
}
