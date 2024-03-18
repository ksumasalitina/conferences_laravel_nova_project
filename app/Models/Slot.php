<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $start
 * @property string $end
 *
 * @property Meeting[] $meetings
 * @property Lecture[] $lectures
 */
class Slot extends Model
{
    use HasFactory;

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
}
