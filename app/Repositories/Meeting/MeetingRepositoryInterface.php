<?php

namespace App\Repositories\Meeting;

use App\Http\Requests\MeetingRequest;
use Illuminate\Http\Request;

interface MeetingRepositoryInterface
{
    public function getAllMeetings();
    public function getMeetingsByFilter(Request $request);
    public function searchMeeting(Request $request);
    public function getMeetingById($id);
    public function deleteMeeting($id);
    public function createMeeting(MeetingRequest $meetingRequest);
    public function updateMeeting($id, MeetingRequest $meetingRequest);
    public function getCountries();
    public function sendNewListenerEmail($meeting, $user);
    public function join($id);
    public function cancel($id);
}
