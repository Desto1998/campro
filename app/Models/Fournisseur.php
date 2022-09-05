<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_four';
    protected $table = 'fournisseur';
    protected $fillable = [
        'nom_four',
        'type_four',
        'nomu_four',
        'tel_four',
        'email_four',
        'type_cout',
    ];
}
