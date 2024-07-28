<?php

namespace App\Repositories\Meeting;

use App\Http\Requests\MeetingRequest;
use App\Models\Meeting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface MeetingRepositoryInterface
{
    public function getAllMeetings();
    public function getMeetingsByFilter(Request $request);
    public function searchMeeting(Request $request): Collection;
    public function getMeetingById($id): Meeting;
    public function deleteMeeting($id): int;
    public function createMeeting(MeetingRequest $meetingRequest): Meeting;
    public function updateMeeting($id, MeetingRequest $meetingRequest): int;
    public function getCountries(): Collection;
    public function sendNewListenerEmail($meeting, $user): void;
    public function join($id): bool;
    public function cancel($id): void;
}
