@if ($msg->attachment)
    @if ($msg->attachment_type === 'image')
        <img src="{{ asset('storage/'.$msg->attachment) }}"
             class="mt-2 rounded-lg max-w-xs">
    @else
        <a href="{{ asset('storage/'.$msg->attachment) }}"
           class="mt-2 inline-block text-indigo-400 underline">
            Download file
        </a>
    @endif
@endif
