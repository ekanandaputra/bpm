@extends('layouts.app')

@section('title', 'Edit Patient — Clinic MR')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-header">
            <h1 class="mb-1">Edit Patient</h1>
        </div>

        <div class="card mt-3 p-3">
            <form action="{{ route('patients.update', $patient) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Identity Card Number</label>
                    <input type="text" name="identity_card_number" value="{{ old('identity_card_number', $patient->identity_card_number) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Family Card Number</label>
                    <input type="text" name="family_card_number" value="{{ old('family_card_number', $patient->family_card_number) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $patient->name) }}" class="form-control" required>
                    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">DOB</label>
                    <input type="date" name="dob" value="{{ old('dob', optional($patient->dob)->format('Y-m-d')) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">-- Select --</option>
                        @foreach(\App\Models\Patient::genderOptions() as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', $patient->gender) == $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Detail Address</label>
                    <textarea name="detail_address" class="form-control">{{ old('detail_address', $patient->detail_address) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">RT</label>
                        <input type="text" name="rt" value="{{ old('rt', $patient->rt) }}" class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">RW</label>
                        <input type="text" name="rw" value="{{ old('rw', $patient->rw) }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Village</label>
                        <input type="text" name="village" value="{{ old('village', $patient->village) }}" class="form-control">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Save</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
