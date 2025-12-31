<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'type',
        'stock',
        'created_by',
        'updated_by',
    ];

    public const TYPES = [
        'Tablet',
        'Kapsul',
        'Pil',
        'Serbuk (puyer)',
        'Granul',
        'Sirup',
        'Suspensi',
        'Emulsi',
        'Tetes (mata/telinga/hidung)',
        'Salep',
        'Krim',
        'Gel',
        'Pasta',
        'Lotion',
        'Injeksi (suntik)',
        'Infus',
        'Inhaler',
        'Nebulizer',
        'Supositoria',
        'Ovula (vaginal)',
        'Sublingual',
        'Bukal',
        'Patch transdermal',
        'Semprot (spray)',
        'Obat kumur',
    ];

    public static function types(): array
    {
        return self::TYPES;
    }
}
