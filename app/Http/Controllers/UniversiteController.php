<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Universite;
use Illuminate\Http\Request;
use App\Http\Controllers\NotationController;
use App\Models\Notation;

class UniversiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $universites = Universite::all();
        $criteres = Critere::all();

        // Calcul des moyennes de notation pour chaque critère et chaque université
        foreach ($universites as $universite) {
            foreach ($criteres as $criterion) {
                $notations = Notation::where('universite_id', $universite->id)
                    ->where('critere_id', $criterion->id)
                    ->pluck('valeur')
                    ->toArray();
                $average = count($notations) > 0 ? array_sum($notations) / count($notations) : 0;
                $universite->setAttribute('average_' . $criterion->id, $average);
            }
        }

        return view('pages.universites', compact('universites', 'criteres'));
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
