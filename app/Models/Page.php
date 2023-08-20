<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeGetOnlyParent(Builder $query)
    {
        return $query->whereNull('page_id');
    }

    public function parent()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class, 'page_id', 'id');
    }
}
