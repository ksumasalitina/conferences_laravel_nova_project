<?php

namespace App\Traits;

use App\Events\FinishedExport;
use App\Exports\CommentExport;
use App\Exports\LectureExport;
use App\Exports\MeetingExport;
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

trait Export
{
    public function exportMeetings()
    {
        broadcast(new FinishedExport());
        return Excel::download(new MeetingExport, 'meetings.csv');
    }

    public function exportSubscribers($meetingId)
    {
        broadcast(new FinishedExport());
        return Excel::download(new UserExport($meetingId), 'members.csv');
    }

    public function exportLectures($meetingId)
    {
        broadcast(new FinishedExport());
        return Excel::download(new LectureExport($meetingId), 'lectures.csv');
    }

    public function exportComments($lectureId)
    {
        broadcast(new FinishedExport());
        return Excel::download(new CommentExport($lectureId),'comments.csv');
    }
}
