<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfesseurRequest;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use App\Models\Professeur;
use App\Models\Matiere;
use App\Models\User;


class CreationProfesseurController extends Controller
{

    public function create(User $user)
    {
        $matieres = Matiere::pluck('nom_matiere', 'id');

        // Vérifier si la table des matières est vide
        if ($matieres->isEmpty()) {
            // Supprimer l'utilisateur $user de la table users
            $user->delete();

            return redirect()->back()->with('error', 'La liste des matières est vide.');
        }

        $professeur = new Professeur();
        return view('admin.users.create', compact('professeur', 'user', 'matieres'));
    }
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'matiere_id' => 'required|exists:matieres,id',
            // Ajoutez ici d'autres règles de validation si nécessaire
        ]);

        // Créer un nouveau professeur avec les données validées
        $professeur = new Professeur();
        $professeur->user_id = $validatedData['user_id'];
        $professeur->matiere_id = $validatedData['matiere_id'];
        // Ajouter d'autres attributs si nécessaire
        $professeur->save();

        // Rediriger vers une autre page après la création du professeur
        return redirect()->route('login')->with('success', 'Professeur créé.');
    }
}
