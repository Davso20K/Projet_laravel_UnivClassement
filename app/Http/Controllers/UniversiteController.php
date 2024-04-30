<?php

namespace App\Http\Controllers;

use App\Models\Universite;
use Illuminate\Http\Request;

class UniversiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $universites = Universite::all();
        return view('pages.universites', compact('universites'));
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
        //
        // $validatedData = $request->validate([
        //     'nom' => 'required',
        //     'description' => 'required',
        //     'site_web' => 'required|url',
        //     'contact' => 'required',
        //     'adresse' => 'required',
        //     'programmes_etude' => 'required',
        //     'infrastructures' => 'required',
        //     'historique' => 'required',
        //     'BP' => 'required',
        //     'statut' => 'boolean',
        // ]);
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
