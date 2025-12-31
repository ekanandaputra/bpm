<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'diagnosis',
        'clinical_findings',
    ];

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
