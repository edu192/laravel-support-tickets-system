<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Ticket;
use App\Observers\CommentObserver;
use App\Observers\TicketObserver;
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
        Ticket::observe(TicketObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
