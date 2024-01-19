<?php

namespace App\Listeners;

use App\Events\NotificationSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotificationListener
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        return $event->notification;
    }
}
