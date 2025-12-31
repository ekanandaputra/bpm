@extends('layouts.app')

@section('title', 'Medical Record')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Medical Record #{{ $record->id }}</h3>
            <div>
                <a href="{{ route('medical-records.edit', $record) }}" class="btn btn-sm btn-outline-secondary">{{ __('messages.edit') }}</a>
                <form method="post" action="{{ route('medical-records.destroy', $record) }}" style="display:inline">@csrf @method('delete')<button class="btn btn-sm btn-danger">{{ __('messages.delete') }}</button></form>
            </div>
        </div>

        <div class="card p-3 mb-3">
            <h5>Patient</h5>
            <p>{{ optional($record->patient)->name }}</p>
            <h5>Visit</h5>
            <p>{{ optional($record->visit_at)->format('Y-m-d H:i') }}</p>
            <h5>Notes</h5>
            <p>{{ $record->notes }}</p>
        </div>

        <div class="card p-3 mb-3">
            <h5>Vitals</h5>
            <dl class="row">
                <dt class="col-sm-3">Blood Pressure</dt>
                <dd class="col-sm-9">{{ $record->vitals->blood_pressure ?? '-' }}</dd>

                <dt class="col-sm-3">Heart Rate</dt>
                <dd class="col-sm-9">{{ $record->vitals->heart_rate ?? '-' }}</dd>

                <dt class="col-sm-3">Temperature</dt>
                <dd class="col-sm-9">{{ $record->vitals->body_temperature ?? '-' }}</dd>

                <dt class="col-sm-3">Weight</dt>
                <dd class="col-sm-9">{{ $record->vitals->weight ?? '-' }}</dd>

                <dt class="col-sm-3">Height</dt>
                <dd class="col-sm-9">{{ $record->vitals->height ?? '-' }}</dd>
            </dl>
        </div>

        <div class="card p-3 mb-3">
            <h5>Medical Assessment</h5>
            <p><strong>Diagnosis:</strong> {{ $record->medicalAssessment->diagnosis ?? '-' }}</p>
            <p><strong>Clinical Findings:</strong> {{ $record->medicalAssessment->clinical_findings ?? '-' }}</p>
        </div>

        <div class="card p-3 mb-3">
            <h5>Treatments / Medications</h5>
            @if($record->medications->count())
                <ul>
                    @foreach($record->medications as $m)
                        <li>{{ $m->name }} — {{ $m->pivot->dosage ?? '-' }} / {{ $m->pivot->frequency ?? '-' }} / {{ $m->pivot->duration ?? '-' }}</li>
                    @endforeach
                </ul>
            @else
                <p>-</p>
            @endif
        </div>
    </div>
@endsection
