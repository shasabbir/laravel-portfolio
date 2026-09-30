<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer(['home', 'partials.header', 'partials.footer'], function ($view) {
            $content = request()->attributes->get('siteContent');
            if (!$content) {
                $content = \App\Models\HomeContent::find(1) ?? new \App\Models\HomeContent;
                request()->attributes->set('siteContent', $content);
            }
            $view->with('siteContent', $content);
        });
    }
}
