<x-layouts.app title="Dashboard Belajar SMK" :full-width="true">

{{-- ─── DASHBOARD SISWA SMK SCHOLART (Full Width & Compact UI) ─── --}}
<div class="w-full space-y-4 pb-4">

    {{-- ══════════════════════════════════════════════
         SECTION 1: Clean & Compact Top Bar
    ══════════════════════════════════════════════ --}}
    <section class="card p-4 sm:p-5 border-[var(--color-surface-200)] shadow-2xs bg-gradient-to-r from-white via-white to-[var(--color-brand-50)]/30">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
            <div>
                <div class="flex items-center gap-2 mb-1 flex-wrap">
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold bg-[var(--color-brand-50)] text-[var(--color-brand-700)] border border-[var(--color-brand-200)]/80">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-600)] animate-pulse"></span>
                        SMK Nusantara · PPLG
                    </span>
                    <span class="text-xs text-[oklch(0.50_0.01_265)]" id="today-date">Kamis, 25 September 2026</span>
                </div>

                <h1 class="text-xl sm:text-2xl font-extrabold text-[var(--color-surface-950)] tracking-tight">
                    Dashboard Belajar SMK
                </h1>
            </div>

            {{-- Compact Quick Badges & Actions --}}
            <div class="flex items-center gap-2 shrink-0 self-start md:self-center flex-wrap">
                <div class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-[var(--radius-lg)] bg-amber-50 border border-amber-200 text-amber-800 text-xs font-bold shadow-2xs">
                    <span>🔥</span>
                    <span>3 Hari Streak</span>
                </div>

                <div class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-[var(--radius-lg)] bg-violet-50 border border-violet-200 text-violet-800 text-xs font-bold shadow-2xs">
                    <span>⚡</span>
                    <span>1,240 XP</span>
                </div>

                <a href="{{ route('jadwal.index') }}"
                   class="btn-ghost py-1.5 px-3 text-xs font-semibold bg-white shadow-2xs">
                    <span>📅 Jadwal</span>
                </a>

                <a href="{{ route('kurikulum.index') }}"
                   class="btn-brand py-1.5 px-3 text-xs font-semibold shadow-2xs">
                    <span>Semua Materi</span>
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════
         MAIN 2-COLUMN FULL-WIDTH GRID (Left: Mapel & Modul, Right: AI & Quiz)
    ══════════════════════════════════════════════ --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">

        {{-- ─── LEFT COLUMN (8 Columns on lg) ─── --}}
        <div class="lg:col-span-8 space-y-4">

            {{-- ══════════════════════════════════════════════
                 BOX 1: Target Belajar SMK (Mata Pelajaran Kejuruan Aktif)
            ══════════════════════════════════════════════ --}}
            <section class="card p-4 sm:p-5 border-[var(--color-surface-200)] shadow-2xs">
                <div class="flex items-center justify-between gap-3 mb-3 pb-2.5 border-b border-[var(--color-surface-100)]">
                    <div>
                        <h2 class="text-sm sm:text-base font-bold text-[var(--color-surface-950)] leading-tight">
                            Target Belajar SMK
                        </h2>
                        <p class="text-xs text-[oklch(0.50_0.01_265)]">Mata pelajaran kejuruan aktif</p>
                    </div>
                    <a href="{{ route('kurikulum.show', 'kelas-11') }}" class="btn-ghost py-1 px-2.5 text-xs font-semibold text-[var(--color-brand-600)]">
                        Semua Mapel
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>

                {{-- Compact Subject Cards --}}
                <div class="space-y-3">
                    @foreach($activeSubjects as $sub)
                        <div class="p-3 sm:p-3.5 rounded-xl border border-[var(--color-surface-200)] hover:border-[var(--color-brand-300)] hover:shadow-xs transition-all duration-150 group flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
                            <div class="flex items-center gap-3 flex-1 min-w-0">
                                {{-- Subject Real Photo Thumbnail (Compact & Sleek) --}}
                                <div class="w-20 h-16 sm:w-24 sm:h-18 rounded-lg overflow-hidden shrink-0 border border-[var(--color-surface-200)] relative bg-[var(--color-surface-100)]">
                                    <img
                                        src="{{ asset($sub->image) }}"
                                        alt="{{ $sub->short_name ?? $sub->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                                        loading="lazy"
                                    >
                                    <span class="absolute bottom-1 left-1 px-1.5 py-0.2 rounded text-[9px] font-mono font-bold bg-black/75 text-white backdrop-blur-xs">
                                        {{ $sub->code }}
                                    </span>
                                </div>

                                {{-- Concise Details --}}
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-1.5 mb-0.5 flex-wrap">
                                        <span class="px-1.5 py-0.2 rounded text-[10px] font-bold uppercase tracking-wider bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            Kejuruan
                                        </span>
                                        <span class="badge {{ $sub->schedule_status === 'Sedang Belajar' || $sub->schedule_status === 'Sedang Dipelajari' ? 'badge-success' : 'badge-gray' }} text-[10px] py-0">
                                            {{ $sub->schedule_status }}
                                        </span>
                                        <span class="text-[11px] text-[oklch(0.50_0.01_265)]">
                                            {{ $sub->schedule_time }}
                                        </span>
                                    </div>

                                    <h3 class="text-sm font-bold text-[var(--color-surface-950)] group-hover:text-[var(--color-brand-600)] transition-colors truncate">
                                        <a href="{{ route('kurikulum.mapel.show', [$sub->gradeLevel->slug ?? 'kelas-11', $sub->slug]) }}">
                                            {{ $sub->short_name ?? $sub->name }}
                                        </a>
                                    </h3>

                                    <div class="flex items-center gap-2 text-xs text-[oklch(0.50_0.01_265)] mt-0.5">
                                        <span class="font-medium text-[var(--color-brand-600)] truncate">
                                            📌 {{ $sub->short_topic ?? 'Materi Pokok' }}
                                        </span>
                                        <span>•</span>
                                        <span class="truncate">{{ $sub->teacher_name }}</span>
                                    </div>

                                    {{-- Compact Progress Bar --}}
                                    <div class="flex items-center gap-2 mt-1.5 max-w-sm">
                                        <div class="progress-bar flex-1 h-1.5">
                                            <div class="progress-fill" style="width: {{ $sub->student_progress }}%"></div>
                                        </div>
                                        <span class="text-xs font-bold text-[var(--color-surface-900)]">{{ $sub->student_progress }}%</span>
                                    </div>
                                </div>
                            </div>

                            {{-- Action Button --}}
                            <div class="shrink-0 self-end sm:self-center">
                                <a href="{{ route('kurikulum.mapel.show', [$sub->gradeLevel->slug ?? 'kelas-11', $sub->slug]) }}"
                                   class="btn-brand py-1.5 px-3 text-xs font-semibold whitespace-nowrap shadow-2xs">
                                    <span>Belajar</span>
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- ══════════════════════════════════════════════
                 BOX 2: Modul & Dokumen Rekomendasi
            ══════════════════════════════════════════════ --}}
            <section class="card p-4 sm:p-5 border-[var(--color-surface-200)] shadow-2xs">
                <div class="flex items-center justify-between gap-3 mb-3 pb-2.5 border-b border-[var(--color-surface-100)]">
                    <div>
                        <h2 class="text-sm sm:text-base font-bold text-[var(--color-surface-950)] leading-tight">
                            Modul & Dokumen Rekomendasi
                        </h2>
                        <p class="text-xs text-[oklch(0.50_0.01_265)]">Bahan ajar siap unduh</p>
                    </div>
                    <a href="{{ route('kurikulum.index') }}" class="btn-ghost py-1 px-2.5 text-xs font-semibold text-[var(--color-brand-600)]">
                        Semua Modul
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @foreach($featuredDocuments as $doc)
                        <div class="p-3 rounded-xl border border-[var(--color-surface-200)] hover:border-[var(--color-brand-300)] transition-all flex flex-col justify-between group bg-white">
                            <div>
                                <div class="flex items-center justify-between gap-1 mb-1.5">
                                    <span class="px-1.5 py-0.2 rounded text-[9px] font-bold font-mono {{ $doc->file_format === 'PDF' ? 'bg-rose-50 text-rose-700 border border-rose-200' : 'bg-blue-50 text-blue-700 border border-blue-200' }}">
                                        {{ $doc->file_format }}
                                    </span>
                                    <span class="text-[10px] text-[oklch(0.50_0.01_265)] font-mono">{{ $doc->file_size }}</span>
                                </div>

                                <h3 class="text-xs font-bold text-[var(--color-surface-950)] leading-snug group-hover:text-[var(--color-brand-600)] transition-colors line-clamp-2">
                                    {{ $doc->title }}
                                </h3>

                                <p class="text-[10px] text-[var(--color-brand-600)] font-medium mt-1 truncate">
                                    {{ $doc->subject->name ?? 'Materi SMK' }}
                                </p>
                            </div>

                            <div class="mt-3 pt-2 border-t border-[var(--color-surface-100)] flex items-center justify-between">
                                <span class="text-[10px] text-[oklch(0.50_0.01_265)]">{{ $doc->download_count }}x unduh</span>

                                <button type="button" onclick="triggerDashboardDownload('{{ $doc->title }}')"
                                        class="inline-flex items-center gap-1 text-xs font-bold text-[var(--color-brand-600)] hover:text-[var(--color-brand-700)] cursor-pointer">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                    </svg>
                                    <span>Unduh</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- ══════════════════════════════════════════════
                 BOX 3: Quick Grade Explorer
            ══════════════════════════════════════════════ --}}
            <section class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                @foreach($grades as $grade)
                    <a href="{{ route('kurikulum.show', $grade->slug) }}"
                       class="card p-3 hover:border-[var(--color-brand-300)] transition-all group flex items-center justify-between">
                        <div>
                            <span class="text-[9px] font-bold uppercase tracking-wider text-[var(--color-brand-600)]">{{ $grade->phase }}</span>
                            <h3 class="text-xs sm:text-sm font-bold text-[var(--color-surface-950)] group-hover:text-[var(--color-brand-600)] transition-colors">
                                {{ $grade->name }}
                            </h3>
                            <p class="text-[11px] text-[oklch(0.50_0.01_265)] mt-0.5">{{ $grade->subjects_count }} Mapel</p>
                        </div>

                        <div class="w-7 h-7 rounded-full bg-[var(--color-surface-100)] group-hover:bg-[var(--color-brand-600)] group-hover:text-white text-[var(--color-surface-600)] flex items-center justify-center transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </section>

        </div>

        {{-- ─── RIGHT COLUMN (4 Columns on lg) ─── --}}
        <div class="lg:col-span-4 space-y-4">

            {{-- ══════════════════════════════════════════════
                 BOX 4: AI Tutor Belajar SMK (Compact Console)
            ══════════════════════════════════════════════ --}}
            <section class="card p-4 sm:p-4.5 bg-gradient-to-br from-white via-white to-[var(--color-brand-50)]/30 border-[var(--color-brand-200)] shadow-2xs" id="dashboard-ai-box">
                {{-- Header --}}
                <div class="flex items-center justify-between gap-2 mb-2.5 pb-2 border-b border-[var(--color-surface-100)]">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center shadow-2xs shrink-0">
                            <svg class="w-4 h-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xs sm:text-sm font-bold text-[var(--color-surface-950)] flex items-center gap-1.5">
                                AI Tutor Belajar SMK
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            </h2>
                            <p class="text-[10px] text-[oklch(0.50_0.01_265)]">Solusi konsep & bedah error kode</p>
                        </div>
                    </div>
                </div>

                {{-- Mode Switcher --}}
                <div class="flex items-center gap-1 bg-[var(--color-surface-100)] p-1 rounded-lg border border-[var(--color-surface-200)] mb-2" id="ai-mode-switcher">
                    <button type="button" onclick="setAIMode('materi', this)" class="ai-mode-btn flex-1 py-1 text-center text-[11px] font-bold rounded-md bg-white text-[var(--color-surface-950)] shadow-2xs transition-all cursor-pointer">
                        💬 Materi
                    </button>
                    <button type="button" onclick="setAIMode('error', this)" class="ai-mode-btn flex-1 py-1 text-center text-[11px] font-semibold rounded-md text-[oklch(0.50_0.01_265)] hover:text-[var(--color-surface-950)] transition-all cursor-pointer">
                        🐛 Error
                    </button>
                    <button type="button" onclick="setAIMode('code', this)" class="ai-mode-btn flex-1 py-1 text-center text-[11px] font-semibold rounded-md text-[oklch(0.50_0.01_265)] hover:text-[var(--color-surface-950)] transition-all cursor-pointer">
                        💻 Kode
                    </button>
                </div>

                {{-- Subject Pills --}}
                <div class="flex items-center gap-1 overflow-x-auto pb-1.5 mb-2 scrollbar-none" id="ai-subject-pills">
                    <button type="button" onclick="setAISubject('all', this)" class="ai-subj-pill px-2 py-0.5 text-[10px] font-bold rounded-full bg-[var(--color-brand-600)] text-white shadow-2xs transition-all cursor-pointer whitespace-nowrap">
                        🎯 Semua
                    </button>
                    <button type="button" onclick="setAISubject('pbo', this)" class="ai-subj-pill px-2 py-0.5 text-[10px] font-semibold rounded-full bg-white border border-[var(--color-surface-200)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-100)] transition-all cursor-pointer whitespace-nowrap">
                        ☕ PBO
                    </button>
                    <button type="button" onclick="setAISubject('web', this)" class="ai-subj-pill px-2 py-0.5 text-[10px] font-semibold rounded-full bg-white border border-[var(--color-surface-200)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-100)] transition-all cursor-pointer whitespace-nowrap">
                        🌐 Web
                    </button>
                    <button type="button" onclick="setAISubject('database', this)" class="ai-subj-pill px-2 py-0.5 text-[10px] font-semibold rounded-full bg-white border border-[var(--color-surface-200)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-100)] transition-all cursor-pointer whitespace-nowrap">
                        🗄️ Basis Data
                    </button>
                </div>

                {{-- Form --}}
                <form id="dash-ai-form" onsubmit="handleDashboardAISubmit(event)" class="space-y-2 mb-2.5">
                    <div class="relative">
                        <textarea
                            id="dash-ai-input"
                            rows="2"
                            placeholder="Tanya konsep atau paste error..."
                            class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-[var(--color-surface-200)] bg-white text-[var(--color-surface-950)] focus:outline-hidden focus:border-[var(--color-brand-500)] focus:ring-1 focus:ring-[var(--color-brand-200)] transition-all placeholder:text-[oklch(0.60_0.01_265)] resize-none"
                        ></textarea>
                    </div>

                    <div class="flex items-center justify-between gap-2">
                        <button type="button" onclick="clearAIInput()" id="btn-clear-input" class="text-[10px] text-[oklch(0.50_0.01_265)] hover:text-rose-600 font-medium cursor-pointer">
                            Hapus
                        </button>

                        <button type="submit" class="btn-brand py-1 px-3 text-xs font-semibold cursor-pointer shadow-xs">
                            <span>Tanya AI</span>
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </button>
                    </div>
                </form>

                {{-- Interactive Response Panel --}}
                <div id="dash-ai-response-box" class="hidden p-3 rounded-lg bg-white border border-[var(--color-brand-200)] shadow-xs text-xs text-[var(--color-surface-900)] mb-2.5 transition-all">
                    <div class="flex items-center justify-between gap-1 mb-1.5 pb-1.5 border-b border-[var(--color-surface-100)]">
                        <span class="font-bold text-[var(--color-brand-700)] flex items-center gap-1 text-[11px]">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span id="dash-ai-response-title">Jawaban AI:</span>
                        </span>
                        <div class="flex items-center gap-1.5">
                            <button type="button" onclick="copyAIAnswer()" id="btn-copy-answer" class="text-[11px] font-semibold text-[var(--color-brand-600)] hover:underline cursor-pointer">
                                Salin
                            </button>
                            <button type="button" onclick="closeDashAIResponse()" class="text-[oklch(0.60_0.01_265)] hover:text-rose-600 text-xs font-bold cursor-pointer">
                                ✕
                            </button>
                        </div>
                    </div>
                    <div id="dash-ai-response-content" class="leading-relaxed space-y-1 text-xs"></div>
                </div>

                {{-- Quick Prompt Chips --}}
                <div class="flex flex-wrap gap-1 mb-2" id="dash-quick-chips">
                    {{-- Dynamically populated --}}
                </div>

                <div class="pt-2 border-t border-[var(--color-surface-100)] flex items-center justify-between text-[11px]">
                    <span class="text-[oklch(0.50_0.01_265)]">Gemini AI</span>
                    <a href="{{ route('ai.index') }}" class="font-bold text-[var(--color-brand-600)] hover:underline flex items-center gap-0.5">
                        <span>Chatbot Penuh</span>
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                </div>
            </section>

            {{-- ══════════════════════════════════════════════
                 BOX 5: Kuis Harian Cepat
            ══════════════════════════════════════════════ --}}
            <section class="card p-4 sm:p-4.5 border-[var(--color-surface-200)] shadow-2xs" id="daily-quiz-card">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                        ⚡ Kuis Harian Cepat
                    </span>
                    <span class="text-xs font-bold text-amber-600">+25 XP</span>
                </div>

                <h3 class="text-xs sm:text-sm font-bold text-[var(--color-surface-950)] leading-snug mb-2.5">
                    Konsep OOP apa yang membungkus data agar hanya dapat diakses melalui method khusus?
                </h3>

                {{-- Options --}}
                <div class="space-y-1.5" id="quiz-options">
                    <button type="button" onclick="answerQuiz(false, this)"
                            class="w-full text-left p-2 rounded-lg border border-[var(--color-surface-200)] text-xs font-medium text-[var(--color-surface-800)] hover:bg-[var(--color-surface-50)] transition-all cursor-pointer">
                        A. Inheritance (Pewarisan)
                    </button>
                    <button type="button" onclick="answerQuiz(true, this)"
                            class="w-full text-left p-2 rounded-lg border border-[var(--color-surface-200)] text-xs font-medium text-[var(--color-surface-800)] hover:bg-[var(--color-surface-50)] transition-all cursor-pointer">
                        B. Encapsulation (Enkapsulasi)
                    </button>
                    <button type="button" onclick="answerQuiz(false, this)"
                            class="w-full text-left p-2 rounded-lg border border-[var(--color-surface-200)] text-xs font-medium text-[var(--color-surface-800)] hover:bg-[var(--color-surface-50)] transition-all cursor-pointer">
                        C. Polymorphism (Polimorfisme)
                    </button>
                </div>

                <div id="quiz-feedback" class="hidden mt-2 p-2 rounded-lg text-xs font-medium"></div>

                <p class="text-[10px] text-[oklch(0.50_0.01_265)] pt-2 border-t border-[var(--color-surface-100)] mt-2.5">
                    Pertahankan streak harianmu dengan kuis ini!
                </p>
            </section>

        </div>

    </div>

