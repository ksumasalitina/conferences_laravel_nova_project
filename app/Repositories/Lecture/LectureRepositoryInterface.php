<?php

namespace App\Repositories\Lecture;

use App\Http\Requests\LectureRequest;
use App\Models\Lecture;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface LectureRepositoryInterface
{
    public function getMeetingLectures($id): Collection;
    public function getLecture($id): Lecture;
    public function getLecturesByFilters(Request $request): Collection;
    public function searchLectures(Request $request): Collection;
    public function createLecture(LectureRequest $request): Lecture;
    public function deleteLecture($id): int;
    public function updateLecture(LectureRequest $request, $id): int;
    public function getSlots($id): Collection;
    public function getMeetingUserLecture($id): int;
    public function downloadPresentation($presentation): StreamedResponse;
}
