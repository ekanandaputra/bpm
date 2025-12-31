@extends('layouts.app')

@section('title', __('messages.edit'))

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h3>Edit Medical Record</h3>

        <div class="card p-3">
            <form method="post" action="{{ route('medical-records.update', $record) }}">
                @csrf
                @method('put')

                @include('medical_records._form')

                <div><button class="btn btn-primary">{{ __('messages.update') }}</button></div>
            </form>
        </div>
    </div>
@endsection
