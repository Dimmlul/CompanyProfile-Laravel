<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        return view('pages.admin.clients.index', [
            'clients' => Client::orderBy('order')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('pages.admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'website'     => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
        ]);

        $validated['order'] = Client::max('order') + 1;
        $validated['is_active'] = (bool) $validated['is_active'];

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        Client::create($validated);

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('pages.admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'website'      => 'nullable|url|max:255',
            'description'  => 'nullable|string',
            'is_active'    => 'required|boolean',
            'order_action' => 'nullable|in:top,up,down,bottom',
        ]);

        $validated['is_active'] = (bool) $validated['is_active'];

        if ($request->hasFile('logo')) {
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }

            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $client->update($validated);

        $this->handleOrderAction($client, $validated['order_action'] ?? null);

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client updated successfully.');
    }

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

    /**
     * Handle order movement
     */
    private function handleOrderAction(Client $client, ?string $action): void
    {
        if (!$action) return;

        $current = $client->order;

        match ($action) {
            'top' => $client->update([
                'order' => Client::min('order') - 1
            ]),

            'bottom' => $client->update([
                'order' => Client::max('order') + 1
            ]),

            'up' => tap(
                Client::where('order', '<', $current)->orderByDesc('order')->first(),
                fn ($swap) => $swap?->update(['order' => $current])
            ) && $client->update(['order' => $current - 1]),

            'down' => tap(
                Client::where('order', '>', $current)->orderBy('order')->first(),
                fn ($swap) => $swap?->update(['order' => $current])
            ) && $client->update(['order' => $current + 1]),

            default => null,
        };
    }
}
