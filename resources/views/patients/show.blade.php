@extends('layouts.app')

@section('title', 'Patient — Clinic MR')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-header">
            <h1 class="mb-1">{{ $patient->name }}</h1>
            <p class="muted">{{ __('messages.patient_details') }}</p>
        </div>

        <div class="card mt-3 p-3">
            <dl class="row">
                <dt class="col-sm-3">Identity Card Number</dt>
                <dd class="col-sm-9">{{ $patient->identity_card_number ?? '-' }}</dd>

                <dt class="col-sm-3">Family Card Number</dt>
                <dd class="col-sm-9">{{ $patient->family_card_number ?? '-' }}</dd>

                <dt class="col-sm-3">DOB</dt>
                <dd class="col-sm-9">{{ optional($patient->dob)->format('Y-m-d') ?? '-' }}</dd>

                <dt class="col-sm-3">Gender</dt>
                <dd class="col-sm-9">{{ $patient->gender ?? '-' }}</dd>

                <dt class="col-sm-3">Address</dt>
                <dd class="col-sm-9">{{ $patient->detail_address ?? '-' }}</dd>

                <dt class="col-sm-3">RT / RW</dt>
                <dd class="col-sm-9">{{ $patient->rt ?? '-' }} / {{ $patient->rw ?? '-' }}</dd>

                <dt class="col-sm-3">Village</dt>
                <dd class="col-sm-9">{{ $patient->village ?? '-' }}</dd>

                <dt class="col-sm-3">Created By</dt>
                <dd class="col-sm-9">{{ optional($patient->createdBy)->name ?? '-' }} — {{ optional($patient->created_at)->format('Y-m-d H:i') ?? '-' }}</dd>

                <dt class="col-sm-3">Last Updated By</dt>
                <dd class="col-sm-9">{{ optional($patient->updatedBy)->name ?? '-' }} — {{ optional($patient->updated_at)->format('Y-m-d H:i') ?? '-' }}</dd>
            </dl>

            <div class="d-flex gap-2">
                <a href="{{ route('patients.edit', $patient) }}" class="btn btn-outline-secondary action-loading">{{ __('messages.edit') }}</a>
                <a href="{{ route('patients.index') }}" class="btn btn-outline-primary">{{ __('messages.back') }}</a>
            </div>
        </div>

        <div class="card mt-3 p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h4>{{ __('messages.medical_records') }}</h4>
                <a href="{{ route('medical-records.create', ['patient_id' => $patient->id]) }}" class="btn btn-sm btn-primary">{{ __('messages.add_record') }}</a>
            </div>

            @php $records = $patient->medicalRecords()->latest()->get(); @endphp

            @if($records->count())
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Visit</th>
                            <th>Diagnosis</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $r)
                            <tr>
                                <td>{{ $r->id }}</td>
                                <td>{{ optional($r->visit_at)->format('Y-m-d H:i') }}</td>
                                <td>{{ optional($r->medicalAssessment)->diagnosis ? Str::limit($r->medicalAssessment->diagnosis, 60) : '-' }}</td>
                                <td>
                                    <a href="{{ route('medical-records.show', $r) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view') }}</a>
                                    <a href="{{ route('medical-records.edit', $r) }}" class="btn btn-sm btn-outline-secondary">{{ __('messages.edit') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="muted">{{ __('messages.no_records') }}</p>
            @endif
        </div>
    </div>
@endsection

