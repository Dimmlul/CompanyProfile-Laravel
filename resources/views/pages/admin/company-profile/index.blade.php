{{-- Admin page for editing the single company profile record shown on public pages. --}}

@extends('layouts.admin')

@section('title', 'Company Profile')

@section('content')
{{-- Warn the admin if fields the public homepage depends on are still empty. --}}
@if ($missingHomepageFields->isNotEmpty())
    <x-admin.notice type="warning" class="mb-6">
        The homepage is missing: <strong>{{ $missingHomepageFields->implode(', ') }}</strong>.
        These sections will show placeholder text or look empty until you fill them in below.
    </x-admin.notice>
@endif

<x-common.component-card
    title="Company Profile"
    desc="Manage your company information shown on public pages"
    class="admin-card"
>
    <x-admin.company-profile.form
        :companyProfile="$companyProfile"
    />
</x-common.component-card>
@endsection