</div>

{{-- Download Toast --}}
<div id="dash-download-toast" class="fixed bottom-6 right-6 z-50 transform translate-y-12 opacity-0 transition-all duration-300 pointer-events-none">
    <div class="card p-3 bg-[var(--color-surface-950)] text-white shadow-xl flex items-center gap-2 border-0 rounded-xl">
        <span class="text-emerald-400 font-bold">✓</span>
        <p class="text-xs font-semibold" id="dash-toast-title">File diunduh</p>
    </div>
</div>

@push('scripts')
<script>
    // Indonesian Date display
    (function () {
        const el = document.getElementById('today-date');
        if (!el) return;
        const opts = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        el.textContent = new Date().toLocaleDateString('id-ID', opts);
    })();

    // ─── AI Tutor Engine ───
    let currentAIMode = 'materi';
    let currentAISubject = 'all';

    const promptPresets = {
        'all': {
            'materi': [
                { label: '💡 4 Pilar OOP', q: 'Jelaskan 4 Pilar OOP di Java' },
                { label: '🗄️ Syarat 3NF', q: 'Apa syarat tabel mencapai bentuk 3NF?' },
                { label: '🌐 MVC Laravel', q: 'Jelaskan alur MVC pada Laravel' },
                { label: '📡 Subnet /28', q: 'Cara hitung usable host prefix /28' }
            ],
            'error': [
                { label: '🐛 NullPointerException', q: 'Solusi error java.lang.NullPointerException' },
                { label: '🐛 419 Page Expired', q: 'Penyebab error form 419 Page Expired Laravel' },
                { label: '🐛 SQL Syntax 1064', q: 'Solusi error SQL 1064 syntax error' }
            ],
            'code': [
                { label: '⚡ Java Getter-Setter', q: 'Contoh class Enkapsulasi di Java' },
                { label: '⚡ SQL INNER JOIN', q: 'Contoh query SQL INNER JOIN' },
                { label: '⚡ Model Laravel', q: 'Contoh Eloquent Model hasMany Laravel' }
            ]
        },
        'pbo': {
            'materi': [
                { label: '💡 Enkapsulasi', q: 'Perbedaan public, private, protected di Java' },
                { label: '💡 Overriding', q: 'Konsep method overriding pada subclass' }
            ],
            'error': [
                { label: '🐛 NullPointer', q: 'Cara debug variabel null di Java' },
                { label: '🐛 ClassNotFound', q: 'Penyebab error ClassNotFoundException' }
            ],
            'code': [
                { label: '⚡ Inheritance', q: 'Contoh inheritance class di Java' },
                { label: '⚡ Constructor', q: 'Contoh constructor overloading Java' }
            ]
        },
        'web': {
            'materi': [
                { label: '💡 Request Laravel', q: 'Alur request HTTP ke Route & Controller' },
                { label: '💡 Blade Component', q: 'Cara buat component x-card di Blade' }
            ],
            'error': [
                { label: '🐛 419 Expired', q: 'Form Laravel 419: Cara pakai @csrf' },
                { label: '🐛 Route not defined', q: 'Solusi Route not defined di Blade' }
            ],
            'code': [
                { label: '⚡ Migration Siswa', q: 'Contoh migration tabel siswa Laravel' },
                { label: '⚡ Resource Controller', q: 'Contoh Resource Controller CRUD Siswa' }
            ]
        },
        'database': {
            'materi': [
                { label: '💡 Relasi 1-to-Many', q: 'Implementasi 1 to Many dengan Foreign Key' },
                { label: '💡 Normalisasi 2NF', q: 'Syarat normalisasi 2NF' }
            ],
            'error': [
                { label: '🐛 FK Constraint Fails', q: 'Cara atasi error MySQL Foreign key constraint' },
                { label: '🐛 Duplicate Entry', q: 'Penyebab error Integrity constraint violation 1062' }
            ],
            'code': [
                { label: '⚡ JOIN & GROUP BY', q: 'Query SQL rata-rata nilai per kelas' },
                { label: '⚡ CREATE TABLE', q: 'Sintaks DDL tabel berelasi' }
            ]
        }
    };

    function renderPromptChips() {
        const container = document.getElementById('dash-quick-chips');
        if (!container) return;

        const presets = (promptPresets[currentAISubject] || promptPresets['all'])[currentAIMode] || promptPresets['all']['materi'];
        container.innerHTML = '';

        presets.forEach(p => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'prompt-chip text-[10px] py-1 px-2';
            btn.textContent = p.label;
            btn.onclick = () => runPresetPrompt(p.q);
            container.appendChild(btn);
        });
    }

    function setAIMode(mode, el) {
        currentAIMode = mode;
        document.querySelectorAll('.ai-mode-btn').forEach(btn => {
            btn.className = 'ai-mode-btn flex-1 py-1 text-center text-[11px] font-semibold rounded-md text-[oklch(0.50_0.01_265)] hover:text-[var(--color-surface-950)] transition-all cursor-pointer';
        });
        if (el) {
            el.className = 'ai-mode-btn flex-1 py-1 text-center text-[11px] font-bold rounded-md bg-white text-[var(--color-surface-950)] shadow-2xs transition-all cursor-pointer';
        }
        renderPromptChips();
    }

    function setAISubject(subj, el) {
        currentAISubject = subj;
        document.querySelectorAll('.ai-subj-pill').forEach(btn => {
            btn.className = 'ai-subj-pill px-2 py-0.5 text-[10px] font-semibold rounded-full bg-white border border-[var(--color-surface-200)] text-[var(--color-surface-800)] hover:bg-[var(--color-surface-100)] transition-all cursor-pointer whitespace-nowrap';
        });
        if (el) {
            el.className = 'ai-subj-pill px-2 py-0.5 text-[10px] font-bold rounded-full bg-[var(--color-brand-600)] text-white shadow-2xs transition-all cursor-pointer whitespace-nowrap';
        }
        renderPromptChips();
    }

    function runPresetPrompt(question) {
        const input = document.getElementById('dash-ai-input');
        if (input) {
            input.value = question;
            document.getElementById('dash-ai-form')?.requestSubmit();
        }
    }

    function clearAIInput() {
        const input = document.getElementById('dash-ai-input');
        if (input) input.value = '';
    }

    function closeDashAIResponse() {
        const box = document.getElementById('dash-ai-response-box');
        if (box) box.classList.add('hidden');
    }

    async function handleDashboardAISubmit(e) {
        e.preventDefault();
        const input = document.getElementById('dash-ai-input');
        const query = input?.value?.trim();
        if (!query) return;

        const resBox = document.getElementById('dash-ai-response-box');
        const resContent = document.getElementById('dash-ai-response-content');
        const titleEl = document.getElementById('dash-ai-response-title');

        if (resBox && resContent) {
            resBox.classList.remove('hidden');
            resContent.innerHTML = `
                <div class="flex items-center gap-2 text-[var(--color-brand-600)] py-1.5">
                    <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Menganalisis jawaban...</span>
                </div>
            `;
            if (titleEl) titleEl.textContent = `Menjawab: "${query.substring(0, 24)}..."`;
        }

        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const res = await fetch("{{ route('ai.chat') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                body: JSON.stringify({
                    message: query,
                    subject_id: null,
                    mode: currentAIMode
                })
            });

            if (res.ok) {
                const data = await res.json();
                const reply = data.reply || data.message || 'Jawaban dianalisis.';
                formatAndDisplayResponse(reply);
            } else {
                throw new Error('Fallback');
            }
        } catch (err) {
            const simulated = generateLocalSMKResponse(query, currentAIMode);
            formatAndDisplayResponse(simulated);
        }
    }

    function formatAndDisplayResponse(text) {
        const resContent = document.getElementById('dash-ai-response-content');
        if (!resContent) return;

        let formatted = text
            .replace(/```([\s\S]*?)```/g, '<pre class="bg-slate-900 text-emerald-400 p-2 rounded font-mono text-[10px] overflow-x-auto my-1 border border-slate-700"><code>$1</code></pre>')
            .replace(/\*\*(.*?)\*\*/g, '<strong class="text-[var(--color-surface-950)] font-bold">$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/\n/g, '<br>');

        resContent.innerHTML = `<div class="leading-relaxed">${formatted}</div>`;
    }

    function generateLocalSMKResponse(q, mode) {
        const lower = q.toLowerCase();
        if (lower.includes('4 pilar') || lower.includes('oop')) {
            return "4 Pilar OOP:\n1. **Encapsulation**: Pembungkusan data dengan getter/setter.\n2. **Inheritance**: Pewarisan atribut & method (`extends`).\n3. **Polymorphism**: Overriding & overloading method.\n4. **Abstraction**: Penyembunyian detail via `interface` / `abstract`.";
        }
        if (lower.includes('419') || lower.includes('expired')) {
            return "Solusi Error 419 CSRF Laravel:\nTambahkan `@csrf` di dalam form:\n```html\n<form method=\"POST\" action=\"/simpan\">\n    @csrf\n</form>\n```";
        }
        if (lower.includes('nullpointer') || lower.includes('null')) {
            return "Penyebab `NullPointerException`:\nVariabel belum diinisialisasi (`new Class()`) saat method dipanggil.";
        }
        if (lower.includes('join') || lower.includes('sql')) {
            return "Contoh Query `INNER JOIN` SQL:\n```sql\nSELECT s.nama, n.nilai\nFROM siswa s\nINNER JOIN nilai n ON s.id = n.siswa_id;\n```";
        }
        return `Penjelasan singkat topik "${q}":\nKonsep ini penting pada materi kejuruan. Silakan uji coba di lab komputer sekolah.`;
    }

    function copyAIAnswer() {
        const content = document.getElementById('dash-ai-response-content');
        if (!content) return;
        navigator.clipboard.writeText(content.innerText).then(() => {
            const btn = document.getElementById('btn-copy-answer');
            if (btn) {
                const orig = btn.innerHTML;
                btn.innerHTML = '<span>Tersalin! ✓</span>';
                setTimeout(() => btn.innerHTML = orig, 1800);
            }
        });
    }

    // ─── Daily Quiz Engine ───
    function answerQuiz(isCorrect, btn) {
        const feedback = document.getElementById('quiz-feedback');
        const buttons = document.querySelectorAll('#quiz-options button');
        buttons.forEach(b => b.disabled = true);

        if (isCorrect) {
            btn.classList.add('bg-emerald-100', 'border-emerald-400', 'text-emerald-900', 'font-bold');
            if (feedback) {
                feedback.className = 'mt-2 p-2 rounded-lg text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-300';
                feedback.innerHTML = '🎉 <strong>Benar! (+25 XP)</strong> Enkapsulasi membungkus data dengan getter & setter.';
                feedback.classList.remove('hidden');
            }
        } else {
            btn.classList.add('bg-rose-100', 'border-rose-400', 'text-rose-900', 'font-bold');
            if (feedback) {
                feedback.className = 'mt-2 p-2 rounded-lg text-xs font-semibold bg-rose-50 text-rose-800 border border-rose-300';
                feedback.innerHTML = '❌ <strong>Kurang Tepat.</strong> Jawaban benar: <strong>B. Encapsulation</strong>.';
                feedback.classList.remove('hidden');
            }
        }
    }

    // ─── Download Toast ───
    function triggerDashboardDownload(docTitle) {
        const toast = document.getElementById('dash-download-toast');
        const titleEl = document.getElementById('dash-toast-title');
        if (titleEl) titleEl.textContent = `Mengunduh "${docTitle.substring(0, 24)}..."`;

        if (toast) {
            toast.classList.remove('translate-y-12', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-12', 'opacity-0');
            }, 2500);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderPromptChips();
    });
</script>
@endpush

</x-layouts.app>
