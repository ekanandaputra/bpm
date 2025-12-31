@extends('layouts.app')

@section('title', 'Create Medication — Clinic MR')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-header">
            <h1 class="mb-1">New Medication</h1>
        </div>

        <div class="card mt-3 p-3">
            <form class="action-loading" action="{{ route('medications.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                    @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select name="type" class="form-control">
                        <option value="">-- Select type --</option>
                        @foreach(\App\Models\Medication::types() as $t)
                            <option value="{{ $t }}" {{ old('type') === $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('type')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" class="form-control">
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('medications.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
