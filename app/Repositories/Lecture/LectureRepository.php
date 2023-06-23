<?php

namespace App\Repositories\Lecture;

use App\Http\Requests\LectureRequest;
use App\Models\Lecture;
use App\Models\Meeting;
use App\Models\Slot;
use App\Traits\ZoomJWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LectureRepository implements LectureRepositoryInterface
{
    use ZoomJWT;

    public function getMeetingLectures($id)
    {
        $lectures =  Lecture::where('meeting_id',$id)->get();
        $user = auth('sanctum')->user();
        $date = Meeting::select('date')->whereId($id)->first();
        $date = date('Y-m-d', $date->date);

        foreach ($lectures as $lecture) {
            $slot = Slot::findOrFail($lecture->slot_id);
            $start_datetime = new \DateTime($date . ' ' .$slot->start);
            $end_datetime = new \DateTime($date . ' ' .$slot->end);
            $now = new \DateTime('now');

            if($now > $start_datetime && $now < $end_datetime) {
                $lecture->status = 'Started';
            } elseif ($now > $end_datetime) {
                $lecture->status = 'Ended';
            } else {
                $lecture->status = 'Waiting';
            }

            $lecture->start = $slot->start;
            $lecture->end = $slot->end;
            $lecture->is_favorite = $user->isFavorite($lecture->id);
        }

        return $lectures;
    }

    public function getLecture($id)
    {
        $lecture = Lecture::findOrFail($id);
        $slot = Slot::findOrFail($lecture->slot_id);
        $meeting = Meeting::findOrFail($lecture->meeting_id);

        if($lecture->zoom_id){
            $zoom = $this->getZoom($lecture->zoom_id);
            $lecture->start_time = $zoom['data']['start_time'];
            $lecture->zoom_link = $zoom['data']['join_url'];
        }

        $lecture->start = $slot->start;
        $lecture->end = $slot->end;
        $lecture->category = $lecture->category;
        $lecture->is_joined = $meeting->isJoined();

        return $lecture;
    }

    public function getLecturesByFilters(Request $request)
    {
        $query = Lecture::query()->where('meeting_id',$request['id']);

        if($request['start_time'])
            $query = $query->startTimeFilter($request['start_time']);
        if($request['end_time'])
            $query = $query->endTimeFilter($request['end_time']);
        if($request['category'])
            $query = $query->categoryFilter($request['category']);

        $lectures = $query->get();

        $user = auth('sanctum')->user();
        foreach ($lectures as $lecture) {
            $slot = Slot::findOrFail($lecture->slot_id);
            $lecture->start = $slot->start;
            $lecture->end = $slot->end;
            $lecture->is_favorite = $user->isFavorite($lecture->id);
        }

        return $lectures;
    }

    public function searchLectures(Request $request)
    {
        $query = Lecture::query()->select('id', 'theme');

        if($request->filled('title'))
            $query = $query->search($request['title']);

        return $query->get();
    }

    public function createLecture(LectureRequest $request)
    {
        $request['user_id'] = auth('sanctum')->id();

        $data = $request->only([
            'user_id',
            'meeting_id',
            'slot_id',
            'theme',
            'description'
        ]);

        return Lecture::create($data);
    }

    public function deleteLecture($id)
    {
        return Lecture::destroy($id);
    }

    public function updateLecture(LectureRequest $request, $id)
    {
        $data = $request->only([
            'user_id',
            'slot_id',
            'meeting_id',
            'theme',
            'description',
        ]);

        return Lecture::where('id',$id)->update($data);
    }

    public function getSlots($id)
    {
        $meeting = Meeting::findOrFail($id);
        return $meeting->slots;
    }

    public function getMeetingUserLecture($id)
    {
        $lecture = Lecture::where('meeting_id',$id)->where('user_id', auth('sanctum')->id())->get();
        return $lecture[0]->id;
    }

    public function downloadPresentation($presentation)
    {
        return Storage::disk('local')->download('presentations/'.$presentation);
    }
}
