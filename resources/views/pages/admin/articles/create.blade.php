{{-- Admin page for creating a new article; reuses the shared article form component. --}}

@extends('layouts.admin')

@section('title', 'Create Article')

@section('content')

<x-common.component-card title="Create Article">

    <x-admin.article.form
        :action="route('admin.articles.store')"
    />

</x-common.component-card>

@endsection
