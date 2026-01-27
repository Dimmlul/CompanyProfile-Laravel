<!-- resources/views/pages/admin/company-profile/index.blade.php -->
<!-- Vision Mission, About Us, Address, Etc -->

@extends('layouts.admin')

@section('title', 'Company Profile')

@section('content')

<x-common.component-card title="Company Profile">

    <form method="POST" action="{{ route('admin.company-profile.store') }}">
        @csrf

        <div class="grid grid-cols-1 gap-5">

            <!-- Company Name -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Company Name
                </label>
                <input
                    type="text"
                    name="company_name"
                    value="{{ old('company_name', $companyProfile->company_name ?? '') }}"
                    placeholder="PT Contoh Sejahtera"
                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                />
            </div>

            <!-- About -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    About Company
                </label>
                <textarea
                    name="about"
                    rows="4"
                    placeholder="Deskripsi singkat tentang perusahaan..."
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                >{{ old('about', $companyProfile->about ?? '') }}</textarea>
            </div>

            <!-- Vision -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Vision
                </label>
                <textarea
                    name="vision"
                    rows="3"
                    placeholder="Visi perusahaan"
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                >{{ old('vision', $companyProfile->vision ?? '') }}</textarea>
            </div>

            <!-- Mission -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Mission
                </label>
                <textarea
                    name="mission"
                    rows="3"
                    placeholder="Misi perusahaan"
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                >{{ old('mission', $companyProfile->mission ?? '') }}</textarea>
            </div>

            <!-- Address -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Address
                </label>
                <textarea
                    name="address"
                    rows="2"
                    placeholder="Alamat lengkap perusahaan"
                    class="dark:bg-dark-900 shadow-theme-xs w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-3 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                >{{ old('address', $companyProfile->address ?? '') }}</textarea>
            </div>

            <!-- Phone -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Phone Number
                </label>
                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $companyProfile->phone ?? '') }}"
                    placeholder="+62 812 xxxx xxxx"
                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                />
            </div>

            <!-- Email -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $companyProfile->email ?? '') }}"
                    placeholder="info@company.com"
                    class="dark:bg-dark-900 shadow-theme-xs h-11 w-full rounded-lg
                           border border-gray-300 bg-transparent px-4 py-2.5 text-sm
                           focus:border-brand-300 focus:ring-3 focus:ring-brand-500/10
                           focus:outline-hidden dark:border-gray-700 dark:bg-gray-900
                           dark:text-white/90 dark:placeholder:text-white/30"
                />
            </div>

            <!-- Submit -->
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
