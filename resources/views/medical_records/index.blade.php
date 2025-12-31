@extends('layouts.app')

@section('title', __('messages.medical_records'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
            <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>{{ __('messages.medical_records') }}</h3>
            <a href="{{ route('medical-records.create') }}" class="btn btn-primary">{{ __('messages.add_record') }}</a>
        </div>

        <div class="card p-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Visit At</th>
                        <th>Notes</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $r)
                        <tr>
                            <td>{{ $r->id }}</td>
                            <td>{{ optional($r->patient)->name }}</td>
                            <td>{{ optional($r->visit_at)->format('Y-m-d H:i') }}</td>
                            <td>{{ Str::limit($r->notes, 80) }}</td>
                            <td>
                                <a href="{{ route('medical-records.show', $r) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.view') }}</a>
                                <a href="{{ route('medical-records.edit', $r) }}" class="btn btn-sm btn-outline-secondary">{{ __('messages.edit') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $records->links() }}
        </div>
    </div>
@endsection
