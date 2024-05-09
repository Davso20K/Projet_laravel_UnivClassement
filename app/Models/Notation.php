<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notation extends Model
{
    use HasFactory;
    protected $table = "notations";
    public function critere()
    {
        return $this->belongsTo(Critere::class, 'id', 'critere_id');
    }
    public function universite()
    {
        return $this->belongsTo(Universite::class, 'id', 'universite_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'utilisateur_id');
    }
}
