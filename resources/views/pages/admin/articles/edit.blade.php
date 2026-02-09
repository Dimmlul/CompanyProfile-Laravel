@extends('layouts.admin')

@section('title','Edit Article')

@section('content')
<x-common.component-card title="Edit Article">
    <x-admin.article.form
        :article="$article"
        :action="route('admin.articles.update',$article)"
        method="PUT"
    />
</x-common.component-card>
@endsection
