<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfesseurRequest;
use Illuminate\Http\Request;
use App\Models\Professeur;
use App\Models\Matiere;
use App\Models\User;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professeurs = Professeur::select('professeurs.id as id_prof', 'matieres.*', 'users.id as id_user', 'users.*')
            ->join('matieres', 'professeurs.matiere_id', '=', 'matieres.id')
            ->join('users', 'professeurs.user_id', '=', 'users.id')
            ->get();

        return view('admin.users.index', [
            'professeurs' => $professeurs
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professeur = new Matiere();
        $users = User::pluck('nom_user', 'id');
        $matieres = Matiere::pluck('nom_matiere', 'id');
        return view('admin.users.updateCreate', compact('professeur', 'users', 'matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfesseurRequest $request)
    {
        $professeur = Professeur::create($request->validated());
        return to_route('admin.professeur.index')->with('success', 'enregistré');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professeur $professeur)
    {
        // Récupérer toutes les matières pour le dropdown
        $matieres = Matiere::all();
        // Récupérer l'utilisateur associé au professeur
        $user = User::find($professeur->user_id);
        // dd($user);

       return view('admin.users.update', [
           'professeur' => $professeur,
           'matieres' => $matieres,
           'user' => $user
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professeur $professeur)
    {
            // Validation des données
        $validated = $request->validate([
            'nom_user' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'matiere_id' => 'required|exists:matieres,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Mise à jour de l'utilisateur associé au professeur
        $user = User::find($professeur->user_id);
        $user->nom_user = $validated['nom_user'];
        $user->prenom = $validated['prenom'];
        $user->email = $validated['email'];
        $user->role = 'Utilisateur'; // Forcer le rôle à "Utilisateur"
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Mise à jour des informations du professeur
        $professeur->matiere_id = $validated['matiere_id'];
        $professeur->save();

        return redirect()->route('admin.professeur.index')->with('success', 'Professeur mis à jour avec succès.');

    }
    public function approve($id)
    {
        $user = User::findOrFail($id);

        // Modifier la valeur de non_valide à 1
        $user->non_valide = 1;
        $user->save();

        // Rediriger avec un message de succès
        return redirect()->route('admin.professeur.index')->with('success', 'Professeur validé avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_prof)
    {
        // Recherche du professeur à supprimer en utilisant l'identifiant
        $professeur = Professeur::findOrFail($id_prof);

        // Suppression du professeur
        $professeur->delete();

        // Supprimer l'utilisateur associé
        $professeur->user()->delete();

        // Redirection vers la liste des professeurs avec un message de succès
        return redirect()->route('admin.professeur.index')->with('success', 'Professeur et utilisateur associé supprimés avec succès');
    }

}
