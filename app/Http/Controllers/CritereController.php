<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use Illuminate\Http\Request;

class CritereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $criteres = Critere::all();
        return view('pages.criteres.criteres', compact('criteres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'required|string',
            'statut' => 'required|boolean',
        ]);

        $criteria = new Critere();
        $criteria->libelle = $validatedData['libelle'];
        $criteria->description = $validatedData['description'];
        $criteria->statut = $validatedData['statut'];
        $criteria->save();

        return redirect()->route('criteres.index')->with('success', 'Le critère a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Critere $critere)
    {
        //
        return view('pages.criteres.critereDetail', compact('critere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Critere $critere)
    {
        //
        return view('pages.criteres.critereEdit', compact('critere'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $critere = Critere::findOrFail($id);

        $request->validate([
            'libelle' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'statut' => 'required|boolean',
        ]);

        $critere->libelle = $request->input('libelle');
        $critere->description = $request->input('description');
        $critere->statut = $request->input('statut');

        $critere->save();

        return redirect()->route('criteres.index')->with('success', 'Critère mis à jour avec succès.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Critere $critere)
    {
        //
        $critere->delete();
        return redirect()->route('criteres.index')->with('success', 'Critère supprimée avec succès.');
    }
}
