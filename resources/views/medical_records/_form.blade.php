<div class="mb-3">
    <label class="form-label">Visit At</label>
    <input type="datetime-local" name="visit_at" value="{{ old('visit_at', isset($record) ? optional($record->visit_at)->format('Y-m-d\TH:i') : (isset($patient) && $patient ? '' : '')) }}" class="form-control" />
</div>

<div class="mb-3">
    <label class="form-label">Notes</label>
    <textarea name="notes" class="form-control">{{ old('notes', $record->notes ?? '') }}</textarea>
</div>

<h5>Vitals</h5>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Blood Pressure</label>
        <input name="blood_pressure" class="form-control" value="{{ old('blood_pressure', $record->vitals->blood_pressure ?? '') }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Heart Rate</label>
        <input name="heart_rate" class="form-control" value="{{ old('heart_rate', $record->vitals->heart_rate ?? '') }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Temp</label>
        <input name="body_temperature" class="form-control" value="{{ old('body_temperature', $record->vitals->body_temperature ?? '') }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Weight</label>
        <input name="weight" class="form-control" value="{{ old('weight', $record->vitals->weight ?? '') }}" />
    </div>
    <div class="col-md-2 mb-3">
        <label class="form-label">Height</label>
        <input name="height" class="form-control" value="{{ old('height', $record->vitals->height ?? '') }}" />
    </div>
</div>

<h5>Medical Assessment</h5>
<div class="mb-3">
    <label class="form-label">Diagnosis</label>
    <textarea name="diagnosis" class="form-control">{{ old('diagnosis', $record->medicalAssessment->diagnosis ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Clinical Findings</label>
    <textarea name="clinical_findings" class="form-control">{{ old('clinical_findings', $record->medicalAssessment->clinical_findings ?? '') }}</textarea>
</div>

<h5>Treatments / Medications</h5>
<div id="med-rows">
    @php
        $medRows = old('medication_id', isset($record) ? $record->medications->pluck('id')->toArray() : []);
    @endphp
    @if(count($medRows) > 0)
        @foreach($medRows as $i => $medId)
            <div class="row med-row mb-2">
                <div class="col-md-4">
                    <select name="medication_id[]" class="form-select">
                        <option value="">-- Select medication --</option>
                        @foreach($medications as $med)
                            <option value="{{ $med->id }}" {{ $med->id == $medId ? 'selected' : '' }}>{{ $med->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2"><input name="dosage[]" class="form-control" placeholder="Dosage" value="{{ old('dosage.'.$i, $record->medications[$i]->pivot->dosage ?? '') }}" /></div>
                <div class="col-md-2"><input name="frequency[]" class="form-control" placeholder="Frequency" value="{{ old('frequency.'.$i, $record->medications[$i]->pivot->frequency ?? '') }}" /></div>
                <div class="col-md-2"><input name="duration[]" class="form-control" placeholder="Duration" value="{{ old('duration.'.$i, $record->medications[$i]->pivot->duration ?? '') }}" /></div>
                <div class="col-md-2"><button type="button" class="btn btn-danger remove-med">Remove</button></div>
            </div>
        @endforeach
    @else
        <div class="row med-row mb-2">
            <div class="col-md-4">
                <select name="medication_id[]" class="form-select">
                    <option value="">-- Select medication --</option>
                    @foreach($medications as $med)
                        <option value="{{ $med->id }}">{{ $med->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><input name="dosage[]" class="form-control" placeholder="Dosage" /></div>
            <div class="col-md-2"><input name="frequency[]" class="form-control" placeholder="Frequency" /></div>
            <div class="col-md-2"><input name="duration[]" class="form-control" placeholder="Duration" /></div>
            <div class="col-md-2"><button type="button" class="btn btn-danger remove-med">Remove</button></div>
        </div>
    @endif
</div>
<div class="mb-3">
    <button type="button" id="add-med" class="btn btn-sm btn-secondary">Add medication</button>
</div>

@push('scripts')
<script>
document.addEventListener('click', function(e){
    if(e.target && e.target.id === 'add-med'){
        const container = document.getElementById('med-rows');
        const row = container.querySelector('.med-row').cloneNode(true);
        row.querySelectorAll('input').forEach(i=>i.value='');
        row.querySelector('select').selectedIndex = 0;
        container.appendChild(row);
    }
    if(e.target && e.target.classList.contains('remove-med')){
        const rows = document.querySelectorAll('.med-row');
        if(rows.length > 1){
            e.target.closest('.med-row').remove();
        }
    }
});
</script>
@endpush
