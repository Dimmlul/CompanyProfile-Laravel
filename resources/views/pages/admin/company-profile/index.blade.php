<!-- resources/views/pages/admin/company-profile/index.blade.php -->

@extends('layouts.admin')

@section('title', 'Company Profile')

@section('content')
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
