<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoRe extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_dore';
    protected $table = 'do_re';
    protected $fillable = [
        'session_do',
        'id_re',
        'id_sousdo',

    ];
}
