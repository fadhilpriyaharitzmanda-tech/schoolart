<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubjectTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'title',
        'slug',
        'chapter_number',
        'summary',
        'key_points',
        'estimated_minutes',
        'ai_prompt_suggestion',
        'order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'key_points' => 'array',
        ];
    }

    /**
     * @return BelongsTo<Subject, $this>
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * @return HasMany<SubjectDocument, $this>
     */
    public function documents(): HasMany
    {
        return $this->hasMany(SubjectDocument::class);
    }
}
