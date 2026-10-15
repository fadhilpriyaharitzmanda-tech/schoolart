<?php

namespace App\Http\Controllers;

use App\Models\GradeLevel;
use App\Models\SchoolSchedule;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JadwalController extends Controller
{
    /**
     * Display the interactive weekly school schedule page.
     */
    public function index(Request $request): View
    {
        $gradeSlug = $request->input('tingkat', 'kelas-11');
        $gradeLevel = GradeLevel::where('slug', $gradeSlug)->first()
            ?? GradeLevel::where('slug', 'kelas-11')->firstOrFail();

        $allGrades = GradeLevel::orderBy('order')->get();

        // Fetch all schedules for this grade, eager-loading subject and topics
        $schedules = SchoolSchedule::with(['subject.gradeLevel'])
            ->where('grade_level_id', $gradeLevel->id)
            ->orderBy('day_of_week')
            ->orderBy('order')
            ->get();

        // Group by day of week (1 = Senin ... 5 = Jumat)
        $groupedSchedules = $schedules->groupBy('day_of_week');

        // Current real-time clock (WIB)
        $now = Carbon::now('Asia/Jakarta');
        $currentDayOfWeek = (int) $now->format('N'); // 1 = Monday ... 7 = Sunday
        $currentTime = $now->format('H:i');

        // Allow simulation override via query params (e.g. ?sim_day=1&sim_time=08:30)
        $simulatedDay = $request->filled('sim_day') ? (int) $request->input('sim_day') : null;
        $simulatedTime = $request->input('sim_time');

        $activeDay = $simulatedDay ?? ($currentDayOfWeek >= 1 && $currentDayOfWeek <= 5 ? $currentDayOfWeek : 1);
        $effectiveTime = $simulatedTime ?? $currentTime;

        // Find active slot for currently selected/effective day and time
        $activeSlot = null;
        if ($groupedSchedules->has($activeDay)) {
            $activeSlot = $groupedSchedules[$activeDay]->first(function ($slot) use ($effectiveTime) {
                return $effectiveTime >= $slot->start_time && $effectiveTime <= $slot->end_time;
            });
        }

        // Calculate weekly statistics
        $stats = [
            'total_jp' => $schedules->where('activity_type', 'lesson')->sum('hours_count'),
            'total_kejuruan_jp' => $schedules->where('category', 'kejuruan')->sum('hours_count'),
            'total_umum_jp' => $schedules->where('category', 'umum')->sum('hours_count'),
            'unique_subjects' => $schedules->whereNotNull('subject_id')->pluck('subject_id')->unique()->count(),
            'total_slots' => $schedules->count(),
        ];

        $days = [
            1 => ['name' => 'Senin', 'badge' => 'PBO & Basis Data SQL'],
            2 => ['name' => 'Selasa', 'badge' => 'Web PWPB & Produk Kreatif'],
            3 => ['name' => 'Rabu', 'badge' => 'Pemodelan UML & Matematika'],
            4 => ['name' => 'Kamis', 'badge' => 'Query Lanjut & Proyek OOP'],
            5 => ['name' => 'Jumat', 'badge' => 'REST API Web & Pembiasaan'],
        ];

        return view('jadwal.index', [
            'gradeLevel' => $gradeLevel,
            'allGrades' => $allGrades,
            'schedules' => $schedules,
            'groupedSchedules' => $groupedSchedules,
            'stats' => $stats,
            'days' => $days,
            'activeDay' => $activeDay,
            'currentDayOfWeek' => $currentDayOfWeek,
            'currentTime' => $currentTime,
            'effectiveTime' => $effectiveTime,
            'activeSlot' => $activeSlot,
            'isSimulated' => $simulatedDay !== null || $simulatedTime !== null,
        ]);
    }

    /**
     * API to check currently active lesson in real-time.
     */
    public function currentActive(Request $request): JsonResponse
    {
        $now = Carbon::now('Asia/Jakarta');
        $dayOfWeek = (int) $request->input('day', $now->format('N'));
        $time = $request->input('time', $now->format('H:i'));

        $activeSlot = SchoolSchedule::with(['subject.gradeLevel'])
            ->where('day_of_week', $dayOfWeek)
            ->where('start_time', '<=', $time)
            ->where('end_time', '>=', $time)
            ->first();

        return response()->json([
            'status' => 'success',
            'server_time' => $time,
            'day_of_week' => $dayOfWeek,
            'has_active' => $activeSlot !== null,
            'active_slot' => $activeSlot,
        ]);
    }
}
