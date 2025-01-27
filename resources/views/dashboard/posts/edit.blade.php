<x-dashboard-layout>
    <x-slot name="header">
        {{ !empty($post->id)
            ? __('Edit post ":name"', [
                'name' => $post->name,
            ])
            : __('Create post') }}
    </x-slot>
    <div class="container py-5">
        <div class="flex-space-2 mb-3">
            <a class="btn sm blue gradient" href="{{ route('dashboard.posts') }}">{{ __('View all') }}</a>
            @if (!empty($post->id))
                <a class="btn sm green gradient" href="{{ route('dashboard.posts.create') }}">{{ __('Create') }}</a>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <x-status />
                <form
                    action="{{ !empty($post->id) ? route('dashboard.posts.update', $post) : route('dashboard.posts.store') }}"
                    method="post">
                    @csrf
                    <div class="grid grid-cols-1 gap-3">
                        <div class="col">
                            <x-form.input id="name" name="name" :label="__('Name')" :value="old('name', $post->name)" />
                        </div>
                        <div class="col">
                            <x-form.select-user id="user_id" name="user_id" :label="__('Author')" :value="old('user_id', $post->user_id)" />
                        </div>
                        <div class="col">
                            <x-form.input id="slug" name="slug" :label="__('Slug')" :value="old('slug', $post->slug)" />
                        </div>
                        <div class="col">
                            <x-form.textarea id="description" name="description" rows="2" :label="__('Description')"
                                :value="old('description', $post->description)" />
                        </div>
                        <div class="col">
                            <x-form.textarea id="content" name="content" rows="7" :label="__('Content')"
                                :value="old('content', $post->content)" />
                        </div>
                        <div class="col md:colspan-2">
                            <button type="submit" name="save" class="btn primary gradient">
                                {{ !empty($post->id) ? __('Update') : __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-dashboard-layout>
