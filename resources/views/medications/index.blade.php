@extends('layouts.app')

@section('title', 'Medications — Clinic MR')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-header d-flex align-items-center justify-content-between">
            <div>
                <h1 class="mb-1">Medications</h1>
                <p class="muted">Manage medications (create, edit, delete)</p>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medCreateModal">New
                    Medication</button>
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
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th class="text-end">Stock</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medications as $med)
                            <tr>
                                <td>{{ $med->name }}</td>
                                <td>{{ $med->brand ?? '-' }}</td>
                                <td>{{ $med->type ?? '-' }}</td>
                                <td class="text-end">{{ $med->stock }}</td>
                                <td class="text-end">
                                    <a href="{{ route('medications.edit', $med) }}"
                                        class="btn btn-sm btn-outline-secondary action-loading">Edit</a>

                                    <form action="{{ route('medications.destroy', $med) }}" method="POST"
                                        class="action-loading" style="display:inline-block; margin-left:6px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this medication?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No medications found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Medication Modal -->
        <div class="modal fade" id="medCreateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Medication</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="medCreateForm" class="action-loading" action="{{ route('medications.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Brand</label>
                                <input type="text" name="brand" value="{{ old('brand') }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <select name="type" class="form-control">
                                    <option value="">-- Select type --</option>
                                    @foreach (\App\Models\Medication::types() as $t)
                                        <option value="{{ $t }}" {{ old('type') === $t ? 'selected' : '' }}>
                                            {{ $t }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" value="{{ old('stock', 0) }}" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="medCreateForm" class="btn btn-primary">Create</button>
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
                    var modalEl = document.getElementById('medCreateModal');
                    var modal = new bootstrap.Modal(modalEl);
                    modal.show();
                } catch (e) {
                    console.error(e);
                }
            });
        </script>
    @endif
@endpush
