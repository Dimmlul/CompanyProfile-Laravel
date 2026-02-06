<!-- resources/views/pages/admin/clients/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Create Client')

@section('content')

    <x-common.component-card title="Create Client">

        <form method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-5">

                <!-- Name -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Client Name
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                </div>

                <!-- Logo -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Logo
                    </label>
                    <input type="file" name="logo"
                        class="block w-full text-sm
                      file:rounded-lg file:bg-btn-primary
                      file:px-4 file:py-2 file:text-btn-text
                      hover:file:bg-btn-primary-hover">
                </div>

                <!-- Website -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Website
                    </label>
                    <input type="url" name="website" value="{{ old('website') }}"
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                </div>

                <!-- Description -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Description
                    </label>
                    <textarea name="description" rows="3"
                        class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                         border border-gray-300 bg-transparent px-4 py-3 text-sm
                         dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
        {{ old('description') }}</textarea>
                </div>

                <!-- Order -->
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Order
                    </label>
                    <input type="number" name="order" value="{{ old('order', 0) }}"
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                      border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                      dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">
                </div>

                <!-- Status -->
                <div>
                    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Status
                    </label>

                    <div class="flex gap-6 text-sm">
                        <label class="flex items-center gap-2">
                            <input type="radio" name="is_active" value="1" checked>
                            Active
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="radio" name="is_active" value="0">
                            Inactive
                        </label>
                    </div>
                </div>

                <button
                    class="rounded-lg bg-btn-primary px-5 py-2.5
                   text-sm font-medium text-btn-text
                   hover:bg-btn-primary-hover">
                    Save Client
                </button>

            </div>
        </form>

    </x-common.component-card>

@endsection
