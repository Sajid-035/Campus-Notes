<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AcademicSemester extends Model
{
    protected $fillable = ['number', 'name', 'is_active', 'sort_order'];

    protected $casts = ['number' => 'integer', 'is_active' => 'boolean'];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('number');
    }
}
