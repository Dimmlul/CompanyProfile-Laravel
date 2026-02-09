@extends('layouts.admin')

@section('title', 'Add Gallery')

@section('content')
<x-common.component-card title="Add Gallery">

<form method="POST"
      action="{{ route('admin.gallery.store') }}"
      enctype="multipart/form-data">
@csrf

<div class="grid gap-5">

    <x-common.form.input label="Title" name="title" />

    <x-common.form.textarea label="Caption" name="caption" rows="3" />

    <x-common.form.input label="Category" name="category" />

    <x-common.form.input label="Image" name="image" type="file" />

    <div>
        <label class="text-sm font-medium">Status</label>
        <div class="flex gap-6 text-sm">
            <label><input type="radio" name="is_active" value="1" checked> Active</label>
            <label><input type="radio" name="is_active" value="0"> Inactive</label>
        </div>
    </div>

    <button class="btn-primary">
        Save Image
    </button>

</div>
</form>

</x-common.component-card>
@endsection
