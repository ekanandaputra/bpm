<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'visit_at',
        'notes',
    ];

    protected $casts = [
        'visit_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function vitals()
    {
        return $this->hasOne(Vital::class);
    }

    public function medicalAssessment()
    {
        return $this->hasOne(MedicalAssessment::class);
    }

    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'medical_record_medication')
            ->withPivot(['dosage', 'frequency', 'duration'])
            ->withTimestamps();
    }
}
