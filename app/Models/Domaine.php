<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_do';
    protected $table = 'domaine';
    protected $fillable = [
        'des_do',
        'titre_do',
    ];
}
