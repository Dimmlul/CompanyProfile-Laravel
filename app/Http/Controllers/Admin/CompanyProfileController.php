<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    /**
     * Display company profile page (form).
     */
    public function index()
    {
        return view('pages.admin.company-profile.index', [
            // company profile hanya 1 record
            'companyProfile' => CompanyProfile::first(),
        ]);
    }

    /**
     * Store or update company profile.
     */
    public function store(Request $request)
    {
        // VALIDATION
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'logo'         => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'about'        => 'nullable|string',
            'vision'       => 'nullable|string',
            'mission'      => 'nullable|string',
            'address'      => 'nullable|string',
            'phone'        => 'nullable|string|max:50',
            'fax'          => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
        ]);

        // Ambil data lama (karena hanya 1)
        $companyProfile = CompanyProfile::first();

        /**
         * HANDLE LOGO UPLOAD
         */
        if ($request->hasFile('logo')) {

            // Hapus logo lama jika ada
            if ($companyProfile && $companyProfile->logo) {
                Storage::disk('public')->delete($companyProfile->logo);
            }

            // Simpan logo baru
            $validated['logo'] = $request
                ->file('logo')
                ->store('company', 'public');
        }

        // Simpan / update (paksa 1 record)
        CompanyProfile::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return redirect()
            ->route('admin.company-profile.index')
            ->with('success', 'Company profile saved successfully.');
    }
}
