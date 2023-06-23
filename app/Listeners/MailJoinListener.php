<?php

namespace App\Listeners;

use App\Events\JoinListener;
use App\Mail\NewListenerEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailJoinListener
{
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
     * @param  \App\Events\JoinListener  $event
     * @return void
     */
    public function handle(JoinListener $event)
    {
        foreach ($event->recipient as $user) {
            Mail::to($user->email)->send(new NewListenerEmail($event->meeting, $event->user));
        }
    }
}
