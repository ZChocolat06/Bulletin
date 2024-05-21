<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EleveRequest;
use Illuminate\Http\Request;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\User;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eleves = Eleve::select('eleves.id as id_eleve', 'classes.*', 'users.id as id_user', 'users.*')
        ->join('classes', 'eleves.classe_id', '=', 'classes.id')
        ->join('users', 'eleves.user_id', '=', 'users.id')
        ->get();
        return view('admin.eleves.index', [
            'eleves' => $eleves
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $eleve = new Classe();
        $users = User::pluck('nom_user', 'id');
        $classes = Classe::pluck('nom_classe', 'id');
        return view('admin.eleves.updateCreate', compact('eleve', 'users', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EleveRequest $request)
    {
        $eleve = Eleve::create($request->validated());
        return to_route('admin.eleve.index')->with('success', 'enregistré');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eleve $eleve)
    {
        // dd('fdfd');
        // Récupérer toutes les matières pour le dropdown
        $classes = Classe::all();
        // Récupérer l'utilisateur associé au eleve
        $user = User::find($eleve->user_id);
        // dd($user);

       return view('admin.eleves.update', [
           'eleve' => $eleve,
           'classes' => $classes,
           'user' => $user
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eleve $eleve)
    {
            // Validation des données
        $validated = $request->validate([
            'nom_user' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'classe_id' => 'required|exists:classes,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Mise à jour de l'utilisateur associé au eleve
        $user = User::find($eleve->user_id);
        $user->nom_user = $validated['nom_user'];
        $user->prenom = $validated['prenom'];
        $user->email = $validated['email'];
        $user->role = 'Utilisateur'; // Forcer le rôle à "Utilisateur"
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Mise à jour des informations du eleve
        $eleve->classe_id = $validated['classe_id'];
        $eleve->save();

        return redirect()->route('admin.eleve.index')->with('success', 'Eleve mis à jour avec succès.');

    }
    public function approve($id)
    {
        $user = User::findOrFail($id);

        // Modifier la valeur de non_valide à 1
        $user->non_valide = 1;
        $user->save();

        // Rediriger avec un message de succès
        return redirect()->route('admin.eleve.index')->with('success', 'eleve validé avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_prof)
    {
        // Recherche du eleve à supprimer en utilisant l'identifiant
        $eleve = Eleve::findOrFail($id_prof);

        // Suppression du eleve
        $eleve->delete();

        // Supprimer l'utilisateur associé
        $eleve->user()->delete();

        // Redirection vers la liste des eleves avec un message de succès
        return redirect()->route('admin.eleve.index')->with('success', 'Eleve et utilisateur associé supprimés avec succès');
    }

}
