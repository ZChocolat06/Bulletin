<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;
    protected $fillable = [
        'commentaire','trimestre','annee','note_id'
    ];
    public function note()
    {
        return $this->belongsTo(Note::class, 'note_id', 'id');
    }
    
}
