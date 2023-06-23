<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecture_id',
        'user_id',
        'comment'
    ];

    protected $casts = [
        'lecture_id'=>'integer',
        'user_id'=>'integer',
        'comment'=>'string'
    ];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
