<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formations extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_formation';
    protected $table = 'formation';
    protected $fillable = [
        'titre_for',
        'des_for',
        'cout_for',
        'ex_for',
        'type_cout',
        'type_for',
//        'id_four',

    ];
}
