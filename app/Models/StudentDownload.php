<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentDownload extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'academic_resource_id', 'downloaded_at'];
    protected $casts = ['downloaded_at' => 'datetime'];

    public function resource(): BelongsTo
    {
        return $this->belongsTo(AcademicResource::class, 'academic_resource_id');
    }
}
