<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "uuid",
        "host_id",
        "topic",
        "type",
        "start_time",
        "duration",
        "timezone",
        "join_url"
    ];

    public function lecture()
    {
        return $this->hasOne(Lecture::class);
    }
}
