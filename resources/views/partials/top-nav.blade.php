{{-- ─── Top Navigation Bar ─── --}}
<header class="sticky top-0 z-20 glass border-b border-[var(--color-surface-200)] h-14 flex items-center px-4 sm:px-6 gap-3">

    {{-- Hamburger (mobile) --}}
    <button
        class="lg:hidden p-2 rounded-[var(--radius-md)] hover:bg-[var(--color-surface-100)] text-[oklch(0.55_0.01_265)] transition-colors"
        onclick="openSidebar()"
        aria-label="Buka menu navigasi"
        id="sidebar-toggle-btn"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
    </button>

    {{-- Page Title (injected by pages) --}}
    <div class="flex-1 min-w-0">
        <h1 class="text-sm font-semibold text-[var(--color-surface-950)] truncate lg:hidden">
            {{ $pageTitle ?? 'Dashboard' }}
        </h1>
        {{-- Desktop: Breadcrumb / Search area --}}
        <div class="hidden lg:flex items-center gap-2">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-[oklch(0.6_0.01_265)]" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                </svg>
                <input
                    type="search"
                    id="global-search"
                    placeholder="Cari materi, jadwal, atau tanya AI..."
                    class="pl-9 pr-4 py-1.5 text-sm bg-[var(--color-surface-100)] border border-[var(--color-surface-200)]
                           rounded-[var(--radius-lg)] w-72 text-[var(--color-surface-950)] placeholder:text-[oklch(0.6_0.01_265)]
                           focus:outline-none focus:ring-2 focus:ring-[var(--color-brand-300)] focus:border-transparent
                           transition-all duration-200 focus:w-96"
                >
            </div>
        </div>
    </div>

    {{-- Right Actions --}}
    <div class="flex items-center gap-2">

        {{-- AI Quick Action Button --}}
        <button type="button" onclick="toggleAiChatbotModal()" class="btn-brand py-1.5 px-3 text-xs hidden sm:inline-flex cursor-pointer" id="ai-tutor-quick-btn">
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
            </svg>
            Tanya AI
        </button>
=
        {{-- Notification Bell --}}
        <button class="relative p-2 rounded-[var(--radius-md)] hover:bg-[var(--color-surface-100)] text-[oklch(0.55_0.01_265)] transition-colors" id="notif-btn" aria-label="Notifikasi">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
            {{-- Notification dot --}}
            <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-[var(--color-brand-500)] border-2 border-white"></span>
        </button>

        {{-- User Avatar (mobile) --}}
        <button class="lg:hidden w-8 h-8 rounded-full bg-gradient-to-br from-[var(--color-brand-400)] to-[var(--color-accent-500)] flex items-center justify-center text-white text-xs font-bold shadow-sm" id="user-avatar-btn" aria-label="Profil pengguna">
            S
        </button>

    </div>
</header>
