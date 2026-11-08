<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicDepartment extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected $fillable = ['name', 'code', 'slug', 'description', 'icon', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean'];

    public function resources(): HasMany
    {
        return $this->hasMany(AcademicResource::class, 'department_id');
    }
}
