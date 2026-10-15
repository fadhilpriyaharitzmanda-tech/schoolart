<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchoolSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_level_id',
        'subject_id',
        'day_of_week',
        'day_name',
        'start_time',
        'end_time',
        'title',
        'code',
        'teacher_name',
        'room',
        'activity_type',
        'category',
        'hours_count',
        'order',
    ];

    /**
     * @return BelongsTo<GradeLevel, $this>
     */
    public function gradeLevel(): BelongsTo
    {
        return $this->belongsTo(GradeLevel::class);
    }

    /**
     * @return BelongsTo<Subject, $this>
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    protected $appends = [
        'subject_name',
        'time_range',
    ];

    /**
     * Get the subject name or title.
     */
    public function getSubjectNameAttribute(): string
    {
        return $this->title ?? $this->subject?->name ?? 'Kegiatan Belajar';
    }

    /**
     * Get formatted time range string.
     */
    public function getTimeRangeAttribute(): string
    {
        return $this->start_time.' - '.$this->end_time;
    }

    /**
     * Determine if this slot is a break/non-lesson period.
     */
    public function isBreak(): bool
    {
        return $this->activity_type === 'break' || $this->activity_type === 'ceremony';
    }
}
