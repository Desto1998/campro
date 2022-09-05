<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateFormation extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_date';
    protected $table = 'date_formation';
    protected $fillable = [
        'date_debut',
        'date_fin',
        'statut',
        'id_re',
        'id_for',
        'competence',
//        'id_formation',

    ];
}
