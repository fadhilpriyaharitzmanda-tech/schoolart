<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradeLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'phase',
        'level_number',
        'description',
        'badge_text',
        'order',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * @return HasMany<Subject, $this>
     */
    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class)->orderBy('order');
    }

    /**
     * @return HasMany<Subject, $this>
     */
    public function generalSubjects(): HasMany
    {
        return $this->hasMany(Subject::class)->where('category', 'umum')->orderBy('order');
    }

    /**
     * @return HasMany<Subject, $this>
     */
    public function vocationalSubjects(): HasMany
    {
        return $this->hasMany(Subject::class)->where('category', 'kejuruan')->orderBy('order');
    }
}
