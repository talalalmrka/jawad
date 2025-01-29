<x-dashboard-layout>
    <x-slot name="header">{{ __('Posts') }}</x-slot>
    <div class="container py-5">
        <x-status />

        <div class="card" x-data="{ selectAll: false, selectedItems: [], actionsEnabled() { return this.selectedItems.length } }">
            <form method="post" action="{{ route('dashboard.posts.action') }}">
                @csrf
                <div class="flex-space-2 mb-3 p-2">
                    <a class="btn sm green gradient" href="{{ route('dashboard.posts.create') }}">{{ __('Create') }}</a>
                    <button name="action" value="delete" class="btn sm red gradient"
                        x-bind:disabled="!actionsEnabled()">{{ __('Delete') }}
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>
                                    <input type="checkbox" x-model="selectAll"
                                        x-on:change="selectedItems = selectAll ? {{ $posts->pluck('id') }} : []">
                                </td>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Author') }}</td>
                                <td>{{ __('Name') }}</td>
                                <td>{{ __('Slug') }}</td>
                                <td>{{ __('Creation date') }}</td>
                                <td>{{ __('Actions') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="items[]" value="{{ $post->id }}"
                                            x-model="selectedItems">
                                    </td>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->user?->name }}</td>
                                    <td>{{ $post->name }}</td>
                                    <td>{{ $post->slug }}</td>
                                    <td>{{ $post->created_at->format('M, d Y') }}</td>
                                    <td>
                                        <div class="flex-space-2 justify-center">
                                            <a href="{{ route('dashboard.posts.edit', $post) }}"
                                                class="btn sm primary gradient">{{ __('Edit') }}</a>
                                            <a href="{{ route('dashboard.posts.delete', $post) }}"
                                                class="btn sm red gradient">{{ __('Delete') }}</a>
                                            <a href="{{ route('site.post', $post) }}" class="btn sm green gradient"
                                                target="_blank">{{ __('Show') }}</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
            @if ($posts->isNotEmpty())
                <div class="p-3">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
