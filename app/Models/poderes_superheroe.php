<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class poderes_superheroe extends Model
{
    use HasFactory;
    protected $fillable = ['superheroe_id','superpoderes_id','niveles'];
}