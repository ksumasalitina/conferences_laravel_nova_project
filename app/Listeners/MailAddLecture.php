<?php

namespace App\Listeners;

use App\Events\AddLecture;
use App\Mail\NewLectureEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailAddLecture
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
     * @param  \App\Events\AddLecture  $event
     * @return void
     */
    public function handle(AddLecture $event)
    {
        foreach ($event->recipient as $user) {
            Mail::to($user->email)->send(new NewLectureEmail($event->meeting, $event->user, $event->lecture));
        }
    }
}
