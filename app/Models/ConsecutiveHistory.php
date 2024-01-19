<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsecutiveHistory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'description',
        'assisted',
        'signatures',
        'clinic_history_id',
    ];

    protected $table = 'consecutive_history';
    
    public function clinicHistory()
    {
        return $this->belongsTo(ClinicalHistory::class, 'clinic_history_id');
    }
}
