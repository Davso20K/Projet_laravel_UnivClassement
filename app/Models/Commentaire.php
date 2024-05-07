<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $table = "commentaires";
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id', 'utilisateur_id');
    }
    public function universite()
    {
        return $this->belongsTo(Universite::class, 'id', 'universite_id');
    }
}
