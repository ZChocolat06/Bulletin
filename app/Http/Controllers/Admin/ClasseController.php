<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classe;
use App\Models\Matiere;
use App\Http\Requests\Admin\ClasseRequest;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.classes.index', [
            'classes' => Classe::orderBy('created_at', 'desc')->get()
        ]);

        $classes = Classe::select('classes.id as id_classe', 'classes.*', 'matieres.id as id_matiere', 'matieres.*')
        ->join('matieres', 'classes.matiere_id', '=', 'matieres.id')
        ->get();
        return view('admin.classes.index', [
            'classes' => $classes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classe = new Classe();
        $matieres = Matiere::pluck('nom_matiere', 'id');
        return view('admin.classes.create', compact('classe', 'matieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClasseRequest $request)
    {
        $classe = Classe::create($request->validated());
        return to_route('admin.classe.index')->with('success', 'enregistré');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $classe)
    {
        // Suppression de dd($classe)
        $matieres = Matiere::pluck('nom_matiere', 'id'); // Assurez-vous que 'nom' est le bon champ à afficher dans le select

        return view('admin.classes.update', [
            'classe' => $classe,
            'matieres' => $matieres,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ClasseRequest $request, Classe $classe)
    {
        $classe->update($request->validated());
        return to_route('admin.classe.index')->with('success', 'Modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $classe)
    {
        $classe->delete();
        return to_route('admin.classe.index')->with('success', 'supprimer');
    }
}
