<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipements extends Model
{
    use HasFactory;
    protected $primaryKey = 'equipement_id';
    protected $fillable = [
        'code',
        'libelle',
        'description',
        'date_ajout',
        'iduser',
    ];
}
