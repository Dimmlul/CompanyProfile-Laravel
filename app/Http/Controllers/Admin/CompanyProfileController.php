<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function index()
    {
        return view('pages.admin.company-profile.index', [
            'companyProfile' => CompanyProfile::first(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'logo'         => 'nullable|image|mimes:png,jpg,jpeg,webp,svg|max:2048',
            'about'        => 'nullable|string',
            'vision'       => 'nullable|string',
            'mission'      => 'nullable|string',
            'address'      => 'nullable|string',
            'phone'        => 'nullable|string|max:50',
            'whatsapp'     => 'nullable|string|max:50',
            'instagram'    => 'nullable|string|max:255',
            'fax'          => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
        ]);

        $companyProfile = CompanyProfile::first();

        if ($request->hasFile('logo')) {
            if ($companyProfile?->logo) {
                Storage::disk('public')->delete($companyProfile->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('company', 'public');
        }

        CompanyProfile::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return redirect()
            ->route('admin.company-profile.index')
            ->with('success', 'Company profile saved successfully.');
    }
}
