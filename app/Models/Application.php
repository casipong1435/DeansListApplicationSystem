<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester_id',
        'id_number',
        'status',
        'equivalent',
        'average',
        'grade',
        'registrar_date_approved',
        'dean_date_approved',
        'vp_date_approved'
    ];
}
