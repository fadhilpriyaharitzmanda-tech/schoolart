<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use App\Models\Subject;
use App\Models\SubjectDocument;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the student dashboard with SMK curriculum integration.
     */
    public function index(): View
    {
        // Featured / In-progress SMK subjects for the student
        $activeSubjects = Subject::with(['gradeLevel', 'topics'])
            ->whereIn('slug', [
                'pemrograman-berorientasi-objek',
                'pemrograman-web-perangkat-bergerak',
                'basis-data-relasional-sql',
            ])
            ->get();

        // If specific subjects not found, fallback to first 3 subjects
        if ($activeSubjects->isEmpty()) {
            $activeSubjects = Subject::with(['gradeLevel', 'topics'])->take(3)->get();
        }

        // Add concise student progress & real photo thumbnails
        $progressMap = [
            'pemrograman-berorientasi-objek' => [
                'short_name' => 'PBO Java',
                'progress' => 70,
                'time' => '08.00 – 09.30 WIB',
                'status' => 'Sedang Belajar',
                'teacher' => 'Pak Hendra',
                'image' => 'images/subjects/pbo.jpg',
                'short_topic' => 'Enkapsulasi & Pewarisan',
            ],
            'pemrograman-web-perangkat-bergerak' => [
                'short_name' => 'Pemrograman Web',
                'progress' => 45,
                'time' => '10.00 – 11.30 WIB',
                'status' => 'Berikutnya',
                'teacher' => 'Bu Dewi',
                'image' => 'images/subjects/pwpb.jpg',
                'short_topic' => 'MVC & Routing Laravel',
            ],
            'basis-data-relasional-sql' => [
                'short_name' => 'Basis Data',
                'progress' => 85,
                'time' => '13.00 – 14.30 WIB',
                'status' => 'Terjadwal',
                'teacher' => 'Pak Rahmat',
                'image' => 'images/subjects/database.jpg',
                'short_topic' => 'Normalisasi 3NF & SQL',
            ],
        ];

        foreach ($activeSubjects as $subj) {
            $meta = $progressMap[$subj->slug] ?? [
                'short_name' => $subj->name,
                'progress' => 50,
                'time' => '08.00 – 09.30 WIB',
                'status' => 'Aktif',
                'teacher' => 'Guru Pengampu',
                'image' => 'images/subjects/pbo.jpg',
                'short_topic' => 'Materi Pokok',
            ];
            $subj->short_name = $meta['short_name'];
            $subj->student_progress = $meta['progress'];
            $subj->schedule_time = $meta['time'];
            $subj->schedule_status = $meta['status'];
            $subj->teacher_name = $meta['teacher'];
            $subj->image = $meta['image'];
            $subj->short_topic = $meta['short_topic'];
        }

        // Featured downloadable documents
        $featuredDocuments = SubjectDocument::with(['subject.gradeLevel'])
            ->where('is_featured', true)
            ->take(3)
            ->get();

        // Quick curriculum counts
        $grades = GradeLevel::withCount('subjects')->orderBy('order')->get();
        $totalSubjects = Subject::count();
        $totalDocuments = SubjectDocument::count();

        return view('dashboard', [
            'activeSubjects' => $activeSubjects,
            'featuredDocuments' => $featuredDocuments,
            'grades' => $grades,
            'totalSubjects' => $totalSubjects,
            'totalDocuments' => $totalDocuments,
        ]);
    }
}
