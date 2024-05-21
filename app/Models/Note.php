<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'note',
        'moyenne',
        'eleve_id',
    ];
    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id', 'id');
    }
    public function bulletin()
    {
        return $this->hasMany(Bulletin::class, 'note_id');
    }
}
