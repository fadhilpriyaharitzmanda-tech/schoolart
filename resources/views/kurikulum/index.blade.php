<x-layouts.app
    title="Materi Belajar & Kurikulum SMK"
    description="Direktori lengkap mata pelajaran umum dan kejuruan SMK Kurikulum Merdeka untuk Kelas 10, 11, dan 12. Dilengkapi modul ajar dan AI Tutor.">

    {{-- ─── Breadcrumb & Page Header ─── --}}
    <div class="mb-6">
        <nav class="flex items-center gap-2 text-xs text-[oklch(0.55_0.01_265)] mb-3">
            <a href="{{ route('dashboard') }}" class="hover:text-[var(--color-surface-950)] transition-colors">Beranda</a>
            <svg class="w-3.5 h-3.5 text-[oklch(0.70_0.01_265)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
            <span class="text-[var(--color-surface-950)] font-semibold">Materi Belajar SMK</span>
        </nav>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[var(--color-brand-50)] text-[var(--color-brand-700)] text-xs font-bold mb-2 border border-[var(--color-brand-200)]/60">
                    <span class="w-2 h-2 rounded-full bg-[var(--color-brand-600)] animate-pulse"></span>
                    Kurikulum Merdeka SMK
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--color-surface-950)] tracking-tight">
                    Materi Belajar & Bank Modul SMK
                </h1>
                <p class="text-xs sm:text-sm text-[oklch(0.48_0.01_265)] mt-1 max-w-2xl">
                    Pilih tingkat kelas atau cari topik materi kejuruan untuk mulai belajar bersama rangkuman terstruktur dan AI Tutor.
                </p>
            </div>

            <div class="flex items-center gap-2 self-start md:self-auto">
                <span class="px-3 py-1.5 rounded-lg bg-[var(--color-surface-100)] border border-[var(--color-surface-200)] text-xs font-semibold text-[var(--color-surface-800)]">
                    Total {{ $stats['total_subjects'] }} Mapel
                </span>
                <span class="px-3 py-1.5 rounded-lg bg-emerald-50 border border-emerald-200 text-xs font-semibold text-emerald-700">
                    {{ $stats['total_vocational'] }} Kejuruan
                </span>
            </div>
        </div>
    </div>

    {{-- ─── Clean Integrated Search & Filter Toolbar (Not Floating, Perfectly Aligned) ─── --}}
    <div class="card p-4 sm:p-5 mb-8 border border-[var(--color-surface-200)] bg-white shadow-2xs">
        <div class="flex flex-col gap-4">
            {{-- Top Row: Live Search Input with Quick Actions --}}
            <div class="relative">
                <svg class="w-4.5 h-4.5 text-[oklch(0.55_0.01_265)] absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input
                    type="text"
                    id="live-search-input"
                    oninput="handleSearch(this.value)"
                    placeholder="Cari mata pelajaran atau materi (contoh: PBO, Basis Data, Jaringan, Algoritma, UI/UX)..."
                    class="w-full pl-10 pr-4 py-2.5 text-xs sm:text-sm rounded-[var(--radius-lg)] border border-[var(--color-surface-200)] bg-[var(--color-surface-50)] text-[var(--color-surface-950)] focus:bg-white focus:outline-hidden focus:border-[var(--color-brand-500)] focus:ring-2 focus:ring-[var(--color-brand-100)] transition-all placeholder:text-[oklch(0.60_0.01_265)]"
                >
            </div>

            {{-- Bottom Row: Segmented Filters (Grade Level & Category) --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-3 border-t border-[var(--color-surface-100)]">
                {{-- Grade Pills --}}
                <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0 scrollbar-none" id="grade-segmented-control">
                    <button type="button" onclick="filterByGrade('all')" data-grade="all"
                            class="grade-filter-btn px-3 py-1.5 text-xs font-bold rounded-[var(--radius-md)] bg-[var(--color-brand-600)] text-white shadow-2xs transition-all cursor-pointer">
                        Semua Kelas
                    </button>
                    @foreach($gradeLevels as $gl)
                        <button type="button" onclick="filterByGrade('{{ $gl->slug }}')" data-grade="{{ $gl->slug }}"
                                class="grade-filter-btn px-3 py-1.5 text-xs font-semibold rounded-[var(--radius-md)] bg-[var(--color-surface-100)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-200)] transition-all cursor-pointer whitespace-nowrap">
                            {{ $gl->name }} <span class="opacity-70 text-[10px]">({{ $gl->phase }})</span>
                        </button>
                    @endforeach
                </div>

                {{-- Category Filter --}}
                <div class="flex items-center gap-1.5 shrink-0 self-start sm:self-auto">
                    <span class="text-xs text-[oklch(0.55_0.01_265)] mr-1 hidden lg:inline">Kategori:</span>
                    <button type="button" onclick="filterByCategory('all')" data-cat="all"
                            class="cat-filter-btn px-2.5 py-1 text-xs font-bold rounded-md bg-[var(--color-surface-950)] text-white transition-all cursor-pointer">
                        Semua
                    </button>
                    <button type="button" onclick="filterByCategory('kejuruan')" data-cat="kejuruan"
                            class="cat-filter-btn px-2.5 py-1 text-xs font-semibold rounded-md bg-[var(--color-surface-100)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-200)] transition-all cursor-pointer">
                        Kejuruan 💻
                    </button>
                    <button type="button" onclick="filterByCategory('umum')" data-cat="umum"
                            class="cat-filter-btn px-2.5 py-1 text-xs font-semibold rounded-md bg-[var(--color-surface-100)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-200)] transition-all cursor-pointer">
                        Umum 📚
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ─── Clear & Informative Subject Cards Grid ─── --}}
    <div id="subject-cards-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-12">
        @foreach($allSubjects as $subject)
            <div data-grade="{{ $subject->gradeLevel->slug }}"
                 data-category="{{ $subject->category }}"
                 data-search="{{ strtolower($subject->name . ' ' . $subject->code . ' ' . $subject->vocational_stream . ' ' . $subject->description . ' ' . $subject->topics->pluck('title')->join(' ')) }}"
                 class="subject-card card p-5 flex flex-col justify-between hover:shadow-panel hover:border-[var(--color-brand-300)] transition-all duration-200 group">

                <div>
                    {{-- Header Row: Code & Category Tag --}}
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <div class="flex items-center gap-2">
                            <span class="font-mono text-xs font-bold px-2 py-0.5 rounded-md bg-[var(--color-surface-100)] text-[var(--color-surface-900)] border border-[var(--color-surface-200)]">
                                {{ $subject->code }}
                            </span>
                            <span class="text-xs font-semibold text-[oklch(0.50_0.01_265)]">
                                {{ $subject->gradeLevel->name }} · {{ $subject->gradeLevel->phase }}
                            </span>
                        </div>

                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $subject->category === 'kejuruan' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                            {{ $subject->category === 'kejuruan' ? 'Kejuruan' : 'Umum' }}
                        </span>
                    </div>

                    {{-- Subject Title --}}
                    <h2 class="text-base sm:text-lg font-bold text-[var(--color-surface-950)] leading-snug group-hover:text-[var(--color-brand-600)] transition-colors">
                        <a href="{{ route('kurikulum.mapel.show', [$subject->gradeLevel->slug, $subject->slug]) }}">
                            {{ $subject->name }}
                        </a>
                    </h2>

                    @if($subject->vocational_stream)
                        <p class="text-xs font-semibold text-[var(--color-brand-600)] mt-1">
                            {{ $subject->vocational_stream }}
                        </p>
                    @endif

                    {{-- ─── Clear Topics / Materi List (Simple & Punchy) ─── --}}
                    @if($subject->topics->isNotEmpty())
                        <div class="mt-4 p-3 rounded-[var(--radius-lg)] bg-[var(--color-surface-50)] border border-[var(--color-surface-200)]/80">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[oklch(0.50_0.01_265)]">
                                    Topik Bahasan:
                                </span>
                                <span class="text-[10px] font-semibold text-[var(--color-brand-600)]">
                                    {{ $subject->topics_count }} Bab
                                </span>
                            </div>
                            <ul class="space-y-1.5">
                                @foreach($subject->topics->take(2) as $top)
                                    <li class="flex items-start gap-2 text-xs text-[var(--color-surface-900)] leading-snug">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-500)] mt-1.5 shrink-0"></span>
                                        <span class="truncate font-medium">{{ $top->title }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

                {{-- Action Row --}}
                <div class="mt-5 pt-3.5 border-t border-[var(--color-surface-100)] flex items-center justify-between">
                    <div class="flex items-center gap-3 text-xs text-[oklch(0.55_0.01_265)]">
                        <span>{{ $subject->documents_count }} Modul</span>
                        <span>•</span>
                        <span>{{ $subject->total_hours }} JP</span>
                    </div>

                    <a href="{{ route('kurikulum.mapel.show', [$subject->gradeLevel->slug, $subject->slug]) }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-[var(--radius-md)] bg-[var(--color-surface-100)] group-hover:bg-[var(--color-brand-600)] text-[var(--color-surface-900)] group-hover:text-white text-xs font-semibold transition-all">
                        <span>Pelajari</span>
                        <svg class="w-3.5 h-3.5 transform group-hover:translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>

            </div>
        @endforeach
    </div>

    {{-- Empty Search Results State --}}
    <div id="empty-search-state" class="hidden card p-10 text-center mb-12">
        <div class="w-12 h-12 rounded-full bg-[var(--color-surface-100)] text-[oklch(0.55_0.01_265)] flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </div>
        <h3 class="text-base font-bold text-[var(--color-surface-950)]">Tidak ada mata pelajaran yang cocok</h3>
        <p class="text-xs text-[oklch(0.55_0.01_265)] mt-1">Coba gunakan kata kunci pencarian yang lain atau reset filter.</p>
        <button type="button" onclick="resetAllFilters()" class="btn-brand text-xs mt-4">Reset Filter</button>
    </div>

    @push('scripts')
    <script>
        let currentGrade = 'all';
        let currentCategory = 'all';
        let searchQuery = '';

        function filterByGrade(grade) {
            currentGrade = grade;
            document.querySelectorAll('.grade-filter-btn').forEach(btn => {
                if (btn.getAttribute('data-grade') === grade) {
                    btn.className = 'grade-filter-btn px-3 py-1.5 text-xs font-bold rounded-[var(--radius-md)] bg-[var(--color-brand-600)] text-white shadow-2xs transition-all cursor-pointer whitespace-nowrap';
                } else {
                    btn.className = 'grade-filter-btn px-3 py-1.5 text-xs font-semibold rounded-[var(--radius-md)] bg-[var(--color-surface-100)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-200)] transition-all cursor-pointer whitespace-nowrap';
                }
            });
            applyFilters();
        }

        function filterByCategory(cat) {
            currentCategory = cat;
            document.querySelectorAll('.cat-filter-btn').forEach(btn => {
                if (btn.getAttribute('data-cat') === cat) {
                    btn.className = 'cat-filter-btn px-2.5 py-1 text-xs font-bold rounded-md bg-[var(--color-surface-950)] text-white transition-all cursor-pointer';
                } else {
                    btn.className = 'cat-filter-btn px-2.5 py-1 text-xs font-semibold rounded-md bg-[var(--color-surface-100)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-200)] transition-all cursor-pointer';
                }
            });
            applyFilters();
        }

        function handleSearch(val) {
            searchQuery = val.trim().toLowerCase();
            applyFilters();
        }

        function applyFilters() {
            const cards = document.querySelectorAll('.subject-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const gradeMatch = (currentGrade === 'all' || card.getAttribute('data-grade') === currentGrade);
                const catMatch = (currentCategory === 'all' || card.getAttribute('data-category') === currentCategory);
                const searchMatch = (!searchQuery || card.getAttribute('data-search').includes(searchQuery));

                if (gradeMatch && catMatch && searchMatch) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('empty-search-state');
            if (emptyState) {
                emptyState.style.display = (visibleCount === 0) ? 'block' : 'none';
            }
        }

        function resetAllFilters() {
            document.getElementById('live-search-input').value = '';
            searchQuery = '';
            filterByGrade('all');
            filterByCategory('all');
        }
    </script>
    @endpush

</x-layouts.app>
