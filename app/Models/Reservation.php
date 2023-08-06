<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'student_id',
        'email',
        'tel_number',
        'res_date',
        'slot_id',
        'start_time',
        'end_time',
    ];

    protected $dates = [
        'res_date',
        'start_time',
        'end_time', // Define the start_time attribute as a date
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
