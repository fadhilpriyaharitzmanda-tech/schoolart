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
        Schema::create('grade_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('phase');
            $table->unsignedTinyInteger('level_number');
            $table->text('description')->nullable();
            $table->string('badge_text')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grade_level_id')->constrained('grade_levels')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('code')->nullable();
            $table->enum('category', ['umum', 'kejuruan'])->default('umum');
            $table->string('vocational_stream')->nullable();
            $table->text('description')->nullable();
            $table->string('semester')->default('Semester 1 & 2');
            $table->unsignedSmallInteger('total_hours')->default(72);
            $table->string('icon')->default('book');
            $table->string('color')->default('brand');
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();

            $table->unique(['grade_level_id', 'slug']);
        });

        Schema::create('subject_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug');
            $table->unsignedSmallInteger('chapter_number')->default(1);
            $table->text('summary')->nullable();
            $table->json('key_points')->nullable();
            $table->unsignedSmallInteger('estimated_minutes')->default(20);
            $table->text('ai_prompt_suggestion')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::create('subject_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('subject_topic_id')->nullable()->constrained('subject_topics')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('document_type')->default('modul');
            $table->string('file_format')->default('PDF');
            $table->string('file_size')->default('1.5 MB');
            $table->string('file_url')->nullable();
            $table->unsignedInteger('download_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_documents');
        Schema::dropIfExists('subject_topics');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('grade_levels');
    }
};
