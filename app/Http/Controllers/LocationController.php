<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('name')->paginate(15);

        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Location::create($validated);

        return redirect()
            ->route('locations.index')
            ->with('success', 'Ubicación creada.');
    }

    public function show(Location $location)
    {
        $location->load('equipment');

        return view('locations.show', compact('location'));
    }

    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $location->update($validated);

        return redirect()
            ->route('locations.index')
            ->with('success', 'Ubicación actualizada.');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()
            ->route('locations.index')
            ->with('success', 'Ubicación eliminada.');
    }
}