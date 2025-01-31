<x-app-layout>
    <div class="min-h-screen">
        <livewire:layout.site-navigation />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        @include('partials.footer')
    </div>
</x-app-layout>
