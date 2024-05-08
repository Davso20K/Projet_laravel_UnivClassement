<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use Illuminate\Http\Request;

class CritereController extends Controller
{

    public function index()
    {

        $criteres = Critere::all();
        return view('pages.criteres.criteres', compact('criteres'));
    }


    public function create()
    {
        //
    }


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


    public function show(Critere $critere)
    {

        return view('pages.criteres.critereDetail', compact('critere'));
    }


    public function edit(Critere $critere)
    {

        return view('pages.criteres.critereEdit', compact('critere'));
    }


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



    public function destroy(Critere $critere)
    {

        $critere->delete();
        return redirect()->route('criteres.index')->with('success', 'Critère supprimée avec succès.');
    }
}
