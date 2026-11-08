<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('code', 20)->unique();
            $table->string('slug', 180)->unique();
            $table->text('description')->nullable();
            $table->string('icon', 60)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('academic_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained('academic_departments')->nullOnDelete();
            $table->foreignId('uploader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('uploader_name', 150)->nullable();
            $table->string('title', 220);
            $table->string('slug', 240)->unique();
            $table->string('subject', 180);
            $table->string('course_code', 50)->nullable();
            $table->unsignedTinyInteger('semester')->nullable();
            $table->string('category', 80)->default('Class Notes');
            $table->longText('description')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('mime_type', 120)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->string('cover_image')->nullable();
            $table->unsignedInteger('page_count')->nullable();
            $table->decimal('rating_average', 3, 2)->default(0);
            $table->unsignedInteger('rating_count')->default(0);
            $table->unsignedInteger('downloads_count')->default(0);
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->string('status', 20)->default('pending')->index();
            $table->text('moderation_note')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->index(['department_id', 'semester', 'category']);
            $table->index(['status', 'created_at']);
        });

        Schema::create('resource_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_resource_id')->constrained('academic_resources')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['user_id', 'academic_resource_id'], 'resource_bookmark_unique');
        });

        Schema::create('resource_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_resource_id')->constrained('academic_resources')->cascadeOnDelete();
            $table->unsignedTinyInteger('rating');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'academic_resource_id'], 'resource_review_unique');
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('email', 190);
            $table->string('subject', 200)->nullable();
            $table->text('message');
            $table->string('status', 20)->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('resource_reviews');
        Schema::dropIfExists('resource_bookmarks');
        Schema::dropIfExists('academic_resources');
        Schema::dropIfExists('academic_departments');
    }
};
