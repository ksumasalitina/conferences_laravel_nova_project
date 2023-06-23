<?php

namespace App\Exports;

use App\Models\Meeting;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
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
        $meeting = Meeting::findOrFail($this->meetingId);
        $members = array_column($meeting->subscribers->toArray(),'id');

        return User::query()->select('first_name','last_name','birthdate','country','phone','email')->whereIn('id',$members)->get();
    }

    public function headings(): array
    {
        return ['First name','Last name','Birthdate','Country','Phone','Email'];
    }
}
