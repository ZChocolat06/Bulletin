<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_matiere'
    ];
    public function professeurs()
    {
        return $this->hasMany(Professeur::class, 'matiere_id');
    }
    public function eleves()
    {
        return $this->hasMany(Eleve::class, 'classe_id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'matiere_id');
    }
    public function classe()
    {
        return $this->hasMany(Classe::class, 'matiere_id');
    }
}
