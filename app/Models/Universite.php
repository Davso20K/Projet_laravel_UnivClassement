<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universite extends Model
{
    use HasFactory;
    protected $table = "universites";
    public function notations()
    {
        return $this->hasMany(Notation::class);
    }
}
