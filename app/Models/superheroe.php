<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class superheroe extends Model
{
    use HasFactory;
    protected $fillable = ['nombreHeroe','edad','planetas_id'];
}