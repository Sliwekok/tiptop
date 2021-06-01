<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\Factory as ViewFactory;

class ComposerServiceProvider extends ServiceProvider
{

    public function boot(ViewFactory $view)
    {
        $view->composer(['layout', 'user.partials.header'], 'App\Http\ViewComposers\GlobalComposer');
    }

    public function register()
    {
        //
    }

}