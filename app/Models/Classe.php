<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_classe',
        'matiere_id'
    ];
    public function matieres()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id', 'id');
    }
}
