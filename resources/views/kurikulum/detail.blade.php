<x-layouts.app
    title="{{ $subject->name }} ({{ $gradeLevel->name }}) — Silabus & AI Tutor"
    description="Rangkuman materi interaktif per bab, bank dokumen modul pembelajaran, dan konsultasi AI Tutor untuk {{ $subject->name }} SMK.">

    {{-- ─── Breadcrumb ─── --}}
    <nav class="flex items-center gap-2 text-xs text-[oklch(0.55_0.01_265)] mb-4 pt-1">
        <a href="{{ route('dashboard') }}" class="hover:text-[var(--color-surface-950)] transition-colors">Beranda</a>
        <svg class="w-3 h-3 text-[oklch(0.70_0.01_265)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <a href="{{ route('kurikulum.index') }}" class="hover:text-[var(--color-surface-950)] transition-colors">Kurikulum</a>
        <svg class="w-3 h-3 text-[oklch(0.70_0.01_265)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <a href="{{ route('kurikulum.show', $gradeLevel->slug) }}" class="hover:text-[var(--color-surface-950)] transition-colors">{{ $gradeLevel->name }}</a>
        <svg class="w-3 h-3 text-[oklch(0.70_0.01_265)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <span class="text-[var(--color-surface-950)] font-semibold truncate">{{ $subject->code }}</span>
    </nav>

    {{-- ─── Sleek Gen-Z Hero Card with AI Launcher ─── --}}
    <div class="card p-6 sm:p-7 mb-6 relative overflow-hidden bg-gradient-to-br from-white via-white to-[var(--color-brand-50)]/40 border-[var(--color-surface-200)] shadow-xs">
        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6">
            <div class="max-w-3xl">
                {{-- Badges Row --}}
                <div class="flex flex-wrap items-center gap-2 mb-2.5">
                    <span class="px-2.5 py-0.5 rounded-md font-mono text-xs font-bold bg-[var(--color-surface-100)] text-[var(--color-surface-900)] border border-[var(--color-surface-200)]">
                        {{ $subject->code }}
                    </span>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider {{ $subject->category === 'kejuruan' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-blue-700' }}">
                        {{ $subject->category === 'kejuruan' ? 'Kejuruan' : 'Umum' }}
                    </span>
                    <span class="text-xs font-medium text-[oklch(0.55_0.01_265)]">
                        {{ $gradeLevel->name }} · {{ $gradeLevel->phase }}
                    </span>
                    <span class="text-xs font-medium text-[oklch(0.55_0.01_265)]">
                        • {{ $subject->total_hours }} JP
                    </span>
                </div>

                {{-- Subject Name --}}
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[var(--color-surface-950)] tracking-tight">
                    {{ $subject->name }}
                </h1>

                @if($subject->vocational_stream)
                    <p class="text-xs font-semibold text-[var(--color-brand-600)] mt-1">
                        Konsentrasi: {{ $subject->vocational_stream }}
                    </p>
                @endif

                <p class="text-xs sm:text-sm text-[oklch(0.50_0.01_265)] mt-2 leading-relaxed max-w-2xl">
                    {{ $subject->description }}
                </p>
            </div>

            {{-- Floating AI Assistant CTA --}}
            <div class="shrink-0 flex flex-col items-start lg:items-end gap-2.5">
                <button
                    type="button"
                    onclick="switchTab('ai-tutor')"
                    class="btn-brand py-2.5 px-4 text-xs sm:text-sm shadow-md flex items-center gap-2 cursor-pointer group">
                    <svg class="w-4.5 h-4.5 animate-pulse text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
                    </svg>
                    <span>Tanya AI Chatbot Mapel Ini</span>
                </button>
                <span class="text-[11px] text-[oklch(0.55_0.01_265)]">Bantuan 24/7 untuk konsep, kode, & soal</span>
            </div>
        </div>

        {{-- Quick Interactive Prompt Chips (Otomatis Tanya) --}}
        <div class="mt-4 pt-3.5 border-t border-[var(--color-surface-100)] flex items-center gap-2 overflow-x-auto pb-1 scrollbar-none">
            <span class="text-[11px] font-bold text-[oklch(0.55_0.01_265)] whitespace-nowrap">⚡ Otomatis Tanya:</span>
            <button type="button" onclick="sendPromptToChat('Tolong jelaskan konsep ini dengan analogi sederhana.')"
                    class="prompt-chip">
                💡 Analogi Sederhana
            </button>
            <button type="button" onclick="sendPromptToChat('Buatkan 3 soal latihan beserta kunci jawabannya.')"
                    class="prompt-chip">
                📝 3 Soal & Kunci
            </button>
            <button type="button" onclick="sendPromptToChat('Bagian apa yang paling sering keluar di ujian?')"
                    class="prompt-chip">
                🎯 Kisi-kisi Ujian
            </button>
            <button type="button" onclick="sendPromptToChat('Berikan contoh penerapan nyata di dunia kerja/industri.')"
                    class="prompt-chip">
                💼 Penerapan Industri
            </button>
        </div>
    </div>

    {{-- ─── Modern Segmented Tabs ─── --}}
    <div class="flex items-center gap-2 mb-6 border-b border-[var(--color-surface-200)]">
        <button
            type="button"
            id="tab-btn-materi"
            onclick="switchTab('materi')"
            class="tab-btn active flex items-center gap-2 px-4 py-3 text-sm font-bold border-b-2 -mb-px transition-all cursor-pointer text-[var(--color-brand-600)] border-[var(--color-brand-600)]">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <span>Rangkuman Materi</span>
            <span class="px-2 py-0.2 rounded-full text-xs font-semibold bg-[var(--color-brand-50)] text-[var(--color-brand-700)]">
                {{ $topics->count() }} Bab
            </span>
        </button>

        <button
            type="button"
            id="tab-btn-dokumen"
            onclick="switchTab('dokumen')"
            class="tab-btn flex items-center gap-2 px-4 py-3 text-sm font-semibold border-b-2 -mb-px transition-all cursor-pointer text-[oklch(0.50_0.01_265)] border-transparent hover:text-[var(--color-surface-950)]">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
            <span>Bank Dokumen & Modul</span>
            <span class="px-2 py-0.2 rounded-full text-xs font-semibold bg-[var(--color-surface-100)] text-[var(--color-surface-700)]">
                {{ $documents->count() }} File
            </span>
        </button>

        <button
            type="button"
            id="tab-btn-ai-tutor"
            onclick="switchTab('ai-tutor')"
            class="tab-btn flex items-center gap-2 px-4 py-3 text-sm font-semibold border-b-2 -mb-px transition-all cursor-pointer text-[oklch(0.50_0.01_265)] border-transparent hover:text-[var(--color-brand-600)]">
            <svg class="w-4 h-4 text-[var(--color-brand-600)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
            </svg>
            <span>AI Chatbot</span>
            <span class="px-2 py-0.2 rounded-full text-[10px] font-bold bg-violet-100 text-violet-700">
                Interaktif
            </span>
        </button>
    </div>

    {{-- ─── TAB 1: Rangkuman Materi (Interactive Expandable Accordion) ─── --}}
    <div id="tab-content-materi" class="tab-pane space-y-4">
        @if($topics->isEmpty())
            <div class="card p-8 text-center">
                <p class="text-xs text-[oklch(0.55_0.01_265)]">Materi untuk mata pelajaran ini sedang dipersiapkan.</p>
            </div>
        @else
            @foreach($topics as $index => $topic)
                <div class="card overflow-hidden border-[var(--color-surface-200)] transition-all duration-200 hover:border-[var(--color-brand-300)]" id="topic-card-{{ $topic->id }}">
                    {{-- Clickable Accordion Header --}}
                    <div
                        onclick="toggleTopicAccordion({{ $topic->id }})"
                        class="p-4 sm:p-5 flex items-center justify-between gap-4 cursor-pointer select-none bg-white hover:bg-[var(--color-surface-50)]/60 transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-[var(--color-brand-50)] text-[var(--color-brand-700)] border border-[var(--color-brand-200)]/60 flex items-center justify-center font-bold text-xs shrink-0">
                                {{ $topic->chapter_number }}
                            </span>
                            <div>
                                <h3 class="text-sm sm:text-base font-bold text-[var(--color-surface-950)] leading-tight">
                                    {{ $topic->title }}
                                </h3>
                                <p class="text-[11px] text-[oklch(0.55_0.01_265)] mt-0.5">
                                    ⚡ Estimasi: {{ $topic->estimated_minutes }} menit baca
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            {{-- Topic AI Prompt Chip --}}
                            <button
                                type="button"
                                onclick="event.stopPropagation(); sendPromptToChat('{{ addslashes($topic->ai_prompt_suggestion ?? 'Jelaskan materi ' . $topic->title) }}')"
                                class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-[var(--color-brand-50)] text-[var(--color-brand-700)] hover:bg-[var(--color-brand-100)] border border-[var(--color-brand-200)] transition-all cursor-pointer">
                                <svg class="w-3.5 h-3.5 text-[var(--color-brand-600)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
                                </svg>
                                <span>Tanya AI</span>
                            </button>

                            {{-- Chevron Icon --}}
                            <div class="w-7 h-7 rounded-full bg-[var(--color-surface-100)] flex items-center justify-center text-[var(--color-surface-600)] transition-transform duration-200" id="topic-chevron-{{ $topic->id }}">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Collapsible Body --}}
                    <div id="topic-body-{{ $topic->id }}" class="border-t border-[var(--color-surface-100)] p-4 sm:p-5 bg-[var(--color-surface-50)]/40 space-y-4 {{ $index === 0 ? '' : 'hidden' }}">
                        {{-- Summary Paragraph --}}
                        <div class="bg-white p-3.5 rounded-[var(--radius-lg)] border border-[var(--color-surface-200)] text-xs sm:text-sm text-[var(--color-surface-800)] leading-relaxed">
                            <span class="font-bold text-[var(--color-surface-950)] block mb-1">Rangkuman Inti:</span>
                            {{ $topic->summary }}
                        </div>

                        {{-- Bite-sized key points --}}
                        @if(!empty($topic->key_points))
                            <div>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-[oklch(0.55_0.01_265)] mb-2">
                                    Target Pemahaman Kunci:
                                </p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    @foreach($topic->key_points as $point)
                                        <div class="flex items-start gap-2 bg-white p-2.5 rounded-lg border border-[var(--color-surface-200)] text-xs text-[var(--color-surface-800)]">
                                            <span class="text-emerald-500 font-bold shrink-0 mt-0.5">✓</span>
                                            <span>{{ $point }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Practical Syntax / Code Implementation --}}
                        <div class="bg-white p-3.5 rounded-[var(--radius-lg)] border border-[var(--color-surface-200)] shadow-2xs">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-[oklch(0.50_0.01_265)] flex items-center gap-1.5">
                                    <span>💻 Contoh Kode & Implementasi Praktikum:</span>
                                </span>
                                <button type="button" onclick="copySnippet('code-ch-{{ $topic->id }}', this)" class="text-xs text-[var(--color-brand-600)] hover:underline font-semibold cursor-pointer">
                                    Salin Kode
                                </button>
                            </div>
                            <pre class="bg-[var(--color-surface-950)] text-emerald-300 p-3 rounded-lg font-mono text-[11px] overflow-x-auto leading-relaxed" id="code-ch-{{ $topic->id }}"><code>@if(str_contains(strtolower($subject->slug), 'pbo') || str_contains(strtolower($subject->slug), 'objek'))
