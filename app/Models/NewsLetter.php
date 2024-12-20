<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;
    protected $table = "formNewsLetter";
    protected $fillable = [
        'email',
        'politica',
        'token',
        'verificacion_email',
        'created_at',
        'updated_at'
    ];
}
