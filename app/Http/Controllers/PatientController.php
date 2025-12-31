<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::orderBy('name')->get();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'identity_card_number' => 'nullable|string|max:255',
            'family_card_number' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'detail_address' => 'nullable|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'village' => 'nullable|string|max:255',
        ]);

        // $data['created_by'] = auth()->id();
        // $data['updated_by'] = auth()->id();

        Patient::create($data);

        return redirect()->route('patients.index')->with('success', 'Patient created.');
    }

    public function show(Patient $patient)
    {
        $patient->load(['createdBy', 'updatedBy']);
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'identity_card_number' => 'nullable|string|max:255',
            'family_card_number' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:50',
            'detail_address' => 'nullable|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'village' => 'nullable|string|max:255',
        ]);

        // $data['updated_by'] = auth()->id();

        $patient->update($data);

        return redirect()->route('patients.index')->with('success', 'Patient updated.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient deleted.');
    }
}
