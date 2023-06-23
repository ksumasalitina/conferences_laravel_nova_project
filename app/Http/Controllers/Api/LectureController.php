<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Lecture\LectureRepositoryInterface;
use App\Http\Requests\LectureRequest;
use App\Traits\Export;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    use Export;

    private LectureRepositoryInterface $lectureRepository;

    public function __construct(LectureRepositoryInterface $lectureRepository)
    {
        $this->lectureRepository = $lectureRepository;
    }

    public function store(LectureRequest $request)
    {
        $this->lectureRepository->createLecture($request);

        return response()->json([
            'message' => 'Lecture added successfully'
        ]);
    }

    public function show($id)
    {
        return response()->json($this->lectureRepository->getLecture($id));
    }

    public function update(LectureRequest $request, $id)
    {
        $this->lectureRepository->updateLecture($request, $id);

        return response()->json([
            'message' => 'Lecture updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $this->lectureRepository->deleteLecture($id);

        return response()->json([
            'message' => 'Lecture deleted successfully'
        ]);
    }

    public function showByMeeting($id)
    {
        return response()->json($this->lectureRepository->getMeetingLectures($id));
    }

    public function getSlots($id)
    {
        return response()->json($this->lectureRepository->getSlots($id));
    }

    public function showByMeetingUser($id)
    {
        return response()->json($this->lectureRepository->getMeetingUserLecture($id));
    }

    public function filterLectures(Request $request)
    {
        return response()->json($this->lectureRepository->getLecturesByFilters($request));
    }

    public function search(Request $request)
    {
        return response()->json($this->lectureRepository->searchLectures($request));
    }

    public function export($id)
    {
        return $this->exportLectures($id);
    }

    public function download($presentation)
    {
        return $this->lectureRepository->downloadPresentation($presentation);
    }
}
