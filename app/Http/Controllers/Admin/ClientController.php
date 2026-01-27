<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index()
    {
        return view('pages.admin.clients.index', [
            'clients' => Client::orderBy('order')
                ->orderByDesc('created_at')
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new client.
     */
    public function create()
    {
        return view('pages.admin.clients.create');
    }

    /**
     * Store a newly created client.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'website'     => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer',
            'is_active'   => 'required|boolean',
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request
                ->file('logo')
                ->store('clients', 'public');
        }

        Client::create($validated);

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(Client $client)
    {
        return view('pages.admin.clients.edit', [
            'client' => $client,
        ]);
    }

    /**
     * Update the specified client.
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'website'     => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'order'       => 'nullable|integer',
            'is_active'   => 'required|boolean',
        ]);

        $validated['order'] = $validated['order'] ?? 0;

        if ($request->hasFile('logo')) {
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('clients', 'public');
        }

        $client->update($validated);

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified client.
     */
    public function destroy(Client $client)
    {
        if ($client->logo && Storage::disk('public')->exists($client->logo)) {
            Storage::disk('public')->delete($client->logo);
        }

        $client->delete();

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client deleted successfully.');
    }
}
