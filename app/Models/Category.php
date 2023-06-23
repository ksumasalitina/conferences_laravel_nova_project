<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id'
    ];

    protected $casts = [
        'name'=>'string',
        'parent_id'=>'integer'
    ];

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
