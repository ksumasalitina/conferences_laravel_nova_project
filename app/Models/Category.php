<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $parent_id
 * @property string $name
 *
 * @property Collection<Category> $children
 * @property Category $parent
 * @property Collection<Meeting> $meetings
 * @property Collection<Lecture> $lectures
 */
class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->with('children');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id')
            ->with('parent');
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class);
    }
}
