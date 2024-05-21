<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matiere_id'
    ];
    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
