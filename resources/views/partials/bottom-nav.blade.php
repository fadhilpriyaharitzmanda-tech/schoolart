{{-- ─── Mobile Bottom Navigation ─── --}}
<nav class="lg:hidden fixed bottom-0 inset-x-0 z-30 glass border-t border-[var(--color-surface-200)] safe-area-bottom"
     role="navigation" aria-label="Navigasi utama">

    {{-- Strict 5-Column Grid ensures dead-center alignment on all mobile devices --}}
    <div class="grid grid-cols-5 items-center h-16 max-w-lg mx-auto px-1">

        {{-- 1. Dashboard --}}
        <div class="flex justify-center items-center">
            <a href="{{ route('dashboard') }}"
               id="bottom-nav-dashboard"
               class="flex flex-col items-center gap-1 py-1.5 px-2 rounded-xl transition-all duration-200
                      {{ request()->routeIs('dashboard') ? 'text-[var(--color-brand-600)]' : 'text-[oklch(0.55_0.01_265)] hover:text-[var(--color-surface-950)]' }}"
               aria-label="Dashboard">
                <div class="relative">
                    <svg class="w-5.5 h-5.5" fill="{{ request()->routeIs('dashboard') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>
                    @if(request()->routeIs('dashboard'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-[var(--color-brand-500)]"></span>
                    @endif
                </div>
                <span class="text-[10px] font-medium leading-none">Beranda</span>
            </a>
        </div>

        {{-- 2. Jadwal --}}
        <div class="flex justify-center items-center">
            <a href="{{ route('jadwal.index') }}"
               id="bottom-nav-schedule"
               class="flex flex-col items-center gap-1 py-1.5 px-2 rounded-xl transition-all duration-200
                      {{ request()->routeIs('jadwal.*') ? 'text-[var(--color-brand-600)]' : 'text-[oklch(0.55_0.01_265)] hover:text-[var(--color-surface-950)]' }}"
               aria-label="Jadwal Belajar">
                <div class="relative">
                    <svg class="w-5.5 h-5.5" fill="{{ request()->routeIs('jadwal.*') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    @if(request()->routeIs('jadwal.*'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-[var(--color-brand-500)]"></span>
                    @endif
                </div>
                <span class="text-[10px] font-medium leading-none">Jadwal</span>
            </a>
        </div>

        {{-- 3. AI Tutor (Exact Mathematical Center of 5 columns) --}}
        <div class="flex justify-center items-center">
            <a href="{{ route('ai.index') }}"
               id="bottom-nav-ai"
               class="flex flex-col items-center -mt-5 group"
               aria-label="AI Tutor">
                <div class="w-13 h-13 rounded-2xl bg-gradient-to-br from-[var(--color-brand-600)] to-[var(--color-accent-600)]
                            flex items-center justify-center shadow-lg shadow-[var(--color-brand-500)]/30
                            transition-all duration-200 group-hover:scale-105 group-active:scale-95 border-2 border-white">
                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z" />
                    </svg>
                </div>
                <span class="text-[10px] font-bold text-[var(--color-brand-600)] leading-none mt-1">AI Tutor</span>
            </a>
        </div>

        {{-- 4. Materi --}}
        <div class="flex justify-center items-center">
            <a href="{{ route('kurikulum.index') }}"
               id="bottom-nav-materi"
               class="flex flex-col items-center gap-1 py-1.5 px-2 rounded-xl transition-all duration-200
                      {{ request()->routeIs('kurikulum.*') ? 'text-[var(--color-brand-600)]' : 'text-[oklch(0.55_0.01_265)] hover:text-[var(--color-surface-950)]' }}"
               aria-label="Materi Belajar">
                <div class="relative">
                    <svg class="w-5.5 h-5.5" fill="{{ request()->routeIs('kurikulum.*') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                    @if(request()->routeIs('kurikulum.*'))
                        <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-[var(--color-brand-500)]"></span>
                    @endif
                </div>
                <span class="text-[10px] font-medium leading-none">Materi</span>
            </a>
        </div>

        {{-- 5. Profil --}}
        <div class="flex justify-center items-center">
            <a href="#"
               id="bottom-nav-profile"
               class="flex flex-col items-center gap-1 py-1.5 px-2 rounded-xl transition-all duration-200 text-[oklch(0.55_0.01_265)] hover:text-[var(--color-surface-950)]"
               aria-label="Profil Pengguna">
                <svg class="w-5.5 h-5.5" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
                <span class="text-[10px] font-medium leading-none">Profil</span>
            </a>
        </div>

    </div>
</nav>
