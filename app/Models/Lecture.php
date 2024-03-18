<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $meeting_id
 * @property string $theme
 * @property string $description
 * @property string $presentation
 * @property int $slot_id
 * @property int $zoom_id
 *
 * @property Collection<Category> $categories
 * @property Collection<Comment> $comments
 * @property User $announcer
 * @property Slot $slot
 * @property Meeting $meeting
 * @property Zoom $zoom
 */
class Lecture extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function announcer()
    {
        return $this->belongsTo(User::class);
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function zoom()
    {
        return $this->belongsTo(Zoom::class);
    }

    public function scopeStartTimeFilter($query, $param)
    {
        return $query->select('*')
            ->join('slots', 'slot_id', '=', 'slots.id')
            ->where('slots.start', '=', $param);
    }

    public function scopeEndTimeFilter($query, $param)
    {
        return $query->select('*')
            ->join('slots', 'slot_id', '=', 'slots.id')
            ->where('slots.end', '=', $param);
    }

    public function scopeCategoryFilter($query, $param)
    {
        return $query->whereHas('category', function ($q) use ($param) {
            $q->whereIn('category_id', $param);
        });
    }

    public function scopeSearch($query, $param)
    {
        return $query->where('theme', 'LIKE', "%{$param}%");
    }
}
