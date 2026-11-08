<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentDiscussionReply extends Model
{
    protected $fillable = ['discussion_id', 'user_id', 'body', 'status'];

    public function discussion(): BelongsTo
    {
        return $this->belongsTo(StudentDiscussion::class, 'discussion_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
