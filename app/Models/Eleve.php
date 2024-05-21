<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'classe_id'
    ];
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'eleve_id');
    }
}
