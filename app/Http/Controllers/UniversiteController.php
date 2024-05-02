<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Universite;
use Illuminate\Http\Request;
use App\Http\Controllers\NotationController;

class UniversiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $universites = Universite::all();
        $criteres = Critere::all();
        if (auth()->check()) {
            $notationsController = new NotationController();
            foreach ($universites as $universite) {
                $universite->notes = $notationsController->getNotesByUniversityAndUser($universite->id);
            }
        }
        $selectedCriteriaIds = $request->input('criteria');
        return view('pages.universites', compact('universites', 'criteres', 'selectedCriteriaIds'));
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


        $data = new Universite();
        $data->nom = $request->input('nom');
        $data->description = $request->input('description');
        $data->site_web = $request->input('site_web');
        $data->contact = $request->input('contact');
        $data->adresse = $request->input('adresse');
        $data->programmes_etude = $request->input('programmes_etude');
        $data->infrastructures = $request->input('infrastructures');
        $data->historique = $request->input('historique');
        $data->BP = $request->input('BP');
        $data->statut = $request->has('statut') ? 1 : 0;

        $data->save();


        return redirect()->route('universites.index')->with('success', 'Université ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Universite $universite)
    {
        //
        return view('pages.universiteDetail', compact('universite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Universite $universite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Universite $universite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Universite $universite)
    {
        //

        $universite->delete();
        return redirect()->route('universites.index')->with('success', 'Université supprimée avec succès.');
    }
}
