@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3>Search results for "{{ $q }}"</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h5>Patients ({{ $patients->count() }})</h5>
                    @if($patients->count())
                        <ul>
                            @foreach($patients as $p)
                                <li><a href="{{ route('patients.show', $p) }}">{{ $p->name }}</a> — {{ $p->identity_card_number ?? '-' }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>-</p>
                    @endif
                </div>

                <div class="card p-3 mb-3">
                    <h5>Medications ({{ $medications->count() }})</h5>
                    @if($medications->count())
                        <ul>
                            @foreach($medications as $m)
                                <li>{{ $m->name }} @if($m->brand) — {{ $m->brand }} @endif</li>
                            @endforeach
                        </ul>
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h5>Medical Records ({{ $records->count() }})</h5>
                    @if($records->count())
                        <ul>
                            @foreach($records as $r)
                                <li><a href="{{ route('medical-records.show', $r) }}">Record #{{ $r->id }}</a> — {{ optional($r->patient)->name ?? '-' }} — {{ \\Illuminate\\Support\\Str::limit($r->notes, 80) }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>-</p>
                    @endif
                </div>

                <div class="card p-3 mb-3">
                    <h5>Users ({{ $users->count() }})</h5>
                    @if($users->count())
                        <ul>
                            @foreach($users as $u)
                                <li>{{ $u->name }} — {{ $u->email }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>-</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
