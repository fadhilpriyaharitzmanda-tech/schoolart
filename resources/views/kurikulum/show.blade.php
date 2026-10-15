<x-layouts.app
    title="Kurikulum {{ $gradeLevel->name }} SMK ({{ $gradeLevel->phase }})"
    description="Daftar mata pelajaran {{ $gradeLevel->name }} SMK: materi terstruktur, modul ajar, dan pendampingan AI Tutor.">

    {{-- ─── Navigation & Header ─── --}}
    <div class="mb-6 pt-2">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-[oklch(0.55_0.01_265)] mb-3">
            <a href="{{ route('dashboard') }}" class="hover:text-[var(--color-surface-950)] transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <a href="{{ route('kurikulum.index') }}" class="hover:text-[var(--color-surface-950)] transition-colors">Kurikulum SMK</a>
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <span class="text-[var(--color-surface-950)] font-semibold">{{ $gradeLevel->name }}</span>
        </nav>

        {{-- Main Title & Segmented Grade Tabs --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-[var(--color-surface-200)]">
            <div>
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold mb-1.5 {{ $gradeLevel->level_number === 10 ? 'bg-blue-50 text-blue-700' : ($gradeLevel->level_number === 11 ? 'bg-indigo-50 text-indigo-700' : 'bg-purple-50 text-purple-700') }}">
                    <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                    {{ $gradeLevel->phase }} · {{ $gradeLevel->badge_text }}
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--color-surface-950)] tracking-tight">
                    Mata Pelajaran {{ $gradeLevel->name }}
                </h1>
                <p class="text-xs sm:text-sm text-[oklch(0.50_0.01_265)] mt-1">
                    {{ $gradeLevel->description }}
                </p>
            </div>

            {{-- Grade Quick Switcher --}}
            <div class="segmented-control shrink-0 self-start sm:self-auto">
                @foreach($allGrades as $grade)
                    <a href="{{ route('kurikulum.show', $grade->slug) }}"
                       class="segmented-pill {{ $grade->id === $gradeLevel->id ? 'active' : '' }}">
                        {{ $grade->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ─── Interactive Filter Pills ─── --}}
    <div class="flex items-center justify-between gap-3 mb-6">
        <div class="flex items-center gap-1.5 bg-[var(--color-surface-100)] p-1 rounded-[var(--radius-lg)] border border-[var(--color-surface-200)]">
            <button type="button" onclick="filterGradeCategory('all')" id="btn-cat-all" class="px-3 py-1.5 text-xs font-bold rounded-md bg-white text-[var(--color-surface-950)] shadow-2xs transition-all cursor-pointer">
                Semua Mapel ({{ $stats['total'] }})
            </button>
            <button type="button" onclick="filterGradeCategory('kejuruan')" id="btn-cat-kejuruan" class="px-3 py-1.5 text-xs font-semibold rounded-md text-[oklch(0.50_0.01_265)] hover:text-[var(--color-surface-950)] transition-all cursor-pointer">
                Kejuruan ({{ $stats['vocational'] }})
            </button>
            <button type="button" onclick="filterGradeCategory('umum')" id="btn-cat-umum" class="px-3 py-1.5 text-xs font-semibold rounded-md text-[oklch(0.50_0.01_265)] hover:text-[var(--color-surface-950)] transition-all cursor-pointer">
                Muatan Umum ({{ $stats['general'] }})
            </button>
        </div>

        <span class="text-xs text-[oklch(0.55_0.01_265)] hidden sm:inline">
            {{ $stats['total_topics'] }} Bab Materi · {{ $stats['total_documents'] }} File Modul
        </span>
    </div>

    {{-- ─── Clean Interactive Cards Grid ─── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-12" id="grade-subjects-grid">
        @foreach($gradeLevel->subjects as $subject)
            <a href="{{ route('kurikulum.mapel.show', [$gradeLevel->slug, $subject->slug]) }}"
               data-cat="{{ $subject->category }}"
               class="grade-subject-card card-interactive p-5 flex flex-col justify-between group cursor-pointer text-left">

                <div>
                    {{-- Code & Category Row --}}
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <div class="flex items-center gap-2">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 shadow-2xs {{ $subject->category === 'kejuruan' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200/60' : 'bg-blue-50 text-blue-600 border border-blue-200/60' }}">
                                @if($subject->icon === 'code')
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                                    </svg>
                                @elseif($subject->icon === 'database')
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 5.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                    </svg>
                                @elseif($subject->icon === 'network' || $subject->icon === 'server')
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 14.25h13.5m-13.5 0a3 3 0 0 1-3-3m3 3a3 3 0 1 0 0 6h13.5a3 3 0 1 0 0-6m-16.5-3a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3m-19.5 0a4.5 4.5 0 0 1 .9-2.7L5.75 5.1a3 3 0 0 1 2.4-1.1h7.7a3 3 0 0 1 2.4 1.1l2.1 3.45a4.5 4.5 0 0 1 .9 2.7" />
                                    </svg>
                                @else
                                    <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                @endif
                            </div>
                            <span class="font-mono text-xs font-bold text-[var(--color-surface-800)]">{{ $subject->code }}</span>
                        </div>

                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $subject->category === 'kejuruan' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-blue-700' }}">
                            {{ $subject->category === 'kejuruan' ? 'Kejuruan' : 'Umum' }}
                        </span>
                    </div>

                    <h3 class="text-base font-bold text-[var(--color-surface-950)] group-hover:text-[var(--color-brand-600)] transition-colors leading-snug">
                        {{ $subject->name }}
                    </h3>

                    @if($subject->vocational_stream)
                        <p class="text-[11px] font-medium text-[var(--color-brand-600)] mt-0.5 truncate">
                            {{ $subject->vocational_stream }}
                        </p>
                    @endif

                    {{-- Topic / Materi Preview (Clean & Scannable) --}}
                    @if($subject->topics->isNotEmpty())
                        <div class="mt-3.5 p-2.5 rounded-lg bg-[var(--color-surface-50)] border border-[var(--color-surface-200)]/70">
                            <p class="text-[10px] font-bold uppercase tracking-wider text-[oklch(0.50_0.01_265)] mb-1">
                                Topik Pembahasan:
                            </p>
                            <ul class="space-y-1">
                                @foreach($subject->topics->take(2) as $top)
                                    <li class="flex items-start gap-1.5 text-xs text-[var(--color-surface-900)] leading-snug">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-500)] mt-1.5 shrink-0"></span>
                                        <span class="truncate font-medium">{{ $top->title }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                <div class="mt-4 pt-3 border-t border-[var(--color-surface-100)] flex items-center justify-between text-xs text-[oklch(0.55_0.01_265)]">
                    <div class="flex items-center gap-2 text-[11px]">
                        <span>{{ $subject->topics_count }} Bab</span>
                        <span>•</span>
                        <span>{{ $subject->documents_count }} File</span>
                    </div>

                    <div class="flex items-center gap-1 font-semibold text-[var(--color-brand-600)] group-hover:translate-x-0.5 transition-transform text-xs">
                        <span>Buka Mapel</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    @push('scripts')
    <script>
        function filterGradeCategory(cat) {
            const cards = document.querySelectorAll('.grade-subject-card');
            const btns = {
                all: document.getElementById('btn-cat-all'),
                kejuruan: document.getElementById('btn-cat-kejuruan'),
                umum: document.getElementById('btn-cat-umum')
            };

            Object.keys(btns).forEach(key => {
                if (key === cat) {
                    btns[key].className = 'px-3 py-1.5 text-xs font-bold rounded-md bg-white text-[var(--color-surface-950)] shadow-2xs transition-all cursor-pointer';
                } else {
                    btns[key].className = 'px-3 py-1.5 text-xs font-semibold rounded-md text-[oklch(0.50_0.01_265)] hover:text-[var(--color-surface-950)] transition-all cursor-pointer';
                }
            });

            cards.forEach(card => {
                if (cat === 'all' || card.getAttribute('data-cat') === cat) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }
    </script>
    @endpush

</x-layouts.app>
