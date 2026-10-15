<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubjectDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'subject_topic_id',
        'title',
        'description',
        'document_type',
        'file_format',
        'file_size',
        'file_url',
        'download_count',
        'is_featured',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'download_count' => 'integer',
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
     * @return BelongsTo<SubjectTopic, $this>
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(SubjectTopic::class, 'subject_topic_id');
    }
}
