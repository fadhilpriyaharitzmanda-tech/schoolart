<x-layouts.app
    title="Jadwal Pelajaran SMK — Mingguan & Real-time"
    description="Sistem penjadwalan mingguan interaktif SMK dengan deteksi jam sekolah real-time dan penandaan mata pelajaran aktif.">

    {{-- ─── Breadcrumb ─── --}}
    <nav class="flex items-center gap-2 text-xs text-[oklch(0.55_0.01_265)] mb-4 pt-1">
        <a href="{{ route('dashboard') }}" class="hover:text-[var(--color-surface-950)] transition-colors">Beranda</a>
        <svg class="w-3 h-3 text-[oklch(0.70_0.01_265)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <span class="text-[var(--color-surface-950)] font-semibold">Jadwal Sekolah (Senin - Jumat)</span>
    </nav>

    {{-- ─── Header & Real-time Status Bar ─── --}}
    <div class="card p-5 sm:p-6 mb-6 border-[var(--color-surface-200)] shadow-xs bg-gradient-to-br from-white via-white to-[var(--color-brand-50)]/30">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-5">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider bg-[var(--color-brand-50)] text-[var(--color-brand-700)] border border-[var(--color-brand-200)]">
                        Semester Ganjil 2026/2027
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        {{ $gradeLevel->name }} · {{ $gradeLevel->phase }}
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--color-surface-950)] tracking-tight">
                    Jadwal Pelajaran Sekolah
                </h1>
                <p class="text-xs sm:text-sm text-[oklch(0.50_0.01_265)] mt-1">
                    Jadwal mingguan interaktif berbasis jam pelajaran (JP) real-time dengan penanda mapel aktif.
                </p>
            </div>

            {{-- Live Digital Clock & Status --}}
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <div class="px-4 py-2.5 rounded-2xl bg-white border border-[var(--color-surface-200)] shadow-2xs flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full {{ $activeSlot ? 'bg-emerald-500 animate-ping' : 'bg-slate-400' }}"></div>
                    <div>
                        <div class="flex items-center gap-1.5">
                            <span class="font-mono text-base font-extrabold text-[var(--color-surface-950)]" id="live-clock">
                                {{ $effectiveTime }} WIB
                            </span>
                            @if($isSimulated)
                                <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-amber-100 text-amber-800">Mode Simulasi</span>
                            @endif
                        </div>
                        <p class="text-[11px] text-[oklch(0.50_0.01_265)]" id="live-date">
                            {{ $days[$activeDay]['name'] ?? 'Senin' }} · Jam Sekolah SMK
                        </p>
                    </div>
                </div>

                {{-- Simulation Quick Selector --}}
                <div class="relative" x-data="{ open: false }">
                    <div class="dropdown inline-block">
                        <button type="button"
                                onclick="toggleSimDropdown()"
                                class="px-3.5 py-2.5 rounded-xl border border-[var(--color-surface-200)] bg-white hover:bg-[var(--color-surface-50)] text-xs font-semibold text-[var(--color-surface-800)] flex items-center gap-2 cursor-pointer shadow-2xs">
                            <svg class="w-4 h-4 text-[var(--color-brand-600)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <span>Simulasi Jam</span>
                            <svg class="w-3.5 h-3.5 text-[oklch(0.55_0.01_265)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div id="sim-dropdown-menu" class="hidden absolute right-0 mt-2 w-64 rounded-xl bg-white border border-[var(--color-surface-200)] shadow-panel p-2 z-30">
                            <p class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-[oklch(0.50_0.01_265)]">
                                Pilih Skenario Simulasi:
                            </p>
                            <a href="{{ route('jadwal.index') }}" class="block px-2.5 py-1.5 rounded-lg text-xs font-semibold text-[var(--color-surface-800)] hover:bg-[var(--color-surface-100)]">
                                🕒 Waktu Nyata Sekarang (Live)
                            </a>
                            <a href="{{ route('jadwal.index', ['sim_day' => 1, 'sim_time' => '08:30']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs text-[var(--color-surface-800)] hover:bg-emerald-50 hover:text-emerald-700">
                                🟢 Senin 08:30 (PBO Aktif)
                            </a>
                            <a href="{{ route('jadwal.index', ['sim_day' => 1, 'sim_time' => '10:00']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs text-[var(--color-surface-800)] hover:bg-amber-50 hover:text-amber-700">
                                ☕ Senin 10:00 (Istirahat Pagi)
                            </a>
                            <a href="{{ route('jadwal.index', ['sim_day' => 2, 'sim_time' => '10:45']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs text-[var(--color-surface-800)] hover:bg-blue-50 hover:text-blue-700">
                                🟢 Selasa 10:45 (PWPB Web Aktif)
                            </a>
                            <a href="{{ route('jadwal.index', ['sim_day' => 3, 'sim_time' => '12:00']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs text-[var(--color-surface-800)] hover:bg-purple-50 hover:text-purple-700">
                                🍽️ Rabu 12:00 (ISHOMA Siang)
                            </a>
                            <a href="{{ route('jadwal.index', ['sim_day' => 4, 'sim_time' => '13:30']) }}" class="block px-2.5 py-1.5 rounded-lg text-xs text-[var(--color-surface-800)] hover:bg-emerald-50 hover:text-emerald-700">
                                🟢 Kamis 13:30 (Basis Data SQL)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grade Switcher --}}
        <div class="mt-4 pt-3 border-t border-[var(--color-surface-100)] flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-[oklch(0.50_0.01_265)]">Pilih Tingkat:</span>
                <div class="segmented-control">
                    @foreach($allGrades as $grade)
                        <a href="{{ route('jadwal.index', array_merge(request()->query(), ['tingkat' => $grade->slug])) }}"
                           class="segmented-pill {{ $gradeLevel->id === $grade->id ? 'active' : '' }}">
                            {{ $grade->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-3 text-xs text-[oklch(0.50_0.01_265)]">
                <span>Total: <strong class="text-[var(--color-surface-900)]">{{ $stats['total_jp'] }} JP</strong>/minggu</span>
                <span>•</span>
                <span>Kejuruan: <strong class="text-emerald-700">{{ $stats['total_kejuruan_jp'] }} JP</strong></span>
                <span>•</span>
                <span>Umum: <strong class="text-blue-700">{{ $stats['total_umum_jp'] }} JP</strong></span>
            </div>
        </div>
    </div>

    {{-- ─── REAL-TIME ACTIVE LESSON CARD (Sedang Berlangsung) ─── --}}
    @if($activeSlot)
        <div class="card p-5 sm:p-6 mb-6 border-2 border-emerald-400 bg-gradient-to-r from-emerald-50/70 via-white to-emerald-50/40 shadow-md relative overflow-hidden animate-fade-in">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-100/50 rounded-full blur-2xl pointer-events-none"></div>

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 relative z-10">
                <div class="space-y-1.5 max-w-2xl">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-600 text-white shadow-2xs">
                            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                            SEDANG BERLANGSUNG SAAT INI
                        </span>
                        <span class="font-mono text-xs font-bold text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded">
                            {{ $activeSlot->time_range }}
                        </span>
                        <span class="text-xs text-[oklch(0.50_0.01_265)]">({{ $activeSlot->hours_count }} Jam Pelajaran)</span>
                    </div>

                    <h2 class="text-xl sm:text-2xl font-extrabold text-[var(--color-surface-950)]">
                        {{ $activeSlot->subject_name }}
                    </h2>

                    <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-[var(--color-surface-800)] pt-1">
                        @if($activeSlot->teacher_name)
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <span>Guru Pengampu: <strong>{{ $activeSlot->teacher_name }}</strong></span>
                            </div>
                        @endif

                        @if($activeSlot->room)
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <span>Ruang: <strong class="px-1.5 py-0.5 rounded bg-white border border-emerald-200">{{ $activeSlot->room }}</strong></span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Interactive Actions for Active Lesson --}}
                <div class="flex flex-wrap items-center gap-2.5 shrink-0 pt-2 lg:pt-0">
                    @if($activeSlot->subject)
                        <a href="{{ route('kurikulum.mapel.show', [$gradeLevel->slug, $activeSlot->subject->slug]) }}"
                           class="btn-ghost text-xs bg-white hover:bg-emerald-50 hover:border-emerald-300 font-semibold py-2 px-3.5">
                            <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            <span>Buka Modul Pembelajaran</span>
                        </a>

                        <a href="{{ route('ai.index', ['mapel' => $activeSlot->subject->slug]) }}"
                           class="btn-brand text-xs py-2 px-3.5 shadow-sm">
                            <svg class="w-4 h-4 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
                            </svg>
                            <span>Tanya AI Mapel Ini</span>
                        </a>
                    @else
                        <div class="px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-800 text-xs font-semibold">
                            Waktu Istirahat & Pembiasaan Siswa
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="card p-4 sm:p-5 mb-6 border-[var(--color-surface-200)] bg-[var(--color-surface-50)]/60 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[var(--color-surface-200)] flex items-center justify-center text-[var(--color-surface-600)] shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-[var(--color-surface-900)]">
                        Di Luar Jam Kegiatan Belajar Mengajar (KBM) Aktif
                    </h3>
                    <p class="text-xs text-[oklch(0.50_0.01_265)]">
                        Jam sekolah reguler berlangsung Senin - Jumat pukul 07:00 s.d. 15:15 WIB. Gunakan tombol "Simulasi Jam" untuk melihat simulasi kelas aktif.
                    </p>
                </div>
            </div>

            <a href="{{ route('jadwal.index', ['sim_day' => 1, 'sim_time' => '08:30']) }}"
               class="btn-ghost text-xs py-1.5 px-3 font-semibold bg-white hover:bg-emerald-50">
                Uji Coba Jam KBM (Senin 08:30) →
            </a>
        </div>
    @endif

    {{-- ─── Interactive Day Tabs (Senin - Jumat) ─── --}}
    <div class="flex items-center justify-between mb-5 flex-wrap gap-3">
        {{-- 5-Day Buttons --}}
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 max-w-full scrollbar-none">
            @foreach($days as $dayNum => $dayData)
                @php
                    $isCurrentSelected = ($activeDay == $dayNum);
                    $daySlotCount = isset($groupedSchedules[$dayNum]) ? $groupedSchedules[$dayNum]->where('activity_type', 'lesson')->sum('hours_count') : 0;
                @endphp
                <button
                    type="button"
                    onclick="selectDayTab({{ $dayNum }})"
                    id="day-tab-btn-{{ $dayNum }}"
                    class="day-tab-btn px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all duration-200 cursor-pointer flex items-center gap-2 border
                           {{ $isCurrentSelected ? 'bg-[var(--color-brand-600)] text-white border-[var(--color-brand-600)] shadow-xs' : 'bg-white text-[var(--color-surface-700)] border-[var(--color-surface-200)] hover:bg-[var(--color-surface-50)]' }}">
                    <span>{{ $dayData['name'] }}</span>
                    <span class="px-1.5 py-0.2 rounded-full text-[10px] font-semibold {{ $isCurrentSelected ? 'bg-white/20 text-white' : 'bg-[var(--color-surface-100)] text-[var(--color-surface-700)]' }}">
                        {{ $daySlotCount }} JP
                    </span>
                    @if($currentDayOfWeek == $dayNum)
                        <span class="w-2 h-2 rounded-full {{ $isCurrentSelected ? 'bg-emerald-300' : 'bg-emerald-500' }}" title="Hari Ini"></span>
                    @endif
                </button>
            @endforeach

            {{-- 5-Day Grid Overview Toggle --}}
            <button
                type="button"
                onclick="toggleWeeklyGridView()"
                id="toggle-grid-btn"
                class="px-3.5 py-2.5 rounded-xl text-xs font-semibold bg-white border border-[var(--color-surface-200)] hover:bg-[var(--color-surface-50)] text-[var(--color-surface-800)] transition-all cursor-pointer flex items-center gap-1.5 ml-1">
                <svg class="w-4 h-4 text-[var(--color-brand-600)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                </svg>
                <span id="grid-btn-label">Tampilan 5 Hari</span>
            </button>
        </div>

        <div class="text-xs text-[oklch(0.50_0.01_265)]">
            Fokus: <strong class="text-[var(--color-surface-900)]">{{ $days[$activeDay]['badge'] ?? '' }}</strong>
        </div>
    </div>

    {{-- ─── VIEW 1: SINGLE DAY DETAILED TIMELINE ─── --}}
    <div id="single-day-view" class="space-y-3">
        @foreach($days as $dayNum => $dayData)
            @php
                $daySlots = $groupedSchedules->get($dayNum, collect());
            @endphp
            <div id="day-container-{{ $dayNum }}" class="day-slot-container space-y-3 {{ $activeDay == $dayNum ? '' : 'hidden' }}">
                @if($daySlots->isEmpty())
                    <div class="card p-8 text-center">
                        <p class="text-xs text-[oklch(0.55_0.01_265)]">Belum ada data jadwal untuk hari {{ $dayData['name'] }}.</p>
                    </div>
                @else
                    @foreach($daySlots as $slot)
                        @php
                            $isSlotActive = ($activeSlot && $activeSlot->id === $slot->id);
                            $isBreak = $slot->isBreak();
                        @endphp

                        @if($isBreak)
                            {{-- Break Slot (Istirahat / ISHOMA / Pembiasaan) --}}
                            <div class="p-3.5 rounded-xl border border-dashed border-[var(--color-surface-300)] bg-[var(--color-surface-50)]/80 flex items-center justify-between {{ $isSlotActive ? 'ring-2 ring-amber-400 bg-amber-50/50' : '' }}">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xs shrink-0">
                                        ☕
                                    </span>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="text-xs sm:text-sm font-bold text-[var(--color-surface-900)]">
                                                {{ $slot->subject_name }}
                                            </h4>
                                            @if($isSlotActive)
                                                <span class="px-2 py-0.2 rounded-full text-[10px] font-bold bg-amber-200 text-amber-900 animate-pulse">
                                                    Sedang Berlangsung
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-[11px] text-[oklch(0.50_0.01_265)]">
                                            {{ $slot->room ?? 'Area Sekolah & Masjid' }}
                                        </p>
                                    </div>
                                </div>
                                <span class="font-mono text-xs font-semibold text-[oklch(0.50_0.01_265)] bg-white px-2.5 py-1 rounded-md border border-[var(--color-surface-200)]">
                                    {{ $slot->time_range }}
                                </span>
                            </div>
                        @else
                            {{-- Lesson Slot Card --}}
                            <div class="card p-4 sm:p-5 border transition-all duration-200 hover:border-[var(--color-brand-300)]
                                {{ $isSlotActive ? 'border-2 border-emerald-500 bg-emerald-50/20 shadow-md ring-2 ring-emerald-200' : 'border-[var(--color-surface-200)] bg-white' }}">

                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    {{-- Left: Time & Subject Info --}}
                                    <div class="flex items-start sm:items-center gap-3.5 min-w-0">
                                        {{-- Order number / Status Indicator --}}
                                        <div class="w-11 h-11 rounded-xl flex flex-col items-center justify-center font-bold shrink-0
                                            {{ $isSlotActive ? 'bg-emerald-600 text-white shadow-2xs' : 'bg-[var(--color-surface-100)] text-[var(--color-surface-800)] border border-[var(--color-surface-200)]' }}">
                                            <span class="text-xs font-extrabold leading-none">{{ $slot->order }}</span>
                                            <span class="text-[9px] uppercase font-mono mt-0.5 opacity-80">Jam</span>
                                        </div>

                                        <div class="min-w-0">
                                            <div class="flex flex-wrap items-center gap-2 mb-1">
                                                <span class="font-mono text-xs font-bold px-2 py-0.5 rounded bg-[var(--color-surface-100)] text-[var(--color-surface-900)] border border-[var(--color-surface-200)]">
                                                    {{ $slot->time_range }}
                                                </span>

                                                <span class="text-xs font-semibold text-[oklch(0.50_0.01_265)]">
                                                    {{ $slot->hours_count }} JP
                                                </span>

                                                <span class="px-2 py-0.2 rounded-full text-[10px] font-bold uppercase tracking-wider
                                                    {{ $slot->category === 'kejuruan' ? 'bg-emerald-100 text-emerald-800' : 'bg-blue-100 text-blue-800' }}">
                                                    {{ $slot->category === 'kejuruan' ? 'Kejuruan' : 'Umum' }}
                                                </span>

                                                @if($isSlotActive)
                                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-600 text-white animate-pulse">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                                        Aktif Sekarang
                                                    </span>
                                                @endif
                                            </div>

                                            <h3 class="text-sm sm:text-base font-bold text-[var(--color-surface-950)] leading-snug">
                                                {{ $slot->subject_name }}
                                            </h3>

                                            <div class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-[oklch(0.50_0.01_265)] mt-1">
                                                @if($slot->teacher_name)
                                                    <span class="flex items-center gap-1">
                                                        <span class="font-medium text-[var(--color-surface-800)]">Guru:</span> {{ $slot->teacher_name }}
                                                    </span>
                                                @endif

                                                @if($slot->room)
                                                    <span>•</span>
                                                    <span class="flex items-center gap-1">
                                                        <span class="font-medium text-[var(--color-surface-800)]">Ruang:</span>
                                                        <span class="font-semibold text-[var(--color-surface-900)]">{{ $slot->room }}</span>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Right: Quick Action Buttons --}}
                                    <div class="flex items-center gap-2 shrink-0 pt-2 sm:pt-0 border-t sm:border-t-0 border-[var(--color-surface-100)]">
                                        @if($slot->subject)
                                            <a href="{{ route('kurikulum.mapel.show', [$gradeLevel->slug, $slot->subject->slug]) }}"
                                               class="p-2 sm:px-3 sm:py-1.5 rounded-lg border border-[var(--color-surface-200)] hover:bg-[var(--color-surface-100)] text-[var(--color-surface-800)] text-xs font-semibold transition-colors flex items-center gap-1.5 cursor-pointer"
                                               title="Buka Dokumen Modul">
                                                <svg class="w-4 h-4 text-[var(--color-brand-600)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                                </svg>
                                                <span class="hidden sm:inline">Modul</span>
                                            </a>

                                            <a href="{{ route('ai.index', ['mapel' => $slot->subject->slug]) }}"
                                               class="p-2 sm:px-3 sm:py-1.5 rounded-lg bg-[var(--color-brand-50)] hover:bg-[var(--color-brand-100)] text-[var(--color-brand-700)] border border-[var(--color-brand-200)] text-xs font-semibold transition-colors flex items-center gap-1.5 cursor-pointer"
                                               title="Konsultasi AI Guru">
                                                <svg class="w-4 h-4 text-[var(--color-brand-600)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
                                                </svg>
                                                <span class="hidden sm:inline">Tanya AI</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>

    {{-- ─── VIEW 2: 5-DAY WEEKLY GRID OVERVIEW (Senin - Jumat) ─── --}}
    <div id="weekly-grid-view" class="hidden">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3.5">
            @foreach($days as $dayNum => $dayData)
                @php
                    $daySlots = $groupedSchedules->get($dayNum, collect());
                    $isDayActive = ($activeDay == $dayNum);
                @endphp
                <div class="card p-3.5 border-[var(--color-surface-200)] flex flex-col justify-between {{ $isDayActive ? 'ring-2 ring-[var(--color-brand-400)] bg-[var(--color-brand-50)]/20' : 'bg-white' }}">
                    <div>
                        <div class="flex items-center justify-between pb-2 mb-3 border-b border-[var(--color-surface-200)]">
                            <div>
                                <h4 class="text-sm font-extrabold text-[var(--color-surface-950)]">{{ $dayData['name'] }}</h4>
                                <span class="text-[10px] text-[oklch(0.50_0.01_265)]">
                                    {{ $daySlots->where('activity_type', 'lesson')->sum('hours_count') }} JP Pelajaran
                                </span>
                            </div>
                            @if($currentDayOfWeek == $dayNum)
                                <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">Hari Ini</span>
                            @endif
                        </div>

                        <div class="space-y-2">
                            @foreach($daySlots as $slot)
                                @php
                                    $isSlotActive = ($activeSlot && $activeSlot->id === $slot->id);
                                @endphp
                                @if($slot->isBreak())
                                    <div class="p-1.5 rounded-lg bg-[var(--color-surface-100)] text-[10px] text-center font-medium text-[oklch(0.50_0.01_265)]">
                                        ☕ {{ $slot->subject_name }} ({{ $slot->start_time }})
                                    </div>
                                @else
                                    <div class="p-2.5 rounded-xl border text-xs transition-all {{ $isSlotActive ? 'border-emerald-500 bg-emerald-50 text-emerald-950 font-semibold shadow-2xs' : 'border-[var(--color-surface-200)] bg-white hover:border-[var(--color-brand-300)]' }}">
                                        <div class="flex items-center justify-between text-[10px] text-[oklch(0.50_0.01_265)] mb-1">
                                            <span class="font-mono font-bold">{{ $slot->time_range }}</span>
                                            <span class="px-1 rounded {{ $slot->category === 'kejuruan' ? 'bg-emerald-100 text-emerald-700' : 'bg-blue-100 text-blue-700' }}">
                                                {{ $slot->hours_count }} JP
                                            </span>
                                        </div>
                                        <p class="font-bold text-[var(--color-surface-950)] leading-tight truncate">
                                            {{ $slot->subject_name }}
                                        </p>
                                        <p class="text-[10px] text-[oklch(0.50_0.01_265)] truncate mt-1">
                                            {{ $slot->room ?? 'Ruang Kelas' }}
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <button type="button"
                            onclick="selectDayTab({{ $dayNum }}); toggleWeeklyGridView();"
                            class="btn-ghost text-[11px] py-1 px-2 justify-center mt-3 border-dashed">
                        Buka Detail {{ $dayData['name'] }} →
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    @push('scripts')
    <script>
        // ─── Dropdown Toggle ───
        function toggleSimDropdown() {
            const menu = document.getElementById('sim-dropdown-menu');
            if (menu) menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(e) {
            const btn = e.target.closest('button[onclick="toggleSimDropdown()"]');
            const menu = document.getElementById('sim-dropdown-menu');
            if (!btn && menu && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });

        // ─── Day Tab Switcher ───
        function selectDayTab(dayNum) {
            // Update Tab Buttons
            for (let i = 1; i <= 5; i++) {
                const btn = document.getElementById('day-tab-btn-' + i);
                const container = document.getElementById('day-container-' + i);

                if (i === dayNum) {
                    btn?.classList.add('bg-[var(--color-brand-600)]', 'text-white', 'border-[var(--color-brand-600)]', 'shadow-xs');
                    btn?.classList.remove('bg-white', 'text-[var(--color-surface-700)]', 'border-[var(--color-surface-200)]');
                    container?.classList.remove('hidden');
                } else {
                    btn?.classList.remove('bg-[var(--color-brand-600)]', 'text-white', 'border-[var(--color-brand-600)]', 'shadow-xs');
                    btn?.classList.add('bg-white', 'text-[var(--color-surface-700)]', 'border-[var(--color-surface-200)]');
                    container?.classList.add('hidden');
                }
            }

            // Ensure single-day view is visible
            document.getElementById('single-day-view')?.classList.remove('hidden');
            document.getElementById('weekly-grid-view')?.classList.add('hidden');
            document.getElementById('grid-btn-label').innerText = 'Tampilan 5 Hari';
        }

        // ─── Toggle Weekly Grid View ───
        function toggleWeeklyGridView() {
            const singleView = document.getElementById('single-day-view');
            const gridView = document.getElementById('weekly-grid-view');
            const label = document.getElementById('grid-btn-label');

            if (gridView?.classList.contains('hidden')) {
                gridView.classList.remove('hidden');
                singleView?.classList.add('hidden');
                if (label) label.innerText = 'Tampilan Harian';
            } else {
                gridView?.classList.add('hidden');
                singleView?.classList.remove('hidden');
                if (label) label.innerText = 'Tampilan 5 Hari';
            }
        }

        // ─── Live Clock Ticking (Local Client Sync) ───
        const isSimulated = @json($isSimulated);
        if (!isSimulated) {
            setInterval(() => {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const clockEl = document.getElementById('live-clock');
                if (clockEl) {
                    clockEl.innerText = `${hours}:${minutes}:${seconds} WIB`;
                }
            }, 1000);
        }
    </script>
    @endpush
</x-layouts.app>
