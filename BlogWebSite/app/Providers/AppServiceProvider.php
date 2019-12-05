<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['home'], function($view) {
            $view->with('posts', Post::where('author_id', '=', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(3));
        });
    }
}
