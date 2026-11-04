<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::create('resource_items', function(Blueprint $t) {
  $t->id(); $t->foreignId('department_id')->constrained()->cascadeOnDelete();
  $t->string('title',180); $t->text('description'); $t->string('category',80);
  $t->string('subject',150); $t->string('subject_code',40)->nullable(); $t->string('semester',40);
  $t->string('academic_year',20)->nullable(); $t->string('uploader_name',120);
  $t->string('file_path')->nullable(); $t->string('original_filename')->nullable(); $t->unsignedBigInteger('file_size')->default(0);
  $t->enum('status',['pending','approved','rejected'])->default('pending')->index();
  $t->unsignedInteger('downloads')->default(0); $t->boolean('is_featured')->default(false); $t->timestamps();
 });}
 public function down(): void { Schema::dropIfExists('resource_items'); }
};
