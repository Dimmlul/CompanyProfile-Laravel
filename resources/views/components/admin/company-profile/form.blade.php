<!-- resources/views/components/admin/company-profile/form.blade.php -->

@props([
    'companyProfile' => null
])

<form
    method="POST"
    action="{{ route('admin.company-profile.store') }}"
    enctype="multipart/form-data"
>
    @csrf

    <div class="grid grid-cols-1 gap-5">

        <x-common.form.image-upload
            label="Company Logo"
            name="logo"
            :current="$companyProfile?->logo"
        />

        <x-common.form.input
            label="Company Name"
            name="company_name"
            :value="$companyProfile?->company_name"
        />

        <x-common.form.textarea
            label="About Company"
            name="about"
            rows="5"
            :value="$companyProfile?->about"
        />

        <x-common.form.textarea
            label="Vision"
            name="vision"
            :value="$companyProfile?->vision"
        />

        <x-common.form.textarea
            label="Mission"
            name="mission"
            :value="$companyProfile?->mission"
        />

        <x-common.form.textarea
            label="Address"
            name="address"
            rows="3"
            :value="$companyProfile?->address"
        />

        <div class="grid grid-cols-1 md:grid-cols-5 gap-5">
            <x-common.form.input
                label="Phone"
                name="phone"
                :value="$companyProfile?->phone"
            />

            <x-common.form.input
                label="WhatsApp"
                name="whatsapp"
                placeholder="6281234567890"
                :value="$companyProfile?->whatsapp"
            />

            <x-common.form.input
                label="Instagram"
                name="instagram"
                placeholder="yourcompany"
                :value="$companyProfile?->instagram"
            />

            <x-common.form.input
                label="Fax"
                name="fax"
                :value="$companyProfile?->fax"
            />

            <x-common.form.input
                label="Email"
                name="email"
                type="email"
                :value="$companyProfile?->email"
            />
        </div>

        <x-common.form.submit label="Save Company Profile" />

    </div>
</form>
