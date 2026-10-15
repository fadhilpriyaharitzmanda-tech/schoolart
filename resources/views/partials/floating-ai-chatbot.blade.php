{{-- ─── Floating AI Chatbot Widget (Scholart AI Tutor) ─── --}}
<div id="floating-ai-widget" class="fixed bottom-20 lg:bottom-6 right-4 sm:right-6 z-40">

    {{-- Floating Action Button (FAB) --}}
    <button
        type="button"
        id="floating-ai-fab"
        onclick="toggleAiChatbotModal()"
        class="group flex items-center gap-2.5 px-4 py-3 rounded-full bg-gradient-to-r from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white shadow-lg shadow-[var(--color-brand-500)]/30 hover:shadow-xl hover:shadow-[var(--color-brand-500)]/40 hover:scale-105 active:scale-95 transition-all duration-200 cursor-pointer border-2 border-white"
        aria-label="Tanya AI Guru SMK"
    >
        <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
        </span>
        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
        </svg>
        <span class="text-xs font-bold tracking-wide pr-0.5">Tanya AI Guru</span>
    </button>

    {{-- Interactive Floating Drawer / Modal --}}
    <div
        id="floating-ai-modal"
        class="hidden fixed inset-x-3 bottom-20 sm:bottom-6 sm:inset-x-auto sm:right-6 w-auto sm:w-[420px] max-w-full h-[540px] max-h-[80vh] rounded-3xl bg-white border border-[var(--color-surface-200)] shadow-2xl flex-col overflow-hidden z-50 animate-fade-in"
    >
        {{-- Header Bar --}}
        <div class="p-3.5 sm:p-4 bg-gradient-to-r from-white via-white to-[var(--color-brand-50)]/60 border-b border-[var(--color-surface-200)] flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="relative">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)] text-white flex items-center justify-center font-bold text-xs shadow-sm">
                        👨‍🏫
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                </div>
                <div>
                    <h3 class="text-xs sm:text-sm font-bold text-[var(--color-surface-950)] leading-tight">
                        Pak Guru AI SMK
                    </h3>
                    <p class="text-[10px] text-emerald-700 font-medium">● Online · Siap menjelaskan santai</p>
                </div>
            </div>

            <div class="flex items-center gap-1">
                <a href="{{ route('ai.index') }}"
                   class="p-1.5 rounded-lg text-[oklch(0.55_0.01_265)] hover:text-[var(--color-brand-600)] hover:bg-[var(--color-surface-100)] transition-colors"
                   title="Buka Halaman Penuh">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                    </svg>
                </a>
                <button
                    type="button"
                    onclick="toggleAiChatbotModal()"
                    class="p-1.5 rounded-lg text-[oklch(0.55_0.01_265)] hover:text-[var(--color-surface-950)] hover:bg-[var(--color-surface-100)] transition-colors cursor-pointer"
                    aria-label="Tutup"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- The 4 Smart Prompts Bar --}}
        <div class="px-3 py-2 bg-[var(--color-surface-50)] border-b border-[var(--color-surface-200)] flex items-center gap-1.5 overflow-x-auto scrollbar-none shrink-0">
            <button type="button"
                    onclick="sendFloatingPrompt('Tolong jelaskan konsep ini dengan analogi sederhana.')"
                    class="prompt-chip text-[11px] py-1 px-2.5 whitespace-nowrap bg-white">
                💡 Analogi Sederhana
            </button>
            <button type="button"
                    onclick="sendFloatingPrompt('Buatkan 3 soal latihan beserta kunci jawabannya.')"
                    class="prompt-chip text-[11px] py-1 px-2.5 whitespace-nowrap bg-white">
                📝 3 Soal & Kunci
            </button>
            <button type="button"
                    onclick="sendFloatingPrompt('Bagian apa yang paling sering keluar di ujian?')"
                    class="prompt-chip text-[11px] py-1 px-2.5 whitespace-nowrap bg-white">
                🎯 Kisi Ujian
            </button>
            <button type="button"
                    onclick="sendFloatingPrompt('Berikan contoh penerapan nyata di dunia kerja/industri.')"
                    class="prompt-chip text-[11px] py-1 px-2.5 whitespace-nowrap bg-white">
                💼 Kasus Industri
            </button>
        </div>

        {{-- Chat Messages Area --}}
        <div id="floating-chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3.5 bg-gradient-to-b from-white to-[var(--color-surface-50)]/40 text-xs">
            <div class="flex items-start gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-[var(--color-brand-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">
                    AI
                </div>
                <div class="bg-white p-3 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] text-[var(--color-surface-900)] leading-relaxed space-y-1.5 shadow-2xs">
                    <p class="font-bold text-[var(--color-surface-950)]">Halo murid hebat!</p>
                    <p class="text-[var(--color-surface-800)]">Bapak siap bantu jelaskan materi SMK yang sedang kamu pelajari dengan analogi mudah. Butuh bantuan apa?</p>
                </div>
            </div>
        </div>

        {{-- Chat Input Bar --}}
        <div class="p-2.5 bg-white border-t border-[var(--color-surface-200)] shrink-0">
            <form id="floating-ai-form" onsubmit="handleFloatingChatSubmit(event)" class="flex items-center gap-1.5">
                <input
                    type="text"
                    id="floating-ai-input"
                    placeholder="Tanya Bapak guru..."
                    autocomplete="off"
                    class="flex-1 px-3 py-2 text-xs rounded-xl border border-[var(--color-surface-200)] bg-[var(--color-surface-50)] text-[var(--color-surface-950)] focus:bg-white focus:outline-hidden focus:border-[var(--color-brand-500)] focus:ring-1 focus:ring-[var(--color-brand-200)]"
                >
                <button
                    type="submit"
                    id="floating-ai-btn"
                    class="btn-brand py-2 px-3 text-xs font-bold shrink-0 cursor-pointer shadow-none">
                    Kirim
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleAiChatbotModal() {
        const modal = document.getElementById('floating-ai-modal');
        const fab = document.getElementById('floating-ai-fab');
        if (modal) {
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                fab?.classList.add('opacity-0', 'pointer-events-none');
                setTimeout(() => document.getElementById('floating-ai-input')?.focus(), 100);
            } else {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                fab?.classList.remove('opacity-0', 'pointer-events-none');
            }
        }
    }

    function sendFloatingPrompt(text) {
        const input = document.getElementById('floating-ai-input');
        if (input) {
            input.value = text;
            handleFloatingChatSubmit(new Event('submit'));
        }
    }

    async function handleFloatingChatSubmit(e) {
        e.preventDefault();
        const input = document.getElementById('floating-ai-input');
        const btn = document.getElementById('floating-ai-btn');
        const text = input?.value.trim();
        if (!text) return;

        appendFloatingUserMsg(text);
        input.value = '';
        input.disabled = true;
        if (btn) btn.disabled = true;

        const typingId = showFloatingTyping();

        try {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const res = await fetch("{{ route('ai.chat') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message: text })
            });

            const data = await res.json();
            removeFloatingTyping(typingId);

            if (data.success && data.reply) {
                appendFloatingAiMsg(data.reply);
            } else {
                appendFloatingAiMsg('<p class="text-rose-600">Maaf, ada kendala koneksi. Coba lagi ya!</p>');
            }
        } catch (err) {
            removeFloatingTyping(typingId);
            appendFloatingAiMsg('<p class="text-rose-600">Gagal menghubungkan ke AI Tutor.</p>');
        } finally {
            input.disabled = false;
            if (btn) btn.disabled = false;
            input.focus();
        }
    }

    function appendFloatingUserMsg(text) {
        const c = document.getElementById('floating-chat-messages');
        const d = document.createElement('div');
        d.className = 'flex items-start justify-end gap-2';
        d.innerHTML = `
            <div class="bg-[var(--color-brand-600)] text-white p-2.5 rounded-2xl rounded-tr-sm text-xs max-w-[85%] leading-relaxed shadow-2xs">
                ${escapeHtmlChat(text)}
            </div>
        `;
        c.appendChild(d);
        c.scrollTop = c.scrollHeight;
    }

    function showFloatingTyping() {
        const c = document.getElementById('floating-chat-messages');
        const id = 'fl-typing-' + Date.now();
        const d = document.createElement('div');
        d.id = id;
        d.className = 'flex items-start gap-2';
        d.innerHTML = `
            <div class="w-7 h-7 rounded-lg bg-[var(--color-brand-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">AI</div>
            <div class="bg-white px-3 py-2 rounded-xl border border-[var(--color-surface-200)] flex items-center gap-1">
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-400)] animate-bounce"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-400)] animate-bounce [animation-delay:0.2s]"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-brand-400)] animate-bounce [animation-delay:0.4s]"></span>
            </div>
        `;
        c.appendChild(d);
        c.scrollTop = c.scrollHeight;
        return id;
    }

    function removeFloatingTyping(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }

    function appendFloatingAiMsg(html) {
        const c = document.getElementById('floating-chat-messages');
        const d = document.createElement('div');
        d.className = 'flex items-start gap-2.5';
        d.innerHTML = `
            <div class="w-7 h-7 rounded-lg bg-[var(--color-brand-600)] text-white flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">AI</div>
            <div class="bg-white p-3 rounded-2xl rounded-tl-sm border border-[var(--color-surface-200)] text-xs text-[var(--color-surface-900)] leading-relaxed space-y-2 max-w-[90%] shadow-2xs">
                ${html}
            </div>
        `;
        c.appendChild(d);
        c.scrollTop = c.scrollHeight;
    }

    function escapeHtmlChat(str) {
        return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }
</script>
