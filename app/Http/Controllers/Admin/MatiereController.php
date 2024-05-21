<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Http\Requests\Admin\MatiereRequest;

class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.matieres.index', [
            'matieres' => Matiere::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.matieres.updateCreate', [
            'matiere' => new Matiere()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MatiereRequest $request)
    {
        $matiere = Matiere::create($request->validated());
        return to_route('admin.matiere.index')->with('success', 'enregistré');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matiere $matiere)
    {
        // dd($matiere);
        return view('admin.matieres.updateCreate', [
            'matiere' => $matiere
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MatiereRequest $request, Matiere $matiere)
    {
        $matiere->update($request->validated());
        return to_route('admin.matiere.index')->with('success', 'Modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matiere $matiere)
    {
        $matiere->delete();
        return to_route('admin.matiere.index')->with('success', 'supprimer');
    }
}
