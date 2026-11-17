<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('number')->unique();
            $table->string('name', 100)->unique();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('academic_resource_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $semesters = [];
        for ($number = 1; $number <= 20; $number++) {
            $semesters[] = [
                'number' => $number,
                'name' => $number . ($number % 100 >= 11 && $number % 100 <= 13 ? 'th' : ([1 => 'st', 2 => 'nd', 3 => 'rd'][$number % 10] ?? 'th')) . ' Semester',
                'is_active' => true,
                'sort_order' => $number,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('academic_semesters')->insert($semesters);

        $categories = ['Class Notes', 'Previous Questions', 'Assignments', 'Lab Reports', 'Lecture Slides'];
        foreach ($categories as $index => $name) {
            DB::table('academic_resource_categories')->insert([
                'name' => $name,
                'slug' => \Illuminate\Support\Str::slug($name),
                'description' => null,
                'is_active' => true,
                'sort_order' => $index + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_resource_categories');
        Schema::dropIfExists('academic_semesters');
    }
};
