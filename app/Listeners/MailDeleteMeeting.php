<?php

namespace App\Listeners;

use App\Events\DeleteMeeting;
use App\Mail\DeleteMeetingEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailDeleteMeeting
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
     * @param  \App\Events\DeleteMeeting  $event
     * @return void
     */
    public function handle(DeleteMeeting $event)
    {
        foreach ($event->recipient as $user) {
            Mail::to($user)->send(new DeleteMeetingEmail($event->meeting));
        }
    }
}
