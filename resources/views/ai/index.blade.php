<x-layouts.app
    title="Scholart AI Tutor — Konsultasi Belajar SMK"
    description="Tutor AI SMK yang sabar, ramah, dan menjelaskan materi kejuruan dengan analogi sederhana serta fitur tanya cepat otomatis.">

    {{-- ─── Breadcrumb ─── --}}
    <nav class="flex items-center gap-2 text-xs text-[oklch(0.55_0.01_265)] mb-4 pt-1">
        <a href="{{ route('dashboard') }}" class="hover:text-[var(--color-surface-950)] transition-colors">Beranda</a>
        <svg class="w-3 h-3 text-[oklch(0.70_0.01_265)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
        <span class="text-[var(--color-surface-950)] font-semibold">AI Tutor Pintar SMK</span>
    </nav>

    {{-- ─── Main Chat Workspace ─── --}}
    <div class="card overflow-hidden border-[var(--color-surface-200)] shadow-panel bg-white flex flex-col h-[calc(100vh-12rem)] min-h-[580px]">

        {{-- ─── 1. Header Bar: Teacher Persona & Subject Selector ─── --}}
        <div class="p-4 sm:px-6 bg-gradient-to-r from-white via-white to-[var(--color-brand-50)]/40 border-b border-[var(--color-surface-200)] flex items-center justify-between flex-wrap gap-3 shrink-0">
            <div class="flex items-center gap-3">
                {{-- Teacher Avatar --}}
                <div class="relative">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center font-bold text-sm shadow-sm">
                        👨‍🏫
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
                </div>

                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-sm sm:text-base font-extrabold text-[var(--color-surface-950)]">
                            Pak Guru AI · Tutor Belajar SMK
                        </h1>
                        <span class="px-2 py-0.2 rounded-full text-[10px] font-bold bg-violet-100 text-violet-800">
                            Sabar & Ramah
                        </span>
                    </div>
                    <p class="text-[11px] text-[oklch(0.50_0.01_265)]">
                        Menjelaskan konsep kejuruan dengan analogi sederhana dan studi kasus industri
                    </p>
                </div>
            </div>

            {{-- Right: Subject Selector Pill & Clear Chat --}}
            <div class="flex items-center gap-2.5">
                <div class="relative">
                    <select id="chat-subject-select"
                            onchange="changeSubjectContext(this.value)"
                            class="text-xs font-semibold py-1.5 pl-3 pr-8 rounded-xl border border-[var(--color-surface-200)] bg-[var(--color-surface-50)] text-[var(--color-surface-900)] focus:bg-white focus:outline-hidden focus:ring-2 focus:ring-[var(--color-brand-200)] cursor-pointer">
                        <option value="">Fokus: Semua Mapel SMK</option>
                        @foreach($subjects as $subj)
                            <option value="{{ $subj->slug }}" {{ ($selectedSubject && $selectedSubject->id === $subj->id) ? 'selected' : '' }}>
                                {{ $subj->code }} · {{ $subj->name }} ({{ $subj->gradeLevel->name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="button"
                        onclick="clearConversation()"
                        class="p-2 rounded-xl text-[oklch(0.55_0.01_265)] hover:text-rose-600 hover:bg-rose-50 border border-transparent hover:border-rose-100 transition-colors cursor-pointer"
                        title="Reset Percakapan">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- ─── 2. Prominent "Otomatis Tanya" (Smart Prompts Bar) ─── --}}
        <div class="px-4 py-2.5 bg-[var(--color-surface-50)] border-b border-[var(--color-surface-200)] flex items-center gap-2 overflow-x-auto scrollbar-none shrink-0">
            <span class="text-[10px] font-extrabold uppercase tracking-wider text-[oklch(0.50_0.01_265)] whitespace-nowrap flex items-center gap-1">
                <span>⚡ Otomatis Tanya:</span>
            </span>

            @foreach($smartPrompts as $sp)
                <button type="button"
                        data-prompt="{{ $sp['prompt'] }}"
                        title="{{ $sp['prompt'] }}"
                        onclick="sendSmartPrompt({{ json_encode($sp['prompt'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }})"
                        class="prompt-chip bg-white border border-[var(--color-surface-200)] hover:border-[var(--color-brand-400)] text-xs text-[var(--color-surface-800)] hover:text-[var(--color-brand-700)] hover:bg-[var(--color-brand-50)] shrink-0 transition-all flex items-center gap-1.5 py-1.5 px-3">
                    <span>{{ $sp['icon'] }}</span>
                    <span class="font-semibold">{{ $sp['title'] }}</span>
                </button>
            @endforeach
        </div>

        {{-- ─── 3. Messages Stream (Clean Linear/ChatGPT Style) ─── --}}
        <div id="ai-chat-thread" class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4 bg-gradient-to-b from-white to-[var(--color-surface-50)]/30">

            {{-- Initial Friendly Greeting from SMK Teacher --}}
            <div class="flex items-start gap-3 max-w-2xl animate-fade-in">
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 shadow-2xs">
                    AI
                </div>
                <div class="bg-white p-4 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] text-xs sm:text-sm text-[var(--color-surface-900)] leading-relaxed space-y-2.5 shadow-2xs">
                    <p class="font-bold text-[var(--color-surface-950)] text-sm">
                        Halo Budi! Salam hangat dari Bapak 👋
                    </p>
                    <p class="text-[var(--color-surface-800)]">
                        Bapak siap menemani belajarmu hari ini. Kalau ada materi pelajaran SMK yang terasa rumit atau bikin bingung, jangan dipendam sendiri ya! Kita bedah bersama dengan <strong>analogi sehari-hari</strong> yang santai dan gampang dipahami.
                    </p>
                    <div class="pt-1 border-t border-[var(--color-surface-100)] text-[11px] text-[oklch(0.50_0.01_265)]">
                        Kamu bisa langsung klik salah satu tombol <strong>"Otomatis Tanya"</strong> di atas atau ketik langsung pertanyaanmu di bawah!
                    </div>
                </div>
            </div>

        </div>

        {{-- ─── 4. Input & Send Bar ─── --}}
        <div class="p-3 sm:p-4 bg-white border-t border-[var(--color-surface-200)] shrink-0">
            <form id="ai-main-form" onsubmit="handleMainChatSubmit(event)" class="flex items-center gap-2">
                @csrf
                <div class="relative flex-1">
                    <input
                        type="text"
                        id="ai-user-input"
                        placeholder="Tanyakan konsep, minta analogi, atau latihan soal SMK ke Bapak..."
                        autocomplete="off"
                        class="w-full pl-4 pr-10 py-3 text-xs sm:text-sm rounded-xl border border-[var(--color-surface-200)] bg-[var(--color-surface-50)] text-[var(--color-surface-950)] focus:bg-white focus:outline-hidden focus:border-[var(--color-brand-500)] focus:ring-2 focus:ring-[var(--color-brand-100)] transition-all"
                    >
                    <button type="button"
                            onclick="document.getElementById('ai-user-input').value = 'Tolong jelaskan konsep ini dengan analogi sederhana.'; document.getElementById('ai-user-input').focus();"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-[oklch(0.60_0.01_265)] hover:text-[var(--color-brand-600)] text-xs cursor-pointer"
                            title="Sisipkan analogi">
                        💡
                    </button>
                </div>

                <button
                    type="submit"
                    id="ai-send-btn"
                    class="btn-brand py-3 px-5 text-xs sm:text-sm font-bold shrink-0 cursor-pointer shadow-sm">
                    <span>Kirim</span>
                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>
                </button>
            </form>
        </div>

    </div>

    @push('scripts')
    <script>
        let currentSubjectSlug = @json($selectedSubject ? $selectedSubject->slug : '');
        const chatApiUrl = @json(route('ai.chat'));
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        function changeSubjectContext(slug) {
            currentSubjectSlug = slug;
            const container = document.getElementById('ai-chat-thread');
            const alertDiv = document.createElement('div');
            alertDiv.className = 'flex justify-center my-2';
            alertDiv.innerHTML = `
                <div class="px-3 py-1 rounded-full text-[11px] font-semibold bg-[var(--color-brand-50)] text-[var(--color-brand-700)] border border-[var(--color-brand-200)]">
                    Konteks mata pelajaran diganti: ${slug ? slug.toUpperCase() : 'Semua Mapel SMK'}
                </div>
            `;
            container.appendChild(alertDiv);
            container.scrollTop = container.scrollHeight;
        }

        function sendSmartPrompt(promptText) {
            const input = document.getElementById('ai-user-input');
            if (input) {
                input.value = promptText;
                handleMainChatSubmit(new Event('submit'));
            }
        }

        async function handleMainChatSubmit(e) {
            e.preventDefault();
            const input = document.getElementById('ai-user-input');
            const sendBtn = document.getElementById('ai-send-btn');
            const text = input?.value.trim();
            if (!text) return;

            appendUserBubble(text);
            input.value = '';
            input.disabled = true;
            if (sendBtn) sendBtn.disabled = true;

            const typingId = showTypingBubble();

            try {
                const response = await fetch(chatApiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        message: text,
                        subject_slug: currentSubjectSlug,
                    })
                });

                const data = await response.json();
                removeTypingBubble(typingId);

                if (data.success && data.reply) {
                    appendTeacherBubble(data.reply);
                } else {
                    appendTeacherBubble('<p class="text-rose-600 font-semibold">Maaf nak, terjadi kendala saat memproses jawaban. Silakan tanyakan sekali lagi ya!</p>');
                }
            } catch (err) {
                removeTypingBubble(typingId);
                appendTeacherBubble('<p class="text-rose-600 font-semibold">Koneksi terputus. Pastikan kamu terhubung ke jaringan dan coba kembali.</p>');
            } finally {
                input.disabled = false;
                if (sendBtn) sendBtn.disabled = false;
                input.focus();
            }
        }

        function appendUserBubble(text) {
            const container = document.getElementById('ai-chat-thread');
            const msg = document.createElement('div');
            msg.className = 'flex items-start justify-end gap-2.5 animate-fade-in';
            msg.innerHTML = `
                <div class="bg-gradient-to-r from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white p-3.5 rounded-2xl rounded-tr-sm text-xs sm:text-sm max-w-lg shadow-2xs leading-relaxed">
                    <p>${escapeHtml(text)}</p>
                </div>
            `;
            container.appendChild(msg);
            container.scrollTop = container.scrollHeight;
        }

        function showTypingBubble() {
            const container = document.getElementById('ai-chat-thread');
            const id = 'typing-' + Date.now();
            const div = document.createElement('div');
            div.id = id;
            div.className = 'flex items-start gap-2.5 animate-fade-in';
            div.innerHTML = `
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 shadow-2xs">
                    AI
                </div>
                <div class="bg-white px-4 py-3 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] flex items-center gap-1.5 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-[var(--color-brand-500)] animate-bounce"></span>
                    <span class="w-2 h-2 rounded-full bg-[var(--color-brand-500)] animate-bounce [animation-delay:0.2s]"></span>
                    <span class="w-2 h-2 rounded-full bg-[var(--color-brand-500)] animate-bounce [animation-delay:0.4s]"></span>
                </div>
            `;
            container.appendChild(div);
            container.scrollTop = container.scrollHeight;
            return id;
        }

        function removeTypingBubble(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }

        function appendTeacherBubble(htmlContent) {
            const container = document.getElementById('ai-chat-thread');
            const msg = document.createElement('div');
            msg.className = 'flex items-start gap-3 max-w-2xl animate-fade-in';
            msg.innerHTML = `
                <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 shadow-2xs">
                    AI
                </div>
                <div class="bg-white p-4 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] text-xs sm:text-sm text-[var(--color-surface-900)] leading-relaxed space-y-2 shadow-2xs">
                    ${htmlContent}
                </div>
            `;
            container.appendChild(msg);
            container.scrollTop = container.scrollHeight;
        }

        function clearConversation() {
            const container = document.getElementById('ai-chat-thread');
            if (container) {
                container.innerHTML = `
                    <div class="flex items-start gap-3 max-w-2xl animate-fade-in">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5 shadow-2xs">
                            AI
                        </div>
                        <div class="bg-white p-4 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] text-xs sm:text-sm text-[var(--color-surface-900)] leading-relaxed space-y-2 shadow-2xs">
                            <p class="font-bold text-[var(--color-surface-950)] text-sm">Percakapan telah diatur ulang!</p>
                            <p class="text-[var(--color-surface-800)]">Ada materi atau konsep kejuruan apa lagi yang ingin kamu diskusikan dengan Bapak hari ini? Santai saja, kita bahas step-by-step!</p>
                        </div>
                    </div>
                `;
            }
        }

        function escapeHtml(str) {
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }
    </script>
    @endpush
</x-layouts.app>
