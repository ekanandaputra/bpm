<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medication;
use App\Models\MedicalRecord;
use App\Models\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));

        $patients = collect();
        $medications = collect();
        $records = collect();
        $users = collect();

        if ($q !== '') {
            $like = "%{$q}%";

            $patients = Patient::where('name', 'like', $like)
                ->orWhere('identity_card_number', 'like', $like)
                ->orWhere('family_card_number', 'like', $like)
                ->limit(20)
                ->get();

            $medications = Medication::where('name', 'like', $like)
                ->orWhere('brand', 'like', $like)
                ->limit(20)
                ->get();

            $records = MedicalRecord::with('patient')
                ->where('notes', 'like', $like)
                ->orWhereHas('patient', function ($qbuilder) use ($like) {
                    $qbuilder->where('name', 'like', $like);
                })
                ->limit(30)
                ->get();

            $users = User::where('name', 'like', $like)
                ->orWhere('email', 'like', $like)
                ->limit(20)
                ->get();
        }

        return view('search.results', compact('q', 'patients', 'medications', 'records', 'users'));
    }
}
