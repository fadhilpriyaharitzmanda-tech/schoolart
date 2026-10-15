<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AiTutorController extends Controller
{
    /**
     * Display the dedicated full-screen AI Tutor page.
     */
    public function index(Request $request): View
    {
        $subjects = Subject::with('gradeLevel')->orderBy('grade_level_id')->orderBy('order')->get();
        $selectedSubjectSlug = $request->input('mapel');

        $selectedSubject = null;
        if ($selectedSubjectSlug) {
            $selectedSubject = $subjects->firstWhere('slug', $selectedSubjectSlug);
        }

        // The 4 mandatory Smart Prompts from the specification
        $smartPrompts = [
            [
                'title' => 'Analogi Sederhana',
                'prompt' => 'Tolong jelaskan konsep ini dengan analogi sederhana.',
                'icon' => '💡',
            ],
            [
                'title' => '3 Soal Latihan & Kunci',
                'prompt' => 'Buatkan 3 soal latihan beserta kunci jawabannya.',
                'icon' => '📝',
            ],
            [
                'title' => 'Kisi-kisi Ujian',
                'prompt' => 'Bagian apa yang paling sering keluar di ujian?',
                'icon' => '🎯',
            ],
            [
                'title' => 'Penerapan Industri',
                'prompt' => 'Berikan contoh penerapan nyata di dunia kerja/industri.',
                'icon' => '💼',
            ],
        ];

        return view('ai.index', [
            'subjects' => $subjects,
            'selectedSubject' => $selectedSubject,
            'smartPrompts' => $smartPrompts,
        ]);
    }

    /**
     * API to process chat queries with the SMK Teacher persona.
     * Persona: Tutor/Guru SMK yang sabar, ramah, dan menjelaskan dengan analogi sederhana.
     */
    public function chat(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
            'subject_id' => 'nullable|exists:subjects,id',
            'subject_slug' => 'nullable|string',
        ]);

        $message = trim($validated['message']);
        $subject = null;

        if (! empty($validated['subject_id'])) {
            $subject = Subject::find($validated['subject_id']);
        } elseif (! empty($validated['subject_slug'])) {
            $subject = Subject::where('slug', $validated['subject_slug'])->first();
        }

        $reply = $this->generateTeacherReply($message, $subject);

        return response()->json([
            'success' => true,
            'reply' => $reply,
            'subject' => $subject ? $subject->name : 'Umum SMK',
        ]);
    }

    /**
     * Generate structured response embodying the friendly SMK Teacher persona.
     */
    protected function generateTeacherReply(string $message, ?Subject $subject = null): string
    {
        $lower = strtolower($message);
        $subjectName = $subject ? $subject->name : 'Materi Kejuruan SMK';

        // ─── 1. Smart Prompt: "Tolong jelaskan konsep ini dengan analogi sederhana." ───
        if (str_contains($lower, 'analogi') || str_contains($lower, 'sederhana')) {
            if ($subject && (str_contains($subject->slug, 'pbo') || str_contains($subject->slug, 'objek'))) {
                return <<<'HTML'
<div class="space-y-3">
    <p>Halo murid hebat! Pertanyaan yang bagus sekali. Yuk kita bayangkan konsep <strong>OOP (Pemrograman Berorientasi Objek)</strong> ini pakai analogi yang sering kita jumpai sehari-hari: <strong>Dapur Pabrik Mobil & Kue Cetak</strong> 🚗🍪</p>
    
    <div class="p-3.5 rounded-xl bg-amber-50/80 border border-amber-200/80 text-xs text-amber-900 space-y-2">
        <p><strong>1. Class itu seperti "Cetakan Kue / Cetak Biru Mobil"</strong></p>
        <p>Cetakan belum bisa dimakan dan belum punya isi, tapi cetakan menentukan bentuknya: punya roda 4, punya pintu, dan punya mesin.</p>
        
        <p><strong>2. Object itu adalah "Mobil Nyata / Kue Matang"</strong></p>
        <p>Ketika cetakan dicetak (<code>new Mobil()</code>), jadilah mobil warna merah milik Pak Budi dengan nomor polisi B 1234 CD.</p>

        <p><strong>3. Enkapsulasi itu seperti "Kap Mesin Mobil Terkunci"</strong></p>
        <p>Pengemudi cukup menginjak pedal gas (<code>getter/setter</code>). Bagian mesin di dalam dikunci rapat (<code>private</code>) agar penumpang tidak tersengat listrik atau merusak kabel.</p>
    </div>

    <p class="text-xs text-[var(--color-surface-800)]">Gimana, sekarang terasa jauh lebih masuk akal dan gampang dipahami kan? Ada bagian mana lagi yang ingin kamu diskusikan bareng Bapak?</p>
</div>
HTML;
            }

            if ($subject && (str_contains($subject->slug, 'database') || str_contains($subject->slug, 'basis-data'))) {
                return <<<'HTML'
<div class="space-y-3">
    <p>Halo! Tenang, jangan pusing dulu dengan istilah teknis basis data ya. Mari kita pahami <strong>Normalisasi Database (3NF)</strong> dengan analogi: <strong>Lemari Baju di Kamar Tidur</strong> 👔👖</p>

    <div class="p-3.5 rounded-xl bg-blue-50/80 border border-blue-200/80 text-xs text-blue-900 space-y-2">
        <p><strong>• Data Belum Normal (Unnormalized)</strong>: Bayangkan semua baju, celana, kaos kaki, dan selimut dilempar bertumpuk dalam 1 keranjang besar. Mau cari kaos kaki saja butuh waktu setengah jam!</p>
        <p><strong>• Normalisasi 1NF & 2NF</strong>: Kita mulai pisahkan laci kaos dan laci celana.</p>
        <p><strong>• Normalisasi 3NF (Bentuk Ketiga)</strong>: Di laci kaos, kita tidak perlu menuliskan alamat toko tempat kita beli kaos di setiap helai baju. Cukup catat "ID Toko", dan detail tokonya ada di buku catatan terpisah (Foreign Key)!</p>
    </div>

    <p class="text-xs text-[var(--color-surface-800)]">Dengan memisahkan data ke tabel yang tepat, database kita jadi super kencang, rapi, dan tidak membuang-buang memori penyimpanan!</p>
</div>
HTML;
            }

            return <<<HTML
<div class="space-y-3">
    <p>Halo! Senang sekali kamu bertanya. Belajar di SMK itu kuncinya menghubungkan logika kode dengan hal-hal nyata di sekitar kita 💡</p>
    <div class="p-3.5 rounded-xl bg-violet-50/80 border border-violet-200/80 text-xs text-violet-900 space-y-2">
        <p>Bayangkan materi <strong>{$subjectName}</strong> ini seperti alur kerja di sebuah restoran modern:</p>
        <p>1. <strong>Input (Pelanggan memesan makanan)</strong>: Data masuk ke sistem kasir.</p>
        <p>2. <strong>Proses (Koki memasak di dapur sesuai resep)</strong>: Kode program memproses data secara terstruktur.</p>
        <p>3. <strong>Output (Makanan dihidangkan ke meja)</strong>: Antarmuka aplikasi menampilkan hasil yang memuaskan pengguna.</p>
    </div>
    <p class="text-xs text-[var(--color-surface-800)]">Semua teknologi canggih selalu berakar dari logika sederhana yang dirangkai secara teliti. Semangat terus belajarnya ya!</p>
</div>
HTML;
        }

        // ─── 2. Smart Prompt: "Buatkan 3 soal latihan beserta kunci jawabannya." ───
        if (str_contains($lower, '3 soal') || str_contains($lower, 'soal latihan') || str_contains($lower, 'kunci')) {
            return <<<HTML
<div class="space-y-3">
    <p>Tentu, ini dia <strong>3 Soal Latihan Mandiri SMK</strong> untuk menguji pemahamanmu tentang <strong>{$subjectName}</strong>, lengkap dengan kunci dan pembahasannya ya! 🎯</p>

    <div class="space-y-2.5 text-xs">
        <div class="p-3 rounded-lg bg-white border border-[var(--color-surface-200)] shadow-2xs space-y-1">
            <p class="font-bold text-[var(--color-surface-950)]">Soal 1 (Konseptual):</p>
            <p class="text-[var(--color-surface-800)]">Mengapa variabel data pada class sebaiknya dideklarasikan dengan access modifier <code>private</code>?</p>
            <details class="mt-2 text-[11px] cursor-pointer text-[var(--color-brand-700)]">
                <summary class="font-semibold hover:underline">Lihat Kunci Jawaban & Pembahasan</summary>
                <div class="mt-1.5 p-2 bg-emerald-50 text-emerald-800 rounded border border-emerald-200">
                    <strong>Kunci:</strong> Untuk menerapkan prinsip <em>Encapsulation</em>, mencegah modifikasi ilegal dari luar, serta memastikan data hanya dapat diakses melalui method validasi (getter/setter).
                </div>
            </details>
        </div>

        <div class="p-3 rounded-lg bg-white border border-[var(--color-surface-200)] shadow-2xs space-y-1">
            <p class="font-bold text-[var(--color-surface-950)]">Soal 2 (Analisis Kasus):</p>
            <p class="text-[var(--color-surface-800)]">Jika sebuah class <code>Manager</code> mewarisi class <code>Pegawai</code> dan mengganti method <code>hitungGaji()</code> dengan formula baru, konsep apakah yang sedang diterapkan?</p>
            <details class="mt-2 text-[11px] cursor-pointer text-[var(--color-brand-700)]">
                <summary class="font-semibold hover:underline">Lihat Kunci Jawaban & Pembahasan</summary>
                <div class="mt-1.5 p-2 bg-emerald-50 text-emerald-800 rounded border border-emerald-200">
                    <strong>Kunci:</strong> <em>Method Overriding</em> (bagian dari pilar <strong>Polymorphism</strong>). Class anak menimpa perilaku method induknya sesuai kebutuhan spesifik.
                </div>
            </details>
        </div>

        <div class="p-3 rounded-lg bg-white border border-[var(--color-surface-200)] shadow-2xs space-y-1">
            <p class="font-bold text-[var(--color-surface-950)]">Soal 3 (Implementasi Praktik):</p>
            <p class="text-[var(--color-surface-800)]">Manakah kata kunci yang digunakan sebuah class di Java/PHP untuk mengimplementasikan sebuah <code>interface</code>?</p>
            <details class="mt-2 text-[11px] cursor-pointer text-[var(--color-brand-700)]">
                <summary class="font-semibold hover:underline">Lihat Kunci Jawaban & Pembahasan</summary>
                <div class="mt-1.5 p-2 bg-emerald-50 text-emerald-800 rounded border border-emerald-200">
                    <strong>Kunci:</strong> Kata kunci <code>implements</code>.
                </div>
            </details>
        </div>
    </div>
    <p class="text-xs text-[oklch(0.50_0.01_265)]">Coba kerjakan tanpa melihat kunci terlebih dahulu ya, baru cocokkan untuk evaluasi diri!</p>
</div>
HTML;
        }

        // ─── 3. Smart Prompt: "Bagian apa yang paling sering keluar di ujian?" ───
        if (str_contains($lower, 'keluar di ujian') || str_contains($lower, 'kisi') || str_contains($lower, 'sering keluar')) {
            return <<<HTML
<div class="space-y-3">
    <p>Bocoran penting dari pengalaman mengajar Bapak nih! Berdasarkan Ujian Sekolah (US) dan Uji Kompetensi Keahlian (UKK) SMK, ini <strong>3 Topik yang Paling Sering Muncul</strong> pada materi <strong>{$subjectName}</strong>: 📝⚡</p>

    <div class="space-y-2 text-xs">
        <div class="flex items-start gap-2.5 p-2.5 rounded-lg bg-rose-50 border border-rose-200 text-rose-950">
            <span class="font-bold text-rose-600 shrink-0">1. Paling Sering (Bobot 40%):</span>
            <div>
                <strong>Perbedaan Access Modifier (Private, Protected, Public)</strong>. Soal sering meminta menentukan apakah suatu baris kode error atau berhasil saat memanggil variabel dari class lain.
            </div>
        </div>

        <div class="flex items-start gap-2.5 p-2.5 rounded-lg bg-amber-50 border border-amber-200 text-amber-950">
            <span class="font-bold text-amber-600 shrink-0">2. Soal Kasus (Bobot 35%):</span>
            <div>
                <strong>Relasi Pewarisan (Inheritance & Super Constructor)</strong>. Biasanya disajikan diagram UML sederhana, lalu diminta menerjemahkannya ke dalam sintaks kode yang valid.
            </div>
        </div>

        <div class="flex items-start gap-2.5 p-2.5 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-950">
            <span class="font-bold text-emerald-600 shrink-0">3. Logika Error (Bobot 25%):</span>
            <div>
                <strong>Pencegahan NullPointerException</strong> dan kesalahan penulisan method overriding (misal lupa anotasi <code>@Override</code> atau beda tipe parameter).
            </div>
        </div>
    </div>

    <p class="text-xs text-[var(--color-surface-800)]">Kuasai tiga poin di atas, insya Allah nilai ujian teori maupun praktikum kejuruanmu bisa tembus predikat A!</p>
</div>
HTML;
        }

        // ─── 4. Smart Prompt: "Berikan contoh penerapan nyata di dunia kerja/industri." ───
        if (str_contains($lower, 'dunia kerja') || str_contains($lower, 'industri') || str_contains($lower, 'penerapan nyata')) {
            return <<<HTML
<div class="space-y-3">
    <p>Pertanyaan yang sangat visioner! Di dunia kerja nyata seperti di <em>Software House</em>, <em>Fintech</em>, atau <em>Startup Unicorn</em>, materi <strong>{$subjectName}</strong> digunakan untuk hal-hal besar seperti ini: 💼🚀</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5 text-xs">
        <div class="p-3 rounded-lg bg-white border border-[var(--color-surface-200)] shadow-2xs space-y-1">
            <p class="font-bold text-[var(--color-brand-700)]">🏦 Sistem Pembayaran (Payment Gateway):</p>
            <p class="text-[var(--color-surface-800)]">Interface <code>PaymentMethod</code> digunakan agar Tokopedia bisa menerima Transfer Bank, GoPay, dan Kartu Kredit secara seragam tanpa merombak kode checkout!</p>
        </div>

        <div class="p-3 rounded-lg bg-white border border-[var(--color-surface-200)] shadow-2xs space-y-1">
            <p class="font-bold text-[var(--color-brand-700)]">🔐 Keamanan Akun Pengguna:</p>
            <p class="text-[var(--color-surface-800)]">Enkapsulasi menjaga agar saldo e-wallet dan password terenkripsi tidak bisa diubah langsung oleh sembarang fungsi liar di aplikasi.</p>
        </div>

        <div class="p-3 rounded-lg bg-white border border-[var(--color-surface-200)] shadow-2xs space-y-1">
            <p class="font-bold text-[var(--color-brand-700)]">👥 Kerja Kolaboratif Tim (Git):</p>
            <p class="text-[var(--color-surface-800)]">Karena kode dibagi per class dan modul mandiri, 20 programmer bisa membuat fitur berbeda secara bersamaan tanpa saling merusak kode teman.</p>
        </div>

        <div class="p-3 rounded-lg bg-white border border-[var(--color-surface-200)] shadow-2xs space-y-1">
            <p class="font-bold text-[var(--color-brand-700)]">📈 Skalabilitas Aplikasi:</p>
            <p class="text-[var(--color-surface-800)]">Sistem yang dirancang dengan arsitektur OOP rapi mudah di-upgrade saat pengguna bertambah dari 1.000 menjadi 10.000.000 pengguna!</p>
        </div>
    </div>

    <p class="text-xs text-[var(--color-surface-800)]">Jadi yang kamu pelajari di SMK hari ini adalah bekal langsung yang dipakai para senior software engineer di industri. Keren kan?</p>
</div>
HTML;
        }

        // ─── 5. General Queries with Teacher Persona ───
        return <<<HTML
<div class="space-y-3">
    <p>Halo! Terima kasih sudah bertanya ke Bapak tentang: <strong>"{$message}"</strong> 😊</p>
    
    <div class="p-3.5 rounded-xl bg-white border border-[var(--color-surface-200)] shadow-2xs text-xs space-y-2 text-[var(--color-surface-800)]">
        <p>Pada mata pelajaran <strong>{$subjectName}</strong>, hal penting yang perlu kita ingat adalah selalu memecah masalah besar menjadi potongan-potongan kecil yang teratur (<em>Computational Thinking</em>).</p>
        <p>Jika kamu sedang mengalami error atau bingung alur kodenya, jangan sungkan kirimkan baris kodenya ke sini ya. Kita bedah sama-sama baris demi baris!</p>
    </div>

    <p class="text-xs text-[oklch(0.50_0.01_265)]">Bapak siap bantu kapan pun kamu butuh bimbingan belajar.</p>
</div>
HTML;
    }
}