@if($topic->chapter_number == 1)
// Bab 1: Deklarasi Class & Inisialisasi Objek (Java)
public class Siswa {
    String nama;
    int nis;

    public Siswa(String nama, int nis) {
        this.nama = nama;
        this.nis = nis;
    }

    public void tampilkanData() {
        System.out.println("Nama: " + this.nama + " | NIS: " + this.nis);
    }
}
@elseif($topic->chapter_number == 2)
// Bab 2: Enkapsulasi dengan Private Atribut & Setter Getter
public class AkunBank {
    private double saldo;

    public void setSaldo(double jumlah) {
        if (jumlah >= 0) {
            this.saldo = jumlah;
        }
    }

    public double getSaldo() {
        return this.saldo;
    }
}
@elseif($topic->chapter_number == 3)
// Bab 3: Pewarisan (Inheritance) & Polymorphism Overriding
public class Programmer extends Karyawan {
    @Override
    public void bekerja() {
        System.out.println("Menulis kode dan membangun arsitektur sistem.");
    }
}
@else
// Bab 4: Kontrak Interface & Abstraction
public interface DataAccessObject<T> {
    void create(T entity);
    T findById(int id);
}
@endif
@elseif(str_contains(strtolower($subject->slug), 'web') || str_contains(strtolower($subject->slug), 'pwpb'))
@if($topic->chapter_number == 1)
<!-- Bab 1: Struktur Semantik HTML5 Modern -->
<main class="container mx-auto px-4 py-8">
    <article class="prose max-w-none">
        <h1>Materi Web Development SMK</h1>
        <p>Belajar arsitektur frontend responsive dan mobile-first.</p>
    </article>
