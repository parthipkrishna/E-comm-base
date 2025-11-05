<?php

namespace App\Providers;
use App\Models\Category;
use App\Models\CompanyInfo;
use App\Models\SocialMediaLink;
use Illuminate\Support\ServiceProvider;
use View;

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
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('companyinfo', CompanyInfo::first());
            $view->with('socialLinks', SocialMediaLink::all()->keyBy('platform'));
            $view->with('categories', Category::all());
        });
    }
}
