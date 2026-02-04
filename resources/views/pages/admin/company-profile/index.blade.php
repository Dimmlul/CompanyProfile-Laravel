@extends('layouts.admin')

@section('title', 'Company Profile')

@section('content')

<x-common.component-card title="Company Profile">

    <form
        method="POST"
        action="{{ route('admin.company-profile.store') }}"
        enctype="multipart/form-data"
    >
        @csrf

        <div class="grid grid-cols-1 gap-5">

            {{-- COMPANY LOGO --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Company Logo
                </label>

                @if (!empty($companyProfile?->logo))
                    <div class="mb-3">
                        <img
                            src="{{ asset('storage/' . $companyProfile->logo) }}"
                            alt="Company Logo"
                            class="h-16 w-auto rounded-md border
                                   border-gray-200 dark:border-gray-700"
                        >
                    </div>
                @endif

                <input
                    type="file"
                    name="logo"
                    accept="image/*"
                    class="block w-full text-sm text-gray-500
                           file:mr-4 file:rounded-lg file:border-0
                           file:bg-brand-500 file:px-4 file:py-2
                           file:text-sm file:font-medium file:text-white
                           hover:file:bg-brand-600
                           dark:file:bg-brand-600 dark:hover:file:bg-brand-700"
                >

                <p class="mt-1 text-xs text-gray-500">
                    PNG, JPG, JPEG, WEBP, SVG. Max 2MB.
                </p>

                @error('logo')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- COMPANY NAME --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Company Name
                </label>
                <input
                    type="text"
                    name="company_name"
                    value="{{ old('company_name', $companyProfile->company_name ?? '') }}"
                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                >
            </div>

            {{-- ABOUT --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    About Company
                </label>
                <textarea
                    name="about"
                    rows="5"
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90"
                >{{ old('about', $companyProfile->about ?? '') }}</textarea>
            </div>

            {{-- VISION --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Vision
                </label>
                <textarea
                    name="vision"
                    rows="4"
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90"
                >{{ old('vision', $companyProfile->vision ?? '') }}</textarea>
            </div>

            {{-- MISSION --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Mission
                </label>
                <textarea
                    name="mission"
                    rows="4"
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90"
                >{{ old('mission', $companyProfile->mission ?? '') }}</textarea>
            </div>

            {{-- ADDRESS --}}
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Address
                </label>
                <textarea
                    name="address"
                    rows="3"
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90"
                >{{ old('address', $companyProfile->address ?? '') }}</textarea>
            </div>

            {{-- CONTACT INFO --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                {{-- PHONE --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Phone
                    </label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $companyProfile->phone ?? '') }}"
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                               border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                               focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                               focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                               dark:text-white/90"
                    >
                </div>

                {{-- FAX --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Fax
                    </label>
                    <input
                        type="text"
                        name="fax"
                        value="{{ old('fax', $companyProfile->fax ?? '') }}"
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                               border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                               focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                               focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                               dark:text-white/90"
                    >
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $companyProfile->email ?? '') }}"
                        class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                               border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                               focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                               focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                               dark:text-white/90"
                    >
                </div>

            </div>

            {{-- SUBMIT --}}
            <div class="pt-3">
                <button
                    type="submit"
                    class="inline-flex items-center gap-2
                           rounded-lg bg-btn-primary px-5 py-2.5
                           text-sm font-medium text-btn-text
                           hover:bg-btn-primary-hover transition"
                >
                    Save Company Profile
                </button>
            </div>

        </div>
    </form>

</x-common.component-card>

@endsection
