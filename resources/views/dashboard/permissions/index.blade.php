<x-dashboard-layout>
    <x-slot name="header">{{ __('Permissions') }}</x-slot>
    <div class="container py-5">
        <x-status />
        <div class="card" x-data="{ selectAll: false, selectedItems: [], actionsEnabled() { return this.selectedItems.length } }">
            <form method="post" action="{{ route('dashboard.permissions.action') }}">
                @csrf
                <div class="flex-space-2 mb-3 p-2">
                    <a class="btn sm green gradient"
                        href="{{ route('dashboard.permissions.create') }}">{{ __('Create') }}</a>
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
                                        x-on:change="selectedItems = selectAll ? {{ $permissions->pluck('id') }} : []">
                                </td>
                                <td>{{ __('ID') }}</td>
                                <td>{{ __('Name') }}</td>
                                <td>{{ __('Guard name') }}</td>
                                <td>{{ __('Creation date') }}</td>
                                <td>{{ __('Actions') }}</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="items[]" value="{{ $permission->id }}"
                                            x-model="selectedItems">
                                    </td>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->guard_name }}</td>
                                    <td>{{ $permission->created_at->format('M, d Y') }}</td>
                                    <td>
                                        <div class="flex-space-2 justify-center">
                                            <a href="{{ route('dashboard.permissions.edit', $permission) }}"
                                                class="btn sm primary gradient">{{ __('Edit') }}</a>
                                            <a href="{{ route('dashboard.permissions.delete', $permission) }}"
                                                class="btn sm red gradient">{{ __('Delete') }}</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </form>
            @if ($permissions->isNotEmpty())
                <div class="p-3">
                    {{ $permissions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>
