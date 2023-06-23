<?php

namespace App\Exports;

use App\Models\Comment;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommentExport implements FromCollection, WithHeadings
{
    private $lectureId;

    public function __construct($lectureId)
    {
        $this->lectureId = $lectureId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $comments = Comment::query()->select('user_id','comment','created_at')->where('lecture_id',$this->lectureId)->get();
        foreach ($comments as $comment) {
            $user = User::query()->select('first_name', 'last_name')->where('id',$comment->user_id)->first();
            $comment->first_name = $user->first_name;
            $comment->last_name = $user->last_name;
        }

        return $comments->transform(function ($i){
            unset($i->user_id);
            unset($i->id);
            return $i;
        });
    }

    public function headings(): array
    {
        return ["Comment", "Created_at", "First name", "Last_name"];
    }
}
