<?php
// app/Http/Controllers/Admin/CompanyProfileController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    /**
     * Display company profile page (form).
     */
    public function index()
    {
        return view('pages.admin.company-profile.index', [
            // biasanya company profile cuma 1
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
            'about'        => 'nullable|string',
            'vision'       => 'nullable|string',
            'mission'      => 'nullable|string',
            'address'      => 'nullable|string',
            'phone'        => 'nullable|string|max:50',
            'email'        => 'nullable|email|max:255',
        ]);

        // karena company profile cuma 1 record
        CompanyProfile::updateOrCreate(
            ['id' => 1], // paksa satu data
            $validated
        );

        return redirect()
            ->route('admin.company-profile.index')
            ->with('success', 'Company profile saved successfully.');
    }
}
