<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfesseurRequest;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\User;


class CreationEleveController extends Controller
{
    public function create(User $user)
    {
        $classes = Classe::pluck('nom_classe', 'id');

        // Vérifier si la liste des classes est vide
        if ($classes->isEmpty()) {
            // Supprimer l'utilisateur
            $user->delete();

            // Rediriger avec un message d'erreur
            return redirect()->back()->with('error', 'La liste des classes est vide.');
        }

        $eleve = new Eleve();
        return view('admin.eleves.create', compact('eleve', 'user', 'classes'));
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'classe_id' => 'required|exists:classes,id',
            // Ajoutez ici d'autres règles de validation si nécessaire
        ]);

        // Créer un nouveau professeur avec les données validées
        $eleve = new Eleve();
        $eleve->user_id = $validatedData['user_id'];
        $eleve->classe_id = $validatedData['classe_id'];
        // Ajouter d'autres attributs si nécessaire
        $eleve->save();

        // Rediriger vers une autre page après la création du professeur
        return redirect()->route('login')->with('success', 'eleve créée.');
    }
}
