{{-- Custom 404 error page. --}}
@extends('layouts.app')

{{-- Shared error page: picks a title/message based on the HTTP status code so one view covers 403/404/419/500 --}}
@php
    $status = $exception->getStatusCode();

    $errors = [
        403 => [
            'title' => 'Access Forbidden',
            'message' => 'You do not have permission to access this page.',
        ],
        404 => [
            'title' => 'Page Not Found',
            'message' => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.',
        ],
        419 => [
            'title' => 'Session Expired',
            'message' => 'Your session has expired. Please refresh the page and try again.',
        ],
        500 => [
            'title' => 'Server Error',
            'message' => 'Something went wrong on our side. Please try again later.',
        ],
    ];

    $data = $errors[$status] ?? [
        'title' => 'Unexpected Error',
        'message' => 'An unexpected error occurred.',
    ];
@endphp

@section('title', "{$status} {$data['title']}")

@section('content')
<section class="min-h-screen flex items-center justify-center bg-app-bg py-32">
    <div class="text-center px-6">

        {{-- ERROR CODE --}}
        <h1 class="text-[10rem] md:text-[14rem] font-extrabold
                   leading-none tracking-tight
                   text-indigo-500/90 select-none">
            {{ $status }}
        </h1>

        {{-- TITLE --}}
        <p class="mt-6 text-3xl md:text-4xl font-semibold text-app-text">
            {{ $data['title'] }}
        </p>

        {{-- MESSAGE --}}
        <p class="mt-4 max-w-xl mx-auto text-base md:text-lg text-app-muted">
            {{ $data['message'] }}
        </p>

        {{-- ACTIONS --}}
        <div class="mt-10 flex justify-center gap-4 flex-wrap">
            <a href="{{ route('home') }}"
               class="rounded-2xl bg-indigo-500 px-10 py-3.5
                      font-semibold text-white
                      hover:bg-indigo-600 transition">
                Return Home
            </a>

            <a href="{{ route('contact') }}"
               class="rounded-2xl border border-card-border
                      px-10 py-3.5 font-semibold
                      text-app-text hover:bg-white/5 transition">
                Contact Support
            </a>
        </div>

    </div>
</section>
@endsection
