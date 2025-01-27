<x-dashboard-layout>
    <x-slot name="header">{{ __('Users') }}</x-slot>
    <div class="container py-5">
        <x-status />
        <div class="card">
            <div class="flex-space-2 mb-3 p-2">
                <a class="btn sm green gradient" href="{{ route('dashboard.users.create') }}">{{ __('Create') }}</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>{{ __('ID') }}</td>
                            <td>{{ __('Name') }}</td>
                            <td>{{ __('Email') }}</td>
                            <td>{{ __('Actions') }}</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="flex-space-2 justify-center">
                                        <a href="{{ route('dashboard.users.edit', $user) }}"
                                            class="btn sm green gradient">{{ __('Edit') }}</a>
                                        <a href="{{ route('dashboard.users.delete', $user) }}"
                                            class="btn sm red gradient">{{ __('Delete') }}</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($users->isNotEmpty())
                {{ $users->links() }}
            @endif
        </div>

    </div>
</x-dashboard-layout>
