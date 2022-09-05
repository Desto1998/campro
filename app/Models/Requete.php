<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requete extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_re';
    protected $table = 'requete';
    protected $fillable = [
        'date_re',
        'object_re',
        'dure_re',
        'statut',
        'id_emp',
        'date_debut',
        'date_fin',
        'description',
        'rejet',
//        'id_formation',

    ];
}
