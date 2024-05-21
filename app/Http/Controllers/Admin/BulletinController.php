<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BulletinRequest;
use Illuminate\Http\Request;
use App\Models\Bulletin;
use App\Models\Matiere;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bulletins = Bulletin::select(
            'bulletins.id as bulletin_id',
            'bulletins.annee',
            'bulletins.commentaire',
            'bulletins.trimestre',
            'notes.note as note_val',
            'notes.moyenne as moyenne_val',
            'eleves.id as eleve_id',
            'users.nom_user',
            'users.prenom',
            'matieres.nom_matiere',
            'classes.nom_classe'
        )
        ->join('notes', 'bulletins.note_id', '=', 'notes.id')
        ->join('eleves', 'notes.eleve_id', '=', 'eleves.id')
        ->join('users', 'eleves.user_id', '=', 'users.id')
        ->join('classes', 'eleves.classe_id', '=', 'classes.id')
        ->join('matieres', 'classes.matiere_id', '=', 'matieres.id')
        ->get();

        return view('admin.bulletins.index', [
            'bulletins' => $bulletins
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Charger les notes avec les informations de l'élève, de la classe et de la matière associées
    $notes = Note::with('eleve.user', 'eleve.classe.matieres')->get();

    // Créer une collection de données pour les options du formulaire
    $notesOptions = $notes->map(function ($note) {
        $nomEleve = $note->eleve->user->nom_user;
        $prenomEleve = $note->eleve->user->prenom;
        $nomClasse = $note->eleve->classe->nom_classe;
        $nomMatiere = $note->eleve->classe->matieres->nom_matiere;
        $noteValue = $note->note;
        $moyenneValue = $note->moyenne;
        return [
            'id' => $note->id,
            'label' => "Élève: $nomEleve $prenomEleve (Classe: $nomClasse, Matière: $nomMatiere) - Note: $noteValue, Moyenne: $moyenneValue"
        ];
    })->pluck('label', 'id');

    $bulletin = new Bulletin();

    return view('admin.bulletins.updateCreate', compact('bulletin', 'notesOptions'));
}



    /**
     * Store a newly created resource in storage.
     */
    // public function store(BulletinRequest $request)
    // {

    //     $validatedData = $request->validated();

    //     // Ajouter l'année actuelle
    //     $validatedData['annee'] = Carbon::now()->year;

    //     // Vérifier et ajouter une valeur par défaut pour le champ commentaire
    //     if (!isset($validatedData['commentaire'])) {
    //         $validatedData['commentaire'] = ''; // ou une valeur par défaut appropriée
    //     }

    //     $bulletin = Bulletin::create($validatedData);

    //     return to_route('admin.bulletin.index')->with('success', 'enregistré');

    // }
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'note_id' => ['required', 'exists:notes,id'],
            'commentaire' => ['required', 'string'],
            'trimestre' => ['required', 'integer']
        ]);

        // Créer un nouveau modèle Bulletin avec les données validées
        $bulletin = new Bulletin();

        // Remplir les champs du bulletin avec les données du formulaire
        $bulletin->fill($validatedData);

        // Définir l'année sur l'année actuelle au format Y-m-d
        $bulletin->annee = Carbon::now()->format('Y-m-d');

        // Sauvegarder le bulletin
        $bulletin->save();

        // Rediriger vers une autre page après la création du bulletin
        return redirect()->route('admin.bulletin.index')->with('success', 'Bulletin créé avec succès.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
            // Trouver le bulletin à modifier par son ID
        $bulletin = Bulletin::findOrFail($id);

        // Charger les notes avec les informations de l'élève, de la classe et de la matière associées
        $notes = Note::with('eleve.user', 'eleve.classe.matieres')->get();

        // Créer une collection de données pour les options du formulaire
        $notesOptions = $notes->map(function ($note) {
            $nomEleve = $note->eleve->user->nom_user;
            $prenomEleve = $note->eleve->user->prenom;
            $nomClasse = $note->eleve->classe->nom_classe;
            $nomMatiere = $note->eleve->classe->matieres->nom_matiere;
            return [
                'id' => $note->id,
                'label' => "Élève: $nomEleve $prenomEleve (Classe: $nomClasse, Matière: $nomMatiere)"
            ];
        })->pluck('label', 'id');
       return view('admin.bulletins.update', [
           'bulletin' => $bulletin,
           'notesOptions' => $notesOptions
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bulletin $bulletin)
    {
            // Validation des données
        $validated = $request->validate([
            'nom_user' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'matiere_id' => 'required|exists:matieres,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Mise à jour de l'utilisateur associé au bulletin
        $user = User::find($bulletin->user_id);
        $user->nom_user = $validated['nom_user'];
        $user->prenom = $validated['prenom'];
        $user->email = $validated['email'];
        $user->role = 'Utilisateur'; // Forcer le rôle à "Utilisateur"
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Mise à jour des informations du bulletin
        $bulletin->matiere_id = $validated['matiere_id'];
        $bulletin->save();

        return redirect()->route('admin.bulletin.index')->with('success', 'Bulletin mis à jour avec succès.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_prof)
    {
        // Recherche du bulletin à supprimer en utilisant l'identifiant
        $bulletin = Bulletin::findOrFail($id_prof);

        // Suppression du bulletin
        $bulletin->delete();

        // Supprimer l'utilisateur associé
        $bulletin->user()->delete();

        // Redirection vers la liste des bulletins avec un message de succès
        return redirect()->route('admin.bulletin.index')->with('success', 'Bulletin et utilisateur associé supprimés avec succès');
    }

}
