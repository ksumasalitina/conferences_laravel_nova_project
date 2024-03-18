<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $lecture_id
 * @property string $comment
 *
 * @property Lecture $lecture
 * @property User $user
 */
class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
