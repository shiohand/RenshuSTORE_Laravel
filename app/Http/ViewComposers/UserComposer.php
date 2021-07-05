<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class UserComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        $data = compact([
            'user',
        ]);

        $view->with($data);
    }
}
