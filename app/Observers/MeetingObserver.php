<?php

namespace App\Observers;

use App\Events\DeleteMeeting;
use App\Models\Meeting;

class MeetingObserver
{
    /**
     * Handle the Meeting "created" event.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return void
     */
    public function created(Meeting $meeting)
    {
        $meeting->category()->attach(request()->category);

        for($j=1;$j<=10;$j++) {
            $meeting->slots()->attach($j);
        }
    }

    /**
     * Handle the Meeting "updated" event.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return void
     */
    public function updated(Meeting $meeting)
    {
        $meeting->category()->detach($meeting->category);
        $meeting->category()->attach(request()->category);
    }

    /**
     * Handle the Meeting "deleted" event.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return void
     */
    public function deleting(Meeting $meeting)
    {
        $users = array_column($meeting->subscribers->toArray(),'email');

        event(new DeleteMeeting($meeting, $users));
    }

    /**
     * Handle the Meeting "restored" event.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return void
     */
    public function restored(Meeting $meeting)
    {
        //
    }

    /**
     * Handle the Meeting "force deleted" event.
     *
     * @param  \App\Models\Meeting  $meeting
     * @return void
     */
    public function forceDeleted(Meeting $meeting)
    {
        //
    }
}
