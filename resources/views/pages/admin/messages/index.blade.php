@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="space-y-6">

    <h1 class="text-xl font-semibold">Inbox Messages</h1>

    <div class="client-card overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-white/5 text-app-muted">
                <tr>
                    <th class="px-4 py-3 text-left">From</th>
                    <th class="px-4 py-3 text-left">Subject</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr class="border-t border-white/10 hover:bg-white/5">
                        <td class="px-4 py-3">
                            {{ $message->name }}<br>
                            <span class="text-xs text-app-muted">
                                {{ $message->email }}
                            </span>
                        </td>

                        <td class="px-4 py-3">
                            <a href="{{ route('admin.messages.show', $message) }}"
                               class="text-indigo-400 hover:underline">
                                {{ $message->subject ?? '(No subject)' }}
                            </a>
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if ($message->is_read)
                                <span class="text-xs text-green-400">Read</span>
                            @else
                                <span class="text-xs text-yellow-400">Unread</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center text-xs text-app-muted">
                            {{ $message->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-app-muted">
                            No messages
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $messages->links() }}
</div>
@endsection
