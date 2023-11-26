<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mision_superheroes extends Model
{
    use HasFactory;
    protected $fillable = ['agrupacion_id','misiones_id'];
}