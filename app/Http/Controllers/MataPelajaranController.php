<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use App\Models\Subject;
use Illuminate\View\View;

class MataPelajaranController extends Controller
{
    /**
     * Display the subject detail page with topics, documentation bank, and interactive AI chatbot.
     */
    public function show(GradeLevel $gradeLevel, Subject $subject): View
    {
        // Ensure subject belongs to the given grade level
        if ($subject->grade_level_id !== $gradeLevel->id) {
            abort(404);
        }

        $subject->load([
            'gradeLevel',
            'topics' => function ($query) {
                $query->with('documents')->orderBy('order');
            },
            'documents' => function ($query) {
                $query->with('topic')->orderBy('is_featured', 'desc')->orderBy('id', 'asc');
            },
        ]);

        // Sibling subjects in the same grade for quick navigation
        $otherSubjects = Subject::where('grade_level_id', $gradeLevel->id)
            ->where('id', '!=', $subject->id)
            ->orderBy('order')
            ->take(5)
            ->get();

        $stats = [
            'total_topics' => $subject->topics->count(),
            'total_documents' => $subject->documents->count(),
            'total_minutes' => $subject->topics->sum('estimated_minutes'),
            'total_downloads' => $subject->documents->sum('download_count'),
            'total_hours' => $subject->total_hours,
        ];

        return view('kurikulum.detail', [
            'gradeLevel' => $gradeLevel,
            'subject' => $subject,
            'topics' => $subject->topics,
            'documents' => $subject->documents,
            'otherSubjects' => $otherSubjects,
            'stats' => $stats,
        ]);
    }
}
