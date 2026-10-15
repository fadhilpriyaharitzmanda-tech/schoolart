<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use App\Models\Subject;
use App\Models\SubjectDocument;
use App\Models\SubjectTopic;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KurikulumController extends Controller
{
    /**
     * Display the SMK curriculum directory page.
     */
    public function index(Request $request): View
    {
        $gradeLevels = GradeLevel::with([
            'subjects' => function ($query) {
                $query->withCount(['topics', 'documents'])->orderBy('order');
            },
        ])->orderBy('order')->get();

        $stats = [
            'total_grades' => $gradeLevels->count(),
            'total_subjects' => Subject::count(),
            'total_vocational' => Subject::where('category', 'kejuruan')->count(),
            'total_general' => Subject::where('category', 'umum')->count(),
            'total_topics' => SubjectTopic::count(),
            'total_documents' => SubjectDocument::count(),
        ];

        // Optional search and filtering
        $query = Subject::with(['gradeLevel'])->withCount(['topics', 'documents']);

        if ($search = $request->input('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('vocational_stream', 'like', "%{$search}%");
            });
        }

        if ($category = $request->input('kategori')) {
            if (in_array($category, ['umum', 'kejuruan'])) {
                $query->where('category', $category);
            }
        }

        if ($gradeSlug = $request->input('tingkat')) {
            $query->whereHas('gradeLevel', function ($q) use ($gradeSlug) {
                $q->where('slug', $gradeSlug);
            });
        }

        $allSubjects = $query->orderBy('grade_level_id')->orderBy('order')->get();

        return view('kurikulum.index', [
            'gradeLevels' => $gradeLevels,
            'stats' => $stats,
            'allSubjects' => $allSubjects,
            'currentSearch' => $request->input('q', ''),
            'currentCategory' => $request->input('kategori', ''),
            'currentGrade' => $request->input('tingkat', ''),
        ]);
    }

    /**
     * Display all subjects in a specific grade level.
     */
    public function show(GradeLevel $gradeLevel, Request $request): View
    {
        $gradeLevel->load([
            'subjects' => function ($query) {
                $query->withCount(['topics', 'documents'])->orderBy('order');
            },
        ]);

        $allGrades = GradeLevel::orderBy('order')->get();

        $generalSubjects = $gradeLevel->subjects->where('category', 'umum');
        $vocationalSubjects = $gradeLevel->subjects->where('category', 'kejuruan');

        $stats = [
            'total' => $gradeLevel->subjects->count(),
            'vocational' => $vocationalSubjects->count(),
            'general' => $generalSubjects->count(),
            'total_topics' => $gradeLevel->subjects->sum('topics_count'),
            'total_documents' => $gradeLevel->subjects->sum('documents_count'),
        ];

        return view('kurikulum.show', [
            'gradeLevel' => $gradeLevel,
            'generalSubjects' => $generalSubjects,
            'vocationalSubjects' => $vocationalSubjects,
            'allGrades' => $allGrades,
            'stats' => $stats,
        ]);
    }
}
