<?php

namespace App\Models;

use App\Http\Controllers\Api\AuthController;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $title
 * @property string $date
 * @property string $country
 * @property string latitude
 * @property string $longitude
 *
 * @property Collection<User> $subscribers
 * @property Collection<Slot> $slots
 * @property Collection<Category> $categories
 * @property Collection<Lecture> $lectures
 * @property Category $category
 */
class Meeting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subscribers()
    {
        return $this->belongsToMany(User::class);
    }

    public function slots()
    {
        return $this->belongsToMany(Slot::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function isJoined()
    {
        return $this->subscribers()->where('id',auth('sanctum')->id())->exists();
    }


    public function scopeCategoryFilter($query, $param)
    {
        return $query->whereHas('category', function ($q) use ($param) {
                $q->whereIn('category_id', $param);
                });
    }

    public function scopeFirstDateFilter($query, $param)
    {
        return $query->where('date','>',$param);
    }

    public function scopeLastDateFilter($query, $param)
    {
        return $query->where('date','<',$param);
    }

    public function scopeLecturesFilter($query, $param)
    {
        return $query->select(DB::raw('meetings.*, count(*) as count'))
            ->join('lectures', 'meeting_id', '=', 'meetings.id')
            ->groupBy('meetings.id')
            ->having('count', '=', $param);
    }

    public function scopeSearch($query, $param)
    {
        return $query->where('title', 'LIKE', "%{$param}%");
    }
}
