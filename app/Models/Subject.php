<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_level_id',
        'name',
        'slug',
        'code',
        'category',
        'vocational_stream',
        'description',
        'semester',
        'total_hours',
        'icon',
        'color',
        'order',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return BelongsTo<GradeLevel, $this>
     */
    public function gradeLevel(): BelongsTo
    {
        return $this->belongsTo(GradeLevel::class);
    }

    /**
     * @return HasMany<SubjectTopic, $this>
     */
    public function topics(): HasMany
    {
        return $this->hasMany(SubjectTopic::class)->orderBy('order');
    }

    /**
     * @return HasMany<SubjectDocument, $this>
     */
    public function documents(): HasMany
    {
        return $this->hasMany(SubjectDocument::class)->orderBy('id');
    }
}
