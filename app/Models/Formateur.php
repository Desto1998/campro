<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_for';
    protected $table = 'formateur';
    protected $fillable = [
        'nom_for',
        'prenom_for',
        'tel_for',
        'id_four',
        'id_formation',

    ];
}
