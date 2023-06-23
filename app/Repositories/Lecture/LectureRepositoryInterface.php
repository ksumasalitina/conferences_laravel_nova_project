<?php

namespace App\Repositories\Lecture;

use App\Http\Requests\LectureRequest;
use Illuminate\Http\Request;

interface LectureRepositoryInterface
{
    public function getMeetingLectures($id);
    public function getLecture($id);
    public function getLecturesByFilters(Request $request);
    public function searchLectures(Request $request);
    public function createLecture(LectureRequest $request);
    public function deleteLecture($id);
    public function updateLecture(LectureRequest $request, $id);
    public function getSlots($id);
    public function getMeetingUserLecture($id);
    public function downloadPresentation($presentation);
}
