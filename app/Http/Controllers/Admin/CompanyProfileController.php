<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{

    /**
     * Display the company profile management page.
     *
     * Responsibilities:
     * - Retrieve the existing company profile (single-record setup)
     * - Render the admin company profile page
     */
    public function index()
    {
        $companyProfile = CompanyProfile::first();

        /**
         * Fields that are directly rendered on the public homepage.
         * Anything still blank here gets flagged so the admin knows
         * the homepage will look incomplete until it's filled in.
         */
        $homepageFields = [
            'company_name' => 'Company name',
            'logo'         => 'Logo',
            'about'        => 'About',
            'vision'       => 'Vision',
            'mission'      => 'Mission',
        ];

        $missingHomepageFields = collect($homepageFields)
            ->filter(fn ($label, $field) => blank($companyProfile?->{$field}))
            ->values();

        return view('pages.admin.company-profile.index', [
            'companyProfile'         => $companyProfile,
            'missingHomepageFields'  => $missingHomepageFields,
        ]);
    }

    /**
     * Store or update the company profile data.
     *
     * Responsibilities:
     * - Validate incoming request data
     * - Handle logo upload and replacement (if provided)
     * - Ensure only one company profile record exists
     * - Persist company profile information to the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'logo'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'about'        => 'nullable|string',
            'vision'       => 'nullable|string',
            'mission'      => 'nullable|string',
            'address'      => 'nullable|string',
            'latitude'     => 'nullable|numeric|between:-90,90',
            'longitude'    => 'nullable|numeric|between:-180,180',
            'phone'        => 'nullable|string|max:50',
            'whatsapp'     => 'nullable|string|max:50',
            'instagram'    => 'nullable|string|max:255',
            'fax'          => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
        ]);

        /**
         * Retrieve the existing company profile.
         * The application enforces a single-record pattern.
         */
        $companyProfile = CompanyProfile::first();

        /**
         * Handle logo upload.
         * If a new logo is uploaded:
         * - Remove the existing logo file from storage
         * - Store the new logo in public storage
         */
        if ($request->hasFile('logo')) {
            if ($companyProfile?->logo) {
                Storage::disk('public')->delete($companyProfile->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('company', 'public');
        }

        /**
         * Update or create the company profile.
         * This ensures that only one record (ID = 1) exists.
         */
        CompanyProfile::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return redirect()
            ->route('admin.company-profile.index')
            ->with('success', 'Company profile saved successfully.');
    }
}