</main>
@elseif($topic->chapter_number == 2)
/* Bab 2: CSS Flexbox & Grid System */
.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}
@else
// Bab 3: Laravel Route & Controller Binding
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->middleware('auth');
@endif
@elseif(str_contains(strtolower($subject->slug), 'database') || str_contains(strtolower($subject->slug), 'basis-data'))
-- Query Relasi Antar Tabel (SQL Standar)
SELECT s.nis, s.nama, k.nama_kelas
FROM siswa s
INNER JOIN kelas k ON s.id_kelas = k.id
WHERE k.tingkat = '11'
ORDER BY s.nama ASC;
@else
// Algoritma Terstruktur & Logika Komputasi
START
    INPUT data_siswa
    IF nilai >= 75 THEN
        OUTPUT "Kompeten"
    ELSE
        OUTPUT "Remedial"
    END IF
END
@endif</code></pre>
                        </div>

                        {{-- Attached Documents for this Chapter --}}
                        @if($topic->documents->isNotEmpty())
                            <div class="pt-2">
                                <p class="text-[11px] font-bold uppercase tracking-wider text-[oklch(0.55_0.01_265)] mb-2">
                                    File Pembelajaran Bab Ini:
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($topic->documents as $doc)
                                        <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-white border border-[var(--color-surface-200)] text-xs">
                                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold font-mono bg-red-100 text-red-700">
                                                {{ $doc->file_format }}
                                            </span>
                                            <span class="font-medium text-[var(--color-surface-900)] truncate max-w-xs">{{ $doc->title }}</span>
                                            <button type="button" onclick="triggerDownload('{{ $doc->title }}')" class="text-[var(--color-brand-600)] hover:underline font-semibold cursor-pointer ml-1">
                                                Unduh
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    {{-- ─── TAB 2: Bank Dokumen & Modul (Clean Modern List) ─── --}}
    <div id="tab-content-dokumen" class="tab-pane hidden space-y-3">
        @if($documents->isEmpty())
            <div class="card p-8 text-center">
                <p class="text-xs text-[oklch(0.55_0.01_265)]">Belum ada file dokumen untuk mata pelajaran ini.</p>
            </div>
        @else
            @foreach($documents as $doc)
                <div class="card p-4 flex items-center justify-between gap-4 hover:border-[var(--color-brand-300)] transition-all">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold font-mono text-xs shrink-0
                            {{ $doc->file_format === 'PDF' ? 'bg-red-50 text-red-600 border border-red-200' : ($doc->file_format === 'ZIP' ? 'bg-purple-50 text-purple-600 border border-purple-200' : 'bg-blue-50 text-blue-600 border border-blue-200') }}">
                            {{ $doc->file_format }}
                        </div>

                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <h4 class="text-xs sm:text-sm font-bold text-[var(--color-surface-950)] truncate">
                                    {{ $doc->title }}
                                </h4>
                                @if($doc->is_featured)
                                    <span class="px-1.5 py-0.2 rounded text-[10px] font-bold bg-amber-100 text-amber-800 shrink-0">
                                        Rekomendasi
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center gap-3 text-[11px] text-[oklch(0.55_0.01_265)] mt-0.5">
                                <span>{{ $doc->file_size }}</span>
                                <span>•</span>
                                <span>{{ $doc->download_count }}x diunduh</span>
                                @if($doc->topic)
                                    <span>•</span>
                                    <span class="truncate max-w-[150px]">{{ $doc->topic->title }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <button
                        type="button"
                        onclick="triggerDownload('{{ $doc->title }}')"
                        class="px-3.5 py-1.5 rounded-[var(--radius-md)] bg-[var(--color-surface-100)] hover:bg-[var(--color-brand-600)] hover:text-white text-[var(--color-surface-800)] text-xs font-semibold transition-all cursor-pointer shrink-0">
                        Unduh File
                    </button>
                </div>
            @endforeach
        @endif
    </div>

    {{-- ─── TAB 3: AI Chatbot Mapel (Modern Linear/ChatGPT Style) ─── --}}
    <div id="tab-content-ai-tutor" class="tab-pane hidden">
        <div class="card overflow-hidden border-[var(--color-brand-200)] shadow-panel">
            {{-- Header --}}
            <div class="p-4 bg-gradient-to-r from-white to-[var(--color-brand-50)]/50 border-b border-[var(--color-surface-200)] flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center font-bold text-xs shadow-2xs">
                        AI
                    </div>
                    <div>
                        <h3 class="text-xs sm:text-sm font-bold text-[var(--color-surface-950)]">
                            Scholart AI Tutor · {{ $subject->code ?? $subject->name }}
                        </h3>
                        <p class="text-[11px] text-[oklch(0.55_0.01_265)]">Asisten belajar interaktif khusus silabus {{ $subject->name }}</p>
                    </div>
                </div>

                <button type="button" onclick="clearChat()" class="text-xs text-[oklch(0.55_0.01_265)] hover:text-rose-600 cursor-pointer">
                    Bersihkan Chat
                </button>
            </div>

            {{-- Quick Chips / Smart Prompts for Tab 3 --}}
            <div class="px-4 py-2.5 bg-[var(--color-surface-50)] border-b border-[var(--color-surface-200)] flex items-center gap-2 overflow-x-auto scrollbar-none">
                <span class="text-[10px] font-extrabold uppercase tracking-wider text-[oklch(0.50_0.01_265)] whitespace-nowrap">⚡ Otomatis Tanya:</span>
                <button type="button" onclick="sendPromptToChat('Tolong jelaskan konsep ini dengan analogi sederhana.')"
                        class="prompt-chip text-xs py-1 px-2.5 bg-white">
                    💡 Analogi Sederhana
                </button>
                <button type="button" onclick="sendPromptToChat('Buatkan 3 soal latihan beserta kunci jawabannya.')"
                        class="prompt-chip text-xs py-1 px-2.5 bg-white">
                    📝 3 Soal & Kunci
                </button>
                <button type="button" onclick="sendPromptToChat('Bagian apa yang paling sering keluar di ujian?')"
                        class="prompt-chip text-xs py-1 px-2.5 bg-white">
                    🎯 Kisi-kisi Ujian
                </button>
                <button type="button" onclick="sendPromptToChat('Berikan contoh penerapan nyata di dunia kerja/industri.')"
                        class="prompt-chip text-xs py-1 px-2.5 bg-white">
                    💼 Penerapan Industri
                </button>
            </div>

            {{-- Message Area --}}
            <div id="chat-messages-container" class="p-4 sm:p-6 space-y-4 max-h-[450px] min-h-[300px] overflow-y-auto bg-[var(--color-surface-50)]/30">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 shadow-2xs">
                        👨‍🏫
                    </div>
                    <div class="bg-white p-4 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] text-xs sm:text-sm text-[var(--color-surface-900)] leading-relaxed space-y-2 max-w-xl shadow-2xs">
                        <p class="font-bold text-[var(--color-surface-950)]">Halo! Bapak Guru AI SMK siap membimbingmu 🎓</p>
                        <p class="text-[var(--color-surface-800)]">Bapak adalah tutor khusus mata pelajaran <strong>{{ $subject->name }}</strong>. Kalau ada bagian kode atau teori yang sulit dipahami, jangan ragu klik tombol <strong>"Otomatis Tanya"</strong> di atas atau ketik langsung ke Bapak!</p>
                    </div>
                </div>
            </div>

            {{-- Input Bar --}}
            <div class="p-3 bg-white border-t border-[var(--color-surface-200)]">
                <form id="ai-chat-form" onsubmit="handleChatSubmit(event)" class="flex items-center gap-2">
                    <input
                        type="text"
                        id="chat-user-input"
                        placeholder="Ketik pertanyaan seputar {{ $subject->name }}..."
                        autocomplete="off"
                        class="flex-1 px-3.5 py-2 text-xs sm:text-sm rounded-[var(--radius-lg)] border border-[var(--color-surface-200)] bg-[var(--color-surface-50)] text-[var(--color-surface-950)] focus:bg-white focus:outline-hidden focus:border-[var(--color-brand-500)] focus:ring-2 focus:ring-[var(--color-brand-100)] transition-all"
                    >
                    <button type="submit" class="btn-brand py-2 px-3.5 text-xs font-semibold shrink-0 cursor-pointer">
                        Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         INFORMASI SILABUS & CAPAIAN PEMBELAJARAN (CP)
    ══════════════════════════════════════════════ --}}
    <div class="mt-8 pt-6 border-t border-[var(--color-surface-200)]">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            {{-- Capaian Pembelajaran & Profil Pelajar --}}
            <div class="card p-5 lg:col-span-2 border-[var(--color-surface-200)] bg-white shadow-2xs space-y-4">
                <div class="flex items-center justify-between flex-wrap gap-2">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[var(--color-brand-600)] animate-pulse"></span>
                        <h3 class="text-sm font-bold text-[var(--color-surface-950)]">
                            Standar Capaian Pembelajaran (CP) & Silabus SMK
                        </h3>
                    </div>
                    <span class="text-xs font-semibold px-2 py-0.5 rounded bg-[var(--color-brand-50)] text-[var(--color-brand-700)] border border-[var(--color-brand-200)]/60">
                        {{ $gradeLevel->phase }} · {{ $gradeLevel->name }}
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                    <div class="p-3 rounded-lg bg-[var(--color-surface-50)] border border-[var(--color-surface-200)]/70">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[oklch(0.50_0.01_265)] block mb-1">
                            Beban Belajar
                        </span>
                        <p class="font-bold text-[var(--color-surface-950)]">{{ $subject->total_hours }} Jam Pelajaran</p>
                        <p class="text-[11px] text-[oklch(0.55_0.01_265)] mt-0.5">Praktikum 70% · Teori 30%</p>
                    </div>

                    <div class="p-3 rounded-lg bg-[var(--color-surface-50)] border border-[var(--color-surface-200)]/70">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[oklch(0.50_0.01_265)] block mb-1">
                            Metode Belajar
                        </span>
                        <p class="font-bold text-[var(--color-surface-950)]">Project-Based Learning</p>
                        <p class="text-[11px] text-[oklch(0.55_0.01_265)] mt-0.5">Studi kasus nyata industri</p>
                    </div>

                    <div class="p-3 rounded-lg bg-[var(--color-surface-50)] border border-[var(--color-surface-200)]/70">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-[oklch(0.50_0.01_265)] block mb-1">
                            Karakter Pelajar
                        </span>
                        <p class="font-bold text-[var(--color-surface-950)]">Mandiri & Kritis</p>
                        <p class="text-[11px] text-[oklch(0.55_0.01_265)] mt-0.5">Profil Pelajar Pancasila</p>
                    </div>
                </div>

                <div class="pt-1 text-xs text-[oklch(0.50_0.01_265)] leading-relaxed">
                    <span class="font-bold text-[var(--color-surface-900)]">Tujuan Akhir Kompetensi:</span>
                    Peserta didik mampu menganalisis permasalahan logika, merancang arsitektur sistem berbasis standar industri perangkat lunak, menguji kode program secara komprehensif, serta mendokumentasikan hasil pengembangan secara profesional.
                </div>
            </div>

            {{-- Navigasi Mapel Terkait di Tingkat Ini --}}
            <div class="card p-5 border-[var(--color-surface-200)] bg-white shadow-2xs flex flex-col justify-between">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-[oklch(0.50_0.01_265)] mb-3">
                        Mata Pelajaran Lain di {{ $gradeLevel->name }}:
                    </h3>
                    <div class="space-y-2">
                        @foreach($otherSubjects as $other)
                            <a href="{{ route('kurikulum.mapel.show', [$gradeLevel->slug, $other->slug]) }}"
                               class="flex items-center justify-between p-2.5 rounded-lg border border-[var(--color-surface-200)] hover:border-[var(--color-brand-300)] hover:bg-[var(--color-surface-50)] transition-all group">
                                <div class="min-w-0 pr-2">
                                    <span class="font-mono text-[10px] font-bold text-[var(--color-brand-600)] block">{{ $other->code }}</span>
                                    <span class="text-xs font-bold text-[var(--color-surface-900)] group-hover:text-[var(--color-brand-600)] truncate block">
                                        {{ $other->name }}
                                    </span>
                                </div>
                                <svg class="w-3.5 h-3.5 text-[oklch(0.60_0.01_265)] group-hover:text-[var(--color-brand-600)] group-hover:translate-x-0.5 transition-all shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('kurikulum.show', $gradeLevel->slug) }}" class="btn-ghost text-xs justify-center mt-3 pt-2 border-t border-[var(--color-surface-100)]">
                    Lihat Semua Mapel {{ $gradeLevel->name }} →
                </a>
            </div>
        </div>
    </div>

    {{-- Download Toast Notification --}}
    <div id="download-toast" class="fixed bottom-6 right-6 z-50 transform translate-y-12 opacity-0 transition-all duration-300 pointer-events-none">
        <div class="card p-3 bg-[var(--color-surface-950)] text-white shadow-xl flex items-center gap-2.5 border-0">
            <span class="text-emerald-400 font-bold">✓</span>
            <p class="text-xs font-semibold" id="toast-title">File diunduh</p>
        </div>
    </div>

    @push('scripts')
    <script>
        // ─── Tabs Switcher ───
        function switchTab(tabName) {
            const tabs = ['materi', 'dokumen', 'ai-tutor'];

            tabs.forEach(t => {
                const btn = document.getElementById('tab-btn-' + t);
                const pane = document.getElementById('tab-content-' + t);

                if (t === tabName) {
                    btn?.classList.add('text-[var(--color-brand-600)]', 'border-[var(--color-brand-600)]', 'font-bold');
                    btn?.classList.remove('border-transparent', 'text-[oklch(0.50_0.01_265)]', 'font-semibold');
                    pane?.classList.remove('hidden');
                } else {
                    btn?.classList.remove('text-[var(--color-brand-600)]', 'border-[var(--color-brand-600)]', 'font-bold');
                    btn?.classList.add('border-transparent', 'text-[oklch(0.50_0.01_265)]', 'font-semibold');
                    pane?.classList.add('hidden');
                }
            });

            if (tabName === 'ai-tutor') {
                setTimeout(() => {
                    document.getElementById('chat-user-input')?.focus();
                }, 100);
            }
        }

        // ─── Interactive Chapter Accordion ───
        function toggleTopicAccordion(id) {
            const body = document.getElementById('topic-body-' + id);
            const chevron = document.getElementById('topic-chevron-' + id);

            if (body) {
                if (body.classList.contains('hidden')) {
                    body.classList.remove('hidden');
                    chevron?.classList.add('rotate-180');
                } else {
                    body.classList.add('hidden');
                    chevron?.classList.remove('rotate-180');
                }
            }
        }

        // ─── Download Toast ───
        function triggerDownload(fileName) {
            const toast = document.getElementById('download-toast');
            const title = document.getElementById('toast-title');
            if (title) title.innerText = 'Mengunduh: ' + fileName;

            toast?.classList.remove('translate-y-12', 'opacity-0', 'pointer-events-none');
            toast?.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast?.classList.remove('translate-y-0', 'opacity-100');
                toast?.classList.add('translate-y-12', 'opacity-0', 'pointer-events-none');
            }, 3000);
        }

        // ─── AI Chat Interaction ───
        const subjectName = @json($subject->name);

        function sendPromptToChat(promptText) {
            switchTab('ai-tutor');
            const input = document.getElementById('chat-user-input');
            if (input) {
                input.value = promptText;
                handleChatSubmit(new Event('submit'));
            }
        }

        async function handleChatSubmit(e) {
            e.preventDefault();
            const input = document.getElementById('chat-user-input');
            const text = input?.value.trim();
            if (!text) return;

            appendUserMsg(text);
            input.value = '';

            const typingId = showTyping();

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const response = await fetch("{{ route('ai.chat') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message: text,
                        subject_slug: @json($subject->slug)
                    })
                });

                const data = await response.json();
                removeTyping(typingId);

                if (data.success && data.reply) {
                    appendAIMsg(data.reply);
                } else {
                    const fallback = generateAIReply(text);
                    appendAIMsg(fallback);
                }
            } catch (err) {
                removeTyping(typingId);
                const fallback = generateAIReply(text);
                appendAIMsg(fallback);
            }
        }

        function appendUserMsg(text) {
            const container = document.getElementById('chat-messages-container');
            const msg = document.createElement('div');
            msg.className = 'flex items-start justify-end gap-2.5';
            msg.innerHTML = `
                <div class="bg-gradient-to-r from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white p-3 rounded-2xl rounded-tr-sm text-xs sm:text-sm max-w-md shadow-2xs leading-relaxed">
                    <p>${escapeHtml(text)}</p>
                </div>
            `;
            container.appendChild(msg);
            container.scrollTop = container.scrollHeight;
        }

        function showTyping() {
            const container = document.getElementById('chat-messages-container');
            const id = 'typing-' + Date.now();
            const div = document.createElement('div');
            div.id = id;
            div.className = 'flex items-start gap-2.5';
            div.innerHTML = `
                <div class="w-7 h-7 rounded-lg bg-[var(--color-brand-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">AI</div>
                <div class="bg-white px-3 py-2 rounded-xl border border-[var(--color-surface-200)] flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-400)] animate-bounce"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-400)] animate-bounce [animation-delay:0.2s]"></span>
                    <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-400)] animate-bounce [animation-delay:0.4s]"></span>
                </div>
            `;
            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
            return id;
        }

        function removeTyping(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }

        function appendAIMsg(html) {
            const container = document.getElementById('chat-messages-container');
            const msg = document.createElement('div');
            msg.className = 'flex items-start gap-2.5';
            msg.innerHTML = `
                <div class="w-7 h-7 rounded-lg bg-[var(--color-brand-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">AI</div>
                <div class="bg-white p-3.5 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] text-xs sm:text-sm text-[var(--color-surface-900)] leading-relaxed space-y-2 max-w-xl shadow-2xs">
                    ${html}
                </div>
            `;
            container.appendChild(msg);
            container.scrollTop = container.scrollHeight;
        }

        function clearChat() {
            const container = document.getElementById('chat-messages-container');
            if (container) {
                container.innerHTML = `
                    <div class="flex items-start gap-3">
                        <div class="w-7 h-7 rounded-lg bg-[var(--color-brand-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">AI</div>
                        <div class="bg-white p-3 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] text-xs text-[var(--color-surface-800)]">
                            Percakapan telah direset. Mau bahas apa hari ini?
                        </div>
                    </div>
                `;
            }
        }

        function copySnippet(elementId, btn) {
            const el = document.getElementById(elementId);
            if (!el) return;
            navigator.clipboard.writeText(el.innerText).then(() => {
                const orig = btn.innerText;
                btn.innerText = '✓ Tersalin!';
                setTimeout(() => { btn.innerText = orig; }, 2000);
            });
        }

        function generateAIReply(query) {
            const lower = query.toLowerCase();

            if (lower.includes('konsep') || lower.includes('kunci') || lower.includes('pbo') || lower.includes('oop')) {
                return `
                    <div class="space-y-2">
                        <p class="font-bold text-[var(--color-surface-950)]">3 Konsep Kunci Paling Penting:</p>
                        <ol class="list-decimal pl-4 space-y-1 text-xs">
                            <li><strong>Encapsulation</strong>: Memproteksi atribut agar tidak dimodifikasi sembarangan dari luar class (gunakan akses <code>private</code>).</li>
                            <li><strong>Inheritance</strong>: Mewariskan atribut dan method ke class anak untuk menghindari duplikasi kode (DRY).</li>
                            <li><strong>Polymorphism</strong>: Fleksibilitas pemanggilan method seragam yang perilakunya disesuaikan oleh class anak (overriding).</li>
                        </ol>
                        <pre class="bg-[var(--color-surface-950)] text-emerald-300 p-2.5 rounded-lg font-mono text-[11px] overflow-x-auto"><code>// Contoh Polimorfisme Pewarisan
class Kucing extends Hewan {
    @Override
    public void bersuara() { System.out.println("Meow!"); }
}</code></pre>
                    </div>
                `;
            }

            if (lower.includes('industri') || lower.includes('nyata') || lower.includes('kerja')) {
                return `
                    <div class="space-y-2">
                        <p class="font-bold text-[var(--color-surface-950)]">💼 Implementasi Nyata di Industri Perangkat Lunak:</p>
                        <p class="text-xs">Di industri startup dan tech unicorn, materi <strong>${escapeHtml(subjectName)}</strong> digunakan untuk:</p>
                        <ul class="list-disc pl-4 space-y-1 text-xs text-[var(--color-surface-800)]">
                            <li><strong>Clean Architecture</strong>: Memisahkan lapisan logic bisnis dari UI atau database agar mudah diuji secara otomatis (Unit Test).</li>
                            <li><strong>Maintainability</strong>: Kode yang modular memungkinkan puluhan engineer bekerja paralel dalam 1 repository Git tanpa saling bentrok.</li>
                            <li><strong>Scalability</strong>: Menghadapi jutaan request pengguna dengan optimasi query dan struktur data efisien.</li>
                        </ul>
                    </div>
                `;
            }

            if (lower.includes('soal') || lower.includes('kuis') || lower.includes('latihan')) {
                return `
                    <div class="space-y-2">
                        <p class="font-bold text-[var(--color-surface-950)]">🎯 Latihan Soal Uji Kompetensi Kejuruan:</p>
                        <div class="p-2.5 rounded-lg bg-[var(--color-surface-100)] text-xs space-y-1.5">
                            <p><strong>Soal:</strong> Manakah access modifier yang memberikan akses ke anggota kelas hanya di dalam kelas itu sendiri dan kelas turunannya (subclass)?</p>
                            <p class="text-emerald-700 font-semibold">✓ Jawaban: <code>protected</code>.</p>
                            <p class="text-[11px] text-[oklch(0.50_0.01_265)]">Penjelasan: <code>private</code> hanya dalam class itu sendiri, sedangkan <code>protected</code> mengizinkan akses untuk turunan (subclass) di package yang sama maupun beda package.</p>
                        </div>
                    </div>
                `;
            }

            return `
                <div class="space-y-2">
                    <p class="text-xs">Pertanyaan kamu tentang <strong>${escapeHtml(subjectName)}</strong>:</p>
                    <p class="text-xs font-semibold text-[var(--color-surface-950)]">"${escapeHtml(query)}"</p>
                    <p class="text-xs text-[var(--color-surface-800)] leading-relaxed">
                        Topik ini memiliki implementasi langsung pada bab modul pembelajaran di atas. Kamu dapat memeriksa jobsheet praktikum dan contoh kode di tab <strong>Rangkuman Materi</strong> atau mengunduh modul PDF lengkap di tab <strong>Bank Dokumen</strong>!
                    </p>
                </div>
            `;
        }

        function escapeHtml(str) {
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }
    </script>
    @endpush

</x-layouts.app>
