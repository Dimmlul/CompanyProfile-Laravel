<!-- resources/views/pages/admin/articles/create.blade.php -->

@extends('layouts.admin')

@section('title', 'Create Article')

@section('content')

<x-common.component-card title="Create Article">

    <x-admin.article.form
        :action="route('admin.articles.store')"
    />

</x-common.component-card>

@endsection
