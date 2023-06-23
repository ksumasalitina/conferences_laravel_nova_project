<?php

namespace App\Exports;

use App\Models\Lecture;
use App\Models\Meeting;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MeetingExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $meetings = Meeting::select('id','title', 'date', 'latitude', 'longitude', 'country')->get();
        foreach ($meetings  as $meeting) {
            $lectures = Lecture::query()->select('id')->where('meeting_id',$meeting->id)->get();

            $meeting->lectures = strval(count($lectures));
            $meeting->members = strval(count($meeting->subscribers));
        }
        return $meetings;
    }

    public function headings(): array
    {
        return ["ID", "Title", "Date", "Latitude", "Longitude", "Country", "Lectures", "Members"];
    }
}
