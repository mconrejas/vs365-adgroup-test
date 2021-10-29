<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use OwenIt\Auditing\Models\Audit;

class UserAuthSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event) {
        Audit::create([
            'auditable_id' => auth()->user()->id,
            'auditable_type' => "Logged In",
            'event'      => "Logged In",
            'url'        => request()->fullUrl(),
            'ip_address' => request()->getClientIp(),
            'user_agent' => request()->userAgent(),
            'user_type' => auth()->user(),
            'user_id'    => auth()->user()->id,
        ]);    
    }

    /**
     * Handle user logout events.
     */
    public function handleUserLogout($event) {}

     /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        return [
            Login::class => 'handleUserLogin',
            Logout::class => 'handleUserLogout',
        ];
    }
}
