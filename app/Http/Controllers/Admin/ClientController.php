<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a paginated list of clients.
     *
     * Responsibilities:
     * - Retrieve clients ordered by the custom `order` column
     * - Apply pagination
     * - Render the admin clients index page
     */
    public function index()
    {
        return view('pages.admin.clients.index', [
            'clients' => Client::orderBy('order')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new client.
     *
     * Responsibilities:
     * - Render the client creation form
     */
    public function create()
    {
        return view('pages.admin.clients.create');
    }

    /**
     * Store a newly created client in storage.
     *
     * Responsibilities:
     * - Validate incoming request data
     * - Assign display order automatically
     * - Handle logo upload (if provided)
     * - Persist client data to the database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'website'     => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'required|boolean',
        ]);

        /**
         * Assign the next available order value.
         * This ensures new clients appear at the bottom by default.
         */
        $validated['order'] = Client::max('order') + 1;

        /**
         * Ensure boolean casting for the active state.
         */
        $validated['is_active'] = (bool) $validated['is_active'];

        /**
         * Handle logo upload.
         * Store the logo in public storage if provided.
         */
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        Client::create($validated);

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }

    /**
     * Show the form for editing the specified client.
     *
     * Responsibilities:
     * - Load the client data
     * - Render the edit form
     */
    public function edit(Client $client)
    {
        return view('pages.admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified client in storage.
     *
     * Responsibilities:
     * - Validate updated input data
     * - Replace the client logo if a new one is uploaded
     * - Update client active state
     * - Handle client ordering actions (top, up, down, bottom)
     */
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'website'      => 'nullable|url|max:255',
            'description'  => 'nullable|string',
            'is_active'    => 'required|boolean',
            'order_action' => 'nullable|in:top,up,down,bottom',
        ]);

        /**
         * Ensure boolean casting for the active state.
         */
        $validated['is_active'] = (bool) $validated['is_active'];

        /**
         * Handle logo replacement.
         * If a new logo is uploaded:
         * - Delete the existing logo file
         * - Store the new logo
         */
        if ($request->hasFile('logo')) {
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }

            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        /**
         * Update client data.
         */
        $client->update($validated);

        /**
         * Handle ordering actions such as moving the client
         * to the top, bottom, or swapping positions.
         */
        $this->handleOrderAction($client, $validated['order_action'] ?? null);

        return redirect()
            ->route('admin.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    /**
     * Remove the specified client from storage.
     *
     * Responsibilities:
     * - Delete the client logo file if it exists
     * - Remove the client record from the database
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

    /**
     * Handle client order movement actions.
     *
     * Supported actions:
     * - top:    Move client to the top of the list
     * - bottom: Move client to the bottom of the list
     * - up:     Move client one position up
     * - down:   Move client one position down
     *
     * This method updates order values and swaps positions
     * with adjacent records when necessary.
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
