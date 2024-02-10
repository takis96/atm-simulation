<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtmNote extends Model
{
    use HasFactory;
    protected $fillable = ['note_value', 'quantity'];
}

