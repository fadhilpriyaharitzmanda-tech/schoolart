<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('school_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_level_id')->constrained('grade_levels')->cascadeOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->nullOnDelete();
            $table->unsignedTinyInteger('day_of_week'); // 1 = Senin, 2 = Selasa, 3 = Rabu, 4 = Kamis, 5 = Jumat
            $table->string('day_name');
            $table->string('start_time'); // e.g. '07:45'
            $table->string('end_time');   // e.g. '09:45'
            $table->string('title');
            $table->string('code')->nullable();
            $table->string('teacher_name')->nullable();
            $table->string('room')->default('Ruang Kelas');
            $table->string('activity_type')->default('lesson'); // lesson, break, ceremony, activity
            $table->string('category')->default('kejuruan');    // kejuruan, umum, non-lesson
            $table->unsignedTinyInteger('hours_count')->default(2); // JP
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_schedules');
    }
};
