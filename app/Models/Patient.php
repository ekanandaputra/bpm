<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MedicalRecord;

class Patient extends Model
{
    use HasFactory;

    public const GENDER_MALE = 'male';
    public const GENDER_FEMALE = 'female';

    public static function genderOptions(): array
    {
        return [
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female',
        ];
    }

    protected $fillable = [
        'identity_card_number',
        'family_card_number',
        'name',
        'dob',
        'gender',
        'detail_address',
        'rt',
        'rw',
        'village',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

        public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

}

