<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sous_Domaine extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_sousdo';
    protected $table = 'sous_domaine';
    protected $fillable = [
        'titre_sousdo',
        'id_do',
        'des_sousdo',

    ];
}
