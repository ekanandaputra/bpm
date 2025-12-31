<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Vital;
use App\Models\MedicalAssessment;
use App\Models\Medication;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::with(['patient'])->latest()->paginate(15);
        return view('medical_records.index', compact('records'));
    }

    public function create(Request $request)
    {
        $medications = Medication::all();
        $patient = null;
        if ($request->has('patient_id')) {
            $patient = Patient::find($request->get('patient_id'));
        }
        return view('medical_records.create', compact('medications', 'patient'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_at' => 'nullable|date',
            'notes' => 'nullable|string',

            'blood_pressure' => 'nullable|string',
            'heart_rate' => 'nullable|integer',
            'body_temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',

            'diagnosis' => 'nullable|string',
            'clinical_findings' => 'nullable|string',

            'medication_id' => 'nullable|array',
            'medication_id.*' => 'nullable|exists:medications,id',
            'dosage' => 'nullable|array',
            'frequency' => 'nullable|array',
            'duration' => 'nullable|array',
        ]);

        $record = MedicalRecord::create([
            'patient_id' => $data['patient_id'],
            'visit_at' => $data['visit_at'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        $record->vitals()->create([
            'blood_pressure' => $data['blood_pressure'] ?? null,
            'heart_rate' => $data['heart_rate'] ?? null,
            'body_temperature' => $data['body_temperature'] ?? null,
            'weight' => $data['weight'] ?? null,
            'height' => $data['height'] ?? null,
        ]);

        $record->medicalAssessment()->create([
            'diagnosis' => $data['diagnosis'] ?? null,
            'clinical_findings' => $data['clinical_findings'] ?? null,
        ]);

        if (!empty($data['medication_id'])) {
            foreach ($data['medication_id'] as $i => $medId) {
                if (!$medId) continue;
                $record->medications()->attach($medId, [
                    'dosage' => $data['dosage'][$i] ?? null,
                    'frequency' => $data['frequency'][$i] ?? null,
                    'duration' => $data['duration'][$i] ?? null,
                ]);
            }
        }

        return redirect()->route('medical-records.show', $record)->with('success', 'Medical record created.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['vitals', 'medicalAssessment', 'medications', 'patient']);
        return view('medical_records.show', ['record' => $medicalRecord]);
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['vitals', 'medicalAssessment', 'medications', 'patient']);
        $medications = Medication::all();
        return view('medical_records.edit', ['record' => $medicalRecord, 'medications' => $medications]);
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $data = $request->validate([
            'visit_at' => 'nullable|date',
            'notes' => 'nullable|string',

            'blood_pressure' => 'nullable|string',
            'heart_rate' => 'nullable|integer',
            'body_temperature' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',

            'diagnosis' => 'nullable|string',
            'clinical_findings' => 'nullable|string',

            'medication_id' => 'nullable|array',
            'medication_id.*' => 'nullable|exists:medications,id',
            'dosage' => 'nullable|array',
            'frequency' => 'nullable|array',
            'duration' => 'nullable|array',
        ]);

        $medicalRecord->update([
            'visit_at' => $data['visit_at'] ?? null,
            'notes' => $data['notes'] ?? null,
        ]);

        $medicalRecord->vitals()->updateOrCreate([], [
            'blood_pressure' => $data['blood_pressure'] ?? null,
            'heart_rate' => $data['heart_rate'] ?? null,
            'body_temperature' => $data['body_temperature'] ?? null,
            'weight' => $data['weight'] ?? null,
            'height' => $data['height'] ?? null,
        ]);

        $medicalRecord->medicalAssessment()->updateOrCreate([], [
            'diagnosis' => $data['diagnosis'] ?? null,
            'clinical_findings' => $data['clinical_findings'] ?? null,
        ]);

        // Sync medications: detach and re-attach with pivot data
        $medicalRecord->medications()->detach();
        if (!empty($data['medication_id'])) {
            foreach ($data['medication_id'] as $i => $medId) {
                if (!$medId) continue;
                $medicalRecord->medications()->attach($medId, [
                    'dosage' => $data['dosage'][$i] ?? null,
                    'frequency' => $data['frequency'][$i] ?? null,
                    'duration' => $data['duration'][$i] ?? null,
                ]);
            }
        }

        return redirect()->route('medical-records.show', $medicalRecord)->with('success', 'Medical record updated.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->back()->with('success', 'Medical record deleted.');
    }
}
