<?php

namespace App\Providers;

use App\Models\About;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{

    public function boot()
    {
        // Partage $about avec toutes les vues
        View::composer('*', function ($view) {
            $about = Cache::rememberForever('about_info', function () {
                return About::find(1);
            });

            $view->with('about', $about);
        });
    }
}
