<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $start
 * @property string $end
 *
 * @property Collection<Meeting> $meetings
 * @property Collection<Lecture> $lectures
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
