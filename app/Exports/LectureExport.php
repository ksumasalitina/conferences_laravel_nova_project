<?php

namespace App\Exports;

use App\Models\Comment;
use App\Models\Lecture;
use App\Models\Slot;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LectureExport implements FromCollection, WithHeadings
{
    private $meetingId;

    public function __construct($meetingId)
    {
        $this->meetingId = $meetingId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $lectures = Lecture::query()->select('id','theme','slot_id','description')->where('meeting_id',$this->meetingId)->get();
        $result =[];

        foreach ($lectures as $lecture) {
            $slot = Slot::query()->select('start', 'end')->where('id', $lecture->slot_id)->first();
            $comments = Comment::query()->select('id')->where('lecture_id', $lecture->id)->get();


            $lecture->start = $slot->start;
            $lecture->end = $slot->end;
            $lecture->comments = strval(count($comments));
        }

        return $lectures->transform(function ($i){
            unset($i->slot_id);
            unset($i->id);
            return $i;
        });
    }

    public function headings(): array
    {
        return ["Theme", "Description", "Start", "End", "Comments"];
    }
}
