<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NoteRequest;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Eleve;
use App\Models\User;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::select('notes.id as id_note', 'notes.note', 'notes.moyenne', 'classes.*', 'matieres.*', 'eleves.*', 'users.*')
            ->join('eleves', 'notes.eleve_id', '=', 'eleves.id')
            ->join('users', 'eleves.user_id', '=', 'users.id')
            ->join('classes', 'eleves.classe_id', '=', 'classes.id')
            ->join('matieres', 'classes.matiere_id', '=', 'matieres.id') // Remplacez 'nom_colonne_matiere_id' par le nom correct
            ->get();

        return view('admin.notes.index', [
            'notes' => $notes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     // Charger les élèves avec les informations de l'utilisateur et de la classe associées
    //     $eleves = Eleve::with(['user', 'classe'])->get();

    //     // Créer une collection de données pour les options du formulaire
    //     $eleves = $eleves->map(function ($eleve) {
    //         $nomUtilisateur = $eleve->user->nom_user;
    //         $prenomUtilisateur = $eleve->user->prenom;
    //         $nomClasse = $eleve->classe->nom_classe;
    //         return [
    //             'id' => $eleve->id,
    //             'label' => "$nomUtilisateur $prenomUtilisateur (Classe: $nomClasse)"
    //         ];
    //     })->pluck('label', 'id');

    //     $note = new Note();

    //     return view('admin.notes.updateCreate', compact('note', 'eleves', 'matieres'));
    // }

    public function create()
{
    // Charger les élèves avec les informations de l'utilisateur, de la classe et de la matière associées
    $eleves = Eleve::with('user', 'classe.matieres')->get();

    // Créer une collection de données pour les options du formulaire
    $elevesOptions = $eleves->map(function ($eleve) {
        $nomUtilisateur = $eleve->user->nom_user;
        $prenomUtilisateur = $eleve->user->prenom;
        $nomClasse = $eleve->classe->nom_classe;
        $nomMatiere = $eleve->classe->matieres->nom_matiere;
        return [
            'id' => $eleve->id,
            'label' => "$nomUtilisateur $prenomUtilisateur (Classe: $nomClasse, Matière: $nomMatiere)"
        ];
    })->pluck('label', 'id');

    $note = new Note();

    return view('admin.notes.updateCreate', compact('note', 'elevesOptions'));
}




    /**
     * Store a newly created resource in storage.
     */

    public function store(NoteRequest $request)
    {
        $validatedData = $request->validated();

        // Calculer la moyenne en fonction des données validées
        $moyenne = 0;

        // Ajouter la moyenne aux données validées
        $validatedData['moyenne'] = $moyenne;

        // Créer la note avec les données validées
        $note = Note::create($validatedData);

        return redirect()->route('admin.note.index')->with('success', 'Note enregistrée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
       return view('admin.notes.update', [
           'note' => $note,
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
            // Validation des données
        $validated = $request->validate([
            'note' => 'required|integer'
        ]);

        $note->update($validated);
        return redirect()->route('admin.note.index')->with('success', 'Note mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_note)
    {
        // Recherche du note à supprimer en utilisant l'identifiant
        $note = Note::findOrFail($id_note);

        // Suppression du note
        $note->delete();


        // Redirection vers la liste des notes avec un message de succès
        return redirect()->route('admin.note.index')->with('success', 'Note supprimée avec succès');
    }

}
