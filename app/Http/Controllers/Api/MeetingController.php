<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeetingRequest;
use App\Models\Meeting;
use App\Models\User;
use App\Repositories\Meeting\MeetingRepositoryInterface;
use App\Traits\Export;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    use Export;

    private MeetingRepositoryInterface $meetingRepository;

    public function __construct(MeetingRepositoryInterface $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    public function index()
    {
        return response()->json($this->meetingRepository->getAllMeetings());
    }

    public function create()
    {
        $this->authorize('create', Meeting::class);
        return response()->json($this->meetingRepository->getCountries());
    }

    public function store(MeetingRequest $request)
    {
        $this->authorize('create', Meeting::class);
        $this->meetingRepository->createMeeting($request);

        return response()->json([
            'message' => 'Meeting created successfully'
        ]);
    }

    public function show(Meeting $meeting)
    {
        $this->authorize('view', $meeting);
        $meeting = $this->meetingRepository->getMeetingById($meeting->id);
        $meeting->is_joined = $meeting->isJoined();

        return response()->json([
            'meeting'=>$meeting
        ]);
    }

    public function update(MeetingRequest $request, Meeting $meeting)
    {
        $this->authorize('update', $meeting);
        $this->meetingRepository->updateMeeting($meeting->id,$request);

        return response()->json([
            'message' => 'Meeting updated successfully'
        ]);
    }

    public function destroy(Meeting $meeting)
    {
        $this->authorize('delete', $meeting);
        $this->meetingRepository->deleteMeeting($meeting->id);

        return response()->json([
            'message' => 'Meeting deleted successfully'
        ]);
    }

    public function join($meetingId)
    {
        return response()->json($this->meetingRepository->join($meetingId));
    }

    public function cancel($meetingId)
    {
        $this->meetingRepository->cancel($meetingId);

        return response()->json('You successfully canceled participation');
    }

    public function getCountries(){
        return response()->json($this->meetingRepository->getCountries());
    }

    public function filterMeetings(Request $request)
    {
        return response()->json($this->meetingRepository->getMeetingsByFilter($request));
    }

    public function search(Request $request)
    {
        return response()->json($this->meetingRepository->searchMeeting($request));
    }

    public function export()
    {
        return $this->exportMeetings();
    }

    public function exportMembers($id)
    {
        return $this->exportSubscribers($id);
    }
}
