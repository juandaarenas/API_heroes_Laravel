<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_mision extends Model
{
    use HasFactory;
    protected $fillable = ['nombreTmision'];
}