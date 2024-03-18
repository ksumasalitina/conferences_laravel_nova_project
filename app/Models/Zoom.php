<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $uuid
 * @property string $host_id
 * @property string $topic
 * @property string $start_time
 * @property int $duration
 * @property string $timezone
 * @property string $join_url
 */
class Zoom extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lecture()
    {
        return $this->hasOne(Lecture::class);
    }
}
