<?php

namespace Nrox\LaravelNotification;

use Closure;
use Nrox\LaravelNotification\Http\Livewire\Notification;
use Livewire\Livewire;
use Livewire\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\ServiceProvider;

class LaravelNotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        Livewire::component('laravel-notification.notice', Notification::class);

        RedirectResponse::macro('notice', $this->notification());
        Redirector::macro('notice', $this->notification());
        Component::macro('notice', function (string $message, string $type = 'info', ?int $timer = null, ?string $title = null) {
            $notice = [
                'message' => $message,
                'type' => $type,
                'timer' => $timer ?? config('notification.timer'),
            ];

            if (isset($title)):
                $notice['title'] = $title;
            endif;

            $this->dispatchBrowserEvent('notice', $notice);
        });

        $this->publishes([
            __DIR__.'/../config/notification.php' => config_path('notification.php'),
        ], 'laravel-notification-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-notification'),
        ], 'laravel-notification-views');

        $this->publishes([
            __DIR__.'/../config/notification.php' => config_path('notification.php'),
            __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-notification'),
            __DIR__.'/../resources/css' => public_path('vendor/laravel-notification/css'),
        ], 'laravel-notification');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-notification');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/notification.php', 'notification'
        );
    }

    private function notification(): Closure
    {
        return function (string $message, string $type = 'info', ?int $timer = null, ?string $title = null) {
            $notice = [
                'message' => $message,
                'type' => $type,
                'timer' => $timer ?? config('notification.timer'),
            ];

            if (isset($title)):
                $notice['title'] = $title;
            endif;

            Session::push('notifications', $notice);

            return $this;
        };
    }
}
