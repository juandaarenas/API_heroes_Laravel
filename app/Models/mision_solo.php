<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mision_solo extends Model
{
    use HasFactory;
    protected $fillable = ['superheroe_id','misiones_id'];
}