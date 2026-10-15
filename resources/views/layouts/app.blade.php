@props([
    'title' => null,
    'description' => null,
    'fullWidth' => false,
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . ' — Scholart' : 'Scholart · AI Learning Platform' }}</title>
    <meta name="description" content="{{ $description ?? 'Scholart adalah platform belajar cerdas berbasis AI yang membantu siswa belajar lebih efektif dengan tutor AI, jadwal personal, dan analitik progres belajar.' }}">

    <!-- Favicon placeholder -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎓</text></svg>">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full antialiased">

    {{-- ─── App Shell ─── --}}
    <div class="flex h-full min-h-screen" id="app-shell">

        {{-- Desktop Sidebar --}}
        @include('partials.sidebar')

        {{-- Mobile Sidebar Overlay --}}
        <div
            id="sidebar-overlay"
            class="fixed inset-0 bg-black/40 z-40 hidden lg:hidden backdrop-blur-sm"
            onclick="closeSidebar()"
        ></div>

        {{-- Main Content Area --}}
        <div class="flex flex-col flex-1 min-w-0 lg:ml-64">

            {{-- Top Navigation --}}
            @include('partials.top-nav')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto pb-20 lg:pb-8">
                <div class="{{ $fullWidth ? 'w-full px-4 sm:px-6 lg:px-8 py-5' : 'mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6' }}">
                    {{ $slot }}
                </div>
            </main>

        </div>

    </div>

    {{-- Mobile Bottom Navigation --}}
    @include('partials.bottom-nav')

    {{-- Floating AI Chatbot Widget (Tahap 4) --}}
    @include('partials.floating-ai-chatbot')

    @stack('scripts')

    <script>
        // ─── Mobile Sidebar Toggle ───
        function openSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar?.classList.remove('-translate-x-full');
            overlay?.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar?.classList.add('-translate-x-full');
            overlay?.classList.add('hidden');
            document.body.style.overflow = '';
        }

        // ─── Animate elements on scroll ───
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.1, rootMargin: '0px 0px -20px 0px' }
        );
        document.querySelectorAll('[data-animate]').forEach(el => observer.observe(el));
    </script>
</body>
</html>
