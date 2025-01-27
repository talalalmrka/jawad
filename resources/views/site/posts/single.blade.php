<x-site-layout>
    <x-slot name="header">{{ $post->name }}</x-slot>
    <div class="container py-5">
        <div class="relative overflow-hidden w-full max-h-96">
            <img class="object-cover w-full h-full" src="https://placehold.co/600?text={{ $post->name }}" />
        </div>
        <div class="mt-3">
            {{ $post->content }}
        </div>
    </div>
    @auth
        <a class="fixed bottom-5 start-5 btn primary gradient" target="_blank"
            href="{{ route('dashboard.posts.edit', $post) }}">
            {{ __('Edit') }}
        </a>
    @endauth
</x-site-layout>
