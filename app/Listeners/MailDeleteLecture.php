<?php

namespace App\Listeners;

use App\Events\DeleteLecture;
use App\Mail\DeleteLectureEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailDeleteLecture
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
     * @param  \App\Events\DeleteLecture  $event
     * @return void
     */
    public function handle(DeleteLecture $event)
    {
        Mail::to($event->recipient)->send(new DeleteLectureEmail($event->meeting));
    }
}
