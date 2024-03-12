<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterProducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_product',
        'main',
        'cpu',
        'ram',
        'vga',
        'hhd',
        'ssd',
        'psu',
        'case',
    ];
}
