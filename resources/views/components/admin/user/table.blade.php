@props(['users'])

<div class="overflow-x-auto">

    <table class="admin-table">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
                <th class="text-right">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>

                    {{-- NAME --}}
                    <td class="font-medium text-app-heading">
                        {{ $user->name }}
                    </td>

                    {{-- EMAIL --}}
                    <td class="text-app-muted text-sm">
                        {{ $user->email }}
                    </td>

                    {{-- ROLE --}}
                    <td>
                        @if ($user->role === 'admin')
                            <span class="badge badge-success">
                                Admin
                            </span>
                        @else
                            <span class="badge badge-muted">
                                User
                            </span>
                        @endif
                    </td>

                    {{-- CREATED --}}
                    <td class="text-app-muted">
                        {{ $user->created_at->format('d M Y') }}
                    </td>

                    {{-- ACTION --}}
                    <td class="text-right">
                        <div class="inline-flex gap-2">

                            <a
                                href="{{ route('admin.users.edit', $user) }}"
                                class="btn-admin"
                            >
                                Edit
                            </a>

                            <form
                                method="POST"
                                action="{{ route('admin.users.destroy', $user) }}"
                                onsubmit="return confirm('Delete this user?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button class="btn-danger">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="5" class="admin-table-empty">
                        No users found
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>
