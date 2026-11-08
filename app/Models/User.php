<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles; // <-- Add this

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'student_id', 'application_number', 'institution_name', 'academic_department_id',
        'student_batch', 'semester', 'account_status', 'application_submitted_at',
        'rejection_reason', 'verification_note', 'verified_at', 'phone', 'profile_bio',
        'profile_public', 'show_in_leaderboard',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    /**
     * Public URL for the user's uploaded profile image.
     * Existing records store only the filename in users.avatar.
     */
    public function getAvatarUrlAttribute(): ?string
    {
        if (blank($this->avatar)) {
            return null;
        }

        $path = ltrim((string) $this->avatar, '/');
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (!str_starts_with($path, 'uploads/')) {
            $path = 'uploads/avatars/' . $path;
        }

        return asset($path);
    }

    public function academicResources(): HasMany
    {
        return $this->hasMany(AcademicResource::class, 'uploader_id');
    }

    public function bookmarkedResources(): BelongsToMany
    {
        return $this->belongsToMany(AcademicResource::class, 'resource_bookmarks', 'user_id', 'academic_resource_id')->withTimestamps();
    }

    public function academicDepartment()
    {
        return $this->belongsTo(AcademicDepartment::class, 'academic_department_id');
    }

    public function studentDownloads(): HasMany
    {
        return $this->hasMany(StudentDownload::class);
    }

    public function pointTransactions(): HasMany
    {
        return $this->hasMany(StudentPointTransaction::class);
    }

    public function studentNotifications(): HasMany
    {
        return $this->hasMany(StudentNotification::class);
    }

    public function discussions(): HasMany
    {
        return $this->hasMany(StudentDiscussion::class);
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'application_submitted_at' => 'datetime',
        'verified_at' => 'datetime',
        'profile_public' => 'boolean',
        'show_in_leaderboard' => 'boolean',
    ];
    
}
