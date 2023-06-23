<?php

namespace App\Listeners;

use App\Events\AddComment;
use App\Mail\NewCommentEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailAddComment
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
     * @param  \App\Events\AddComment  $event
     * @return void
     */
    public function handle(AddComment $event)
    {
        Mail::to($event->recipient)->send(new NewCommentEmail($event->meeting, $event->user, $event->lecture));
    }
}
