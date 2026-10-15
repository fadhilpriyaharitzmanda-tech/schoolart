{{-- ─── Desktop Sidebar (hidden on mobile, shown as slide-in) ─── --}}

{{-- Desktop Fixed Sidebar --}}
<aside class="hidden lg:flex lg:flex-col lg:fixed lg:inset-y-0 lg:left-0 lg:w-64 lg:z-30
              bg-white border-r border-[var(--color-surface-200)]">
    @include('partials.sidebar-inner')
</aside>

{{-- Mobile Slide-in Sidebar --}}
<aside
    id="mobile-sidebar"
    class="lg:hidden fixed inset-y-0 left-0 z-50 w-72
           bg-white border-r border-[var(--color-surface-200)]
           transform -translate-x-full transition-transform duration-300 ease-out
           flex flex-col shadow-2xl"
>
    @include('partials.sidebar-inner')
</aside>
