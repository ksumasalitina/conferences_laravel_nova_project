<?php

namespace App\Listeners;

use App\Events\UpdateLecture;
use App\Mail\UpdateLectureEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailUpdateLecture
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
     * @param  \App\Events\UpdateLecture  $event
     * @return void
     */
    public function handle(UpdateLecture $event)
    {
        foreach ($event->recipient as $user) {
            Mail::to($user->email)->send(new UpdateLectureEmail($event->meeting, $event->user, $event->lecture, $event->time));
        }
    }
}
