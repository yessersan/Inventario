<?php

namespace App\Http\Controllers;

use App\Models\Personnel;
use App\Models\Department;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index(Request $request)
    {
        $query = Personnel::with('department');

        if ($request->filled('department_id')) {
            $query->where('department_id', $request->department_id);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $personnel = $query->orderBy('name')->paginate(15)->appends($request->all());
        $departments = Department::orderBy('name')->get();

        return view('personnel.index', compact('personnel', 'departments'));
    }

    public function create()
    {
        $departments = Department::orderBy('name')->get();
        return view('personnel.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:personnels',
            'department_id' => 'nullable|exists:departments,id',
        ]);

        Personnel::create($validated);
        return redirect()->route('personnel.index')->with('success', 'Persona agregada.');
    }

    public function show(Personnel $personnel)
    {
        $personnel->load('department', 'equipmentResponsible', 'maintenancePerformed', 'hardwareChangesResponsible');
        return view('personnel.show', compact('personnel'));
    }

    public function edit(Personnel $personnel)
    {
        $departments = Department::orderBy('name')->get();
        return view('personnel.edit', compact('personnel', 'departments'));
    }

    public function update(Request $request, Personnel $personnel)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:personnels,email,' . $personnel->id,
            'department_id' => 'nullable|exists:departments,id',
        ]);

        $personnel->update($validated);
        return redirect()->route('personnel.index')->with('success', 'Persona actualizada.');
    }

    public function destroy(Personnel $personnel)
    {
        $personnel->delete();
        return redirect()->route('personnel.index')->with('success', 'Persona eliminada.');
    }
}