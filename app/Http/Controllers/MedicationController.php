<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MedicationController extends Controller
{
    public function index()
    {
        $medications = Medication::orderBy('name')->get();
        return view('medications.index', compact('medications'));
    }

    public function create()
    {
        return view('medications.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'type' => ['nullable','string', Rule::in(Medication::TYPES)],
            'stock' => 'nullable|integer',
        ]);

        Medication::create(array_merge($data, ['stock' => $data['stock'] ?? 0]));

        return redirect()->route('medications.index')->with('success', 'Medication created.');
    }

    public function edit(Medication $medication)
    {
        return view('medications.edit', compact('medication'));
    }

    public function update(Request $request, Medication $medication)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'type' => ['nullable','string', Rule::in(Medication::TYPES)],
            'stock' => 'nullable|integer',
        ]);

        $medication->update(array_merge($data, ['stock' => $data['stock'] ?? 0]));

        return redirect()->route('medications.index')->with('success', 'Medication updated.');
    }

    public function destroy(Medication $medication)
    {
        $medication->delete();
        return redirect()->route('medications.index')->with('success', 'Medication deleted.');
    }
}
