@extends('layouts.app')

@section('title', 'Patients — Clinic MR')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-header d-flex align-items-center justify-content-between">
            <div>
                <h1 class="mb-1">Patients</h1>
                <p class="muted">Manage patients (create, edit, delete)</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientCreateModal">New Patient</button>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <div class="card mt-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ optional($p->dob)->format('Y-m-d') ?? '-' }}</td>
                                <td>{{ $p->gender ?? '-' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('patients.show', $p) }}" class="btn btn-sm btn-outline-primary action-loading">View</a>
                                    <a href="{{ route('patients.edit', $p) }}" class="btn btn-sm btn-outline-secondary action-loading">Edit</a>

                                    <form action="{{ route('patients.destroy', $p) }}" method="POST" class="action-loading" style="display:inline-block; margin-left:6px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this patient?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No patients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Patient Modal -->
        <div class="modal fade" id="patientCreateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Patient</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="patientCreateForm" action="{{ route('patients.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Identity Card Number</label>
                                <input type="text" name="identity_card_number" value="{{ old('identity_card_number') }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Family Card Number</label>
                                <input type="text" name="family_card_number" value="{{ old('family_card_number') }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">DOB</label>
                                <input type="date" name="dob" value="{{ old('dob') }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="">-- Select --</option>
                                    @foreach(\App\Models\Patient::genderOptions() as $key => $label)
                                        <option value="{{ $key }}" {{ old('gender') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Detail Address</label>
                                <textarea name="detail_address" class="form-control">{{ old('detail_address') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RT</label>
                                    <input type="text" name="rt" value="{{ old('rt') }}" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">RW</label>
                                    <input type="text" name="rw" value="{{ old('rw') }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Village</label>
                                    <input type="text" name="village" value="{{ old('village') }}" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="patientCreateForm" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                try {
                    var modalEl = document.getElementById('patientCreateModal');
                    var modal = new bootstrap.Modal(modalEl);
                    modal.show();
                } catch (e) {
                    console.error(e);
                }
            });
        </script>
    @endif
@endpush
