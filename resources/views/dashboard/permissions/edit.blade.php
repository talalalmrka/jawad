<x-dashboard-layout>
    <x-slot name="header">
        {{ !empty($permission->id)
            ? __('Edit permission ":name"', [
                'name' => $permission->name,
            ])
            : __('Create permission') }}
    </x-slot>
    <div class="container py-5">
        <div class="flex-space-2 mb-3">
            <a class="btn sm blue gradient" href="{{ route('dashboard.permissions') }}">{{ __('View all') }}</a>
            @if (!empty($permission->id))
                <a class="btn sm green gradient"
                    href="{{ route('dashboard.permissions.create') }}">{{ __('Create') }}</a>
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <x-status />
                <form
                    action="{{ !empty($permission->id) ? route('dashboard.permissions.update', $permission) : route('dashboard.permissions.store') }}"
                    method="permission">
                    @csrf
                    <div class="grid grid-cols-1 gap-3">
                        <div class="col">
                            <x-form.input id="name" name="name" :label="__('Name')" :value="old('name', $permission->name)" />
                        </div>
                        <div class="col">
                            <x-form.select id="guard_name" name="guard_name" :label="__('Guard name')" :value="old('guard_name', $permission->guard_name)"
                                :options="guard_name_options()" />
                        </div>
                        <div class="col md:colspan-2">
                            <button type="submit" name="save" class="btn primary gradient">
                                {{ !empty($permission->id) ? __('Update') : __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-dashboard-layout>
