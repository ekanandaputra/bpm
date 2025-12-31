@extends('layouts.app')

@section('title', 'Dashboard — Clinic MR')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="content-header">
            <h1 class="mb-1">Dashboard</h1>
            <p class="muted">Overview of clinic activity (demo).</p>
        </div>
        <div class="row g-3 mt-3">
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="h6">Registered Patients</h3>
                    <p class="muted small">Total patients</p>
                    <div class="display-6 fw-bold">{{ $patientCount ?? 0 }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="h6">Registered Medications</h3>
                    <p class="muted small">Total medication items</p>
                    <div class="display-6 fw-bold">{{ $medicationCount ?? 0 }}</div>
                </div>
            </div>

            {{-- <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="h6">Last Updated Patient</h3>
                    <p class="muted small">Most recently updated</p>
                    <div class="fw-bold">{{ optional($lastUpdatedPatient)->name ?? '-' }}</div>
                    <div class="muted small">{{ optional($lastUpdatedPatient->updated_at)->format('Y-m-d H:i') ?? '-' }}</div>
                </div>
            </div> --}}

            <div class="col-md-3">
                <div class="card p-3">
                    <h3 class="h6">Patients by Gender</h3>
                    <div id="patientGenderChart" style="height:120px;"></div>
                </div>
            </div>
        </div>

        <div class="row g-3 mt-3">
            <div class="col-md-7">
                <div class="card p-3">
                    <h5 class="mb-3">Medications with stock &lt; 10</h5>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Type</th>
                                    <th class="text-end">Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lowStockMedications as $m)
                                    <tr>
                                        <td>{{ $m->name }}</td>
                                        <td>{{ $m->brand ?? '-' }}</td>
                                        <td>{{ $m->type ?? '-' }}</td>
                                        <td class="text-end">{{ $m->stock }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No low-stock medications.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card p-3">
                    <h5 class="mb-3">Patient Gender Distribution</h5>
                    <div class="chart-container">
                        <div id="patientGenderPie" style="height:260px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            try{
                var genders = @json($patientsByGender->pluck('total','gender'));
                var labels = Object.keys(genders).map(function(k){ return k || 'Unknown'; });
                var series = Object.values(genders);

                var options = {
                    chart: { type: 'donut', height: 260 },
                    labels: labels,
                    series: series,
                    legend: { position: 'bottom' }
                };

                var chart = new ApexCharts(document.querySelector('#patientGenderPie'), options);
                chart.render();
            }catch(e){ console.error(e); }
        });
    </script>
@endpush
