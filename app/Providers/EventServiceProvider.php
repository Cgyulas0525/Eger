<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\LoginHistory;
use App\Listeners\storeUserLoginHistory;
use App\Events\SendMail;
use App\Listeners\SendMailFired;
use App\Events\SendValidationMail;
use App\Listeners\SendValidationMailFired;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        LoginHistory::class => [
            storeUserLoginHistory::class,
        ],
        SendMail::class => [
            SendMailFired::class,
        ],
        SendValidationMail::class => [
            SendValidationMailFired::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
