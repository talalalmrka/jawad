<x-site-layout>
    <x-slot name="header">{{ __('Blog') }}</x-slot>
    <div class="container py-5">
        @if ($posts->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach ($posts as $post)
                    <div class="col">
                        <div class="card">
                            <div class="relative overflow-hidden">
                                <img class="object-cover" src="https://placehold.co/600?text={{ $post->name }}" />
                            </div>
                            <h5 class="card-title truncate text-center">
                                <a class="truncate text-center" href="{{ route('site.post', $post) }}">
                                    {{ $post->name }}
                                </a>
                            </h5>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-3">
                {{ $posts->links() }}
            </div>
        @else
            <x-alert :message="__('No posts found!')" />
        @endif
    </div>
</x-site-layout>
