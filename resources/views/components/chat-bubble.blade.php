@props([
    'own' => false,
    'name',
    'time',
    'message' => null,
    'attachment' => null,
    'attachmentType' => null,
])

{{-- Reusable chat bubble. $own = current side (brand); otherwise neutral. --}}
<div class="flex {{ $own ? 'justify-end' : 'justify-start' }}">
    <div @class([
        'max-w-[78%] rounded-2xl px-4 py-3',
        'bg-brand-main' => $own,
        'bg-app-surface-2' => ! $own,
    ])>
        <p @class([
            'mb-1 text-[11px]',
            'text-right text-indigo-100' => $own,
            'text-app-muted' => ! $own,
        ])>{{ $name }} &bull; {{ $time }}</p>

        @if (filled($message) && $message !== '[Attachment]')
            <p @class([
                'whitespace-pre-line text-sm leading-relaxed',
                'text-white' => $own,
                'text-app-heading' => ! $own,
            ])>{{ $message }}</p>
        @endif

        @if ($attachment)
            <div class="mt-2">
                @if ($attachmentType === 'image')
                    <a href="{{ asset('storage/'.$attachment) }}" target="_blank" rel="noopener">
                        <img src="{{ asset('storage/'.$attachment) }}" alt="attachment"
                             class="max-w-[220px] rounded-lg transition hover:opacity-90">
                    </a>
                @else
                    <a href="{{ asset('storage/'.$attachment) }}" target="_blank" rel="noopener"
                       @class(['inline-flex items-center gap-1.5 text-sm underline', 'text-white' => $own, 'text-brand-accent' => ! $own])>
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.7" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v12m0 0l-4-4m4 4l4-4M4 20h16"/>
                        </svg>
                        Download file
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
