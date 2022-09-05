<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnels extends Model
{
    use HasFactory;
    protected $primaryKey = 'personnel_id';
    protected $table = 'personnels';
    protected $fillable = [
        'code',
        'nom',
        'prenom',
        'poste',
        'email_p',
        'tel',
        'adresse_p',
        'date_ajout',
        'iduser',
    ];
}
