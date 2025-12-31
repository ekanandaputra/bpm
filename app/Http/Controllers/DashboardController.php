<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medication;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $patientCount = Patient::count();
        $medicationCount = Medication::count();
        $lowStockMedications = Medication::where('stock', '<', 10)->orderBy('stock')->get();
        $patientsByGender = Patient::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->get();
        $lastUpdatedPatient = Patient::orderBy('updated_at', 'desc')->first();

        return view('dashboard', compact(
            'patientCount',
            'medicationCount',
            'lowStockMedications',
            'patientsByGender',
            'lastUpdatedPatient'
        ));
    }
}
