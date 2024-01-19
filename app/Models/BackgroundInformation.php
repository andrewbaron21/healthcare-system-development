<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'personal_history',
        'previous_illnesses',
        'surgeries',
        'hospitalizations',
        'allergies',
        'previous_treatments',
        'family_background',
        'clinic_history_id',
    ];

    protected $table = 'background_information';

    public function clinicHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'clinic_history_id');
    }
}
