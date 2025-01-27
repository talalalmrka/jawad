<x-dashboard-layout>
    <x-slot
        name="header">{{ !empty($user->id)
            ? __('Edit user ":name"', [
                'name' => $user->name,
            ])
            : __('Create user') }}</x-slot>
    <div class="container py-5">
        <div class="flex-space-2 mb-3">
            <a class="btn sm blue gradient" href="{{ route('dashboard.users') }}">{{ __('View all') }}</a>
            @if (!empty($user->id))
                <a class="btn sm green gradient" href="{{ route('dashboard.users.create') }}">{{ __('Create') }}</a>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <form
                    action="{{ !empty($user->id) ? route('dashboard.users.update', $user) : route('dashboard.users.store') }}"
                    method="post">
                    @csrf
                    <div class="grid grid-cols-1 gap-3">
                        <div class="col">
                            <x-form.input id="name" name="name" :label="__('Username')" :value="old('name', $user->name)" />
                        </div>
                        <div class="col">
                            <x-form.input id="email" name="email" :label="__('Email')" :value="old('email', $user->email)" />
                        </div>
                        @if (empty($user->id))
                            <div class="col">
                                <x-form.input id="password" name="password" :label="__('password')" :value="old('password', '')" />
                            </div>
                        @endif
                        <div class="col md:colspan-2">
                            <button type="submit" name="save" class="btn primary gradient">
                                {{ !empty($user->id) ? __('Update') : __('Create') }}
                            </button>
                            <x-status class="mt-3" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-dashboard-layout>
