@extends('layouts.app')

@section('title', __('messages.add_record'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3>Create Medical Record</h3>

        <div class="card p-3">
            <form method="post" action="{{ route('medical-records.store') }}">
                @csrf
                <input type="hidden" name="patient_id" value="{{ old('patient_id', optional($patient)->id ?? request('patient_id')) }}" />

                @include('medical_records._form')

                <div><button class="btn btn-primary">{{ __('messages.save') }}</button></div>
            </form>
        </div>
    </div>
@endsection
