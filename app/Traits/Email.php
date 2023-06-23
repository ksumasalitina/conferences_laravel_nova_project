<?php

namespace App\Traits;
use App\Events\AddLecture;
use App\Events\DeleteLecture;
use App\Events\UpdateLecture;
use App\Models\Lecture;
use App\Models\Meeting;
use App\Models\Slot;
use App\Models\User;

trait Email
{
    public function newLectureEmail(Lecture $lecture)
    {
        $meeting = Meeting::findOrFail($lecture->meeting_id);
        $user = User::findOrFail($lecture->user_id);

        $listeners = array_column($meeting->subscribers->toArray(),'id');
        $recipient = User::query()->select('email')->whereIn('id',$listeners)
            ->whereHas('role', function ($q) {
                $q->where('name','listener');})->get();

        event(new AddLecture($meeting, $user, $lecture, $recipient));
    }

    public function updateLectureEmail(Lecture $lecture, $slot)
    {
        $meeting = Meeting::findOrFail($lecture->meeting_id);
        $user = User::findOrFail($lecture->user_id);
        $time = Slot::findOrFail($slot);

        $listeners = array_column($meeting->subscribers->toArray(),'id');
        $recipient = User::query()->select('email')->whereIn('id',$listeners)
            ->whereHas('role', function ($q) {
                $q->where('name','listener');})->get();

        event(new UpdateLecture($meeting, $lecture, $user, $time, $recipient));
    }

    public function deleteLectureEmail(Lecture $lecture)
    {
        $meeting = Meeting::findOrFail($lecture->meeting_id);
        $user = User::findOrFail($lecture->user_id);

        event(new DeleteLecture($meeting,$user->email));
    }
}
