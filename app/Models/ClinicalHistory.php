<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ClinicalHistory extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'professional_id',
        'patient_id',
        'relevant_information',
        'current_status',
        'background_information',
        'assisted',
        'signatures',
    ];

    protected $table = 'clinical_histories';

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function consecutiveHistory()
    {
        return $this->hasOne(ConsecutiveHistory::class, 'clinic_history_id');
    }

    public function backgroundInformation()
    {
        return $this->hasOne(BackgroundInformation::class, 'clinic_history_id');
    }
}
