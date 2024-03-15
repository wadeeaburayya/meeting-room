<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
        View::composer('layouts.sidebar', function ($view) {
            $unseenNotificationsCount = Notification::where('user_id', Auth::id())
                ->where('seen', false)
                ->count();

            $view->with('unseenNotificationsCount', $unseenNotificationsCount);
        });
    }
}
