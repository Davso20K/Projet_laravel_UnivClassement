<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Universite;
use Illuminate\Http\Request;
use App\Http\Controllers\NotationController;
use App\Models\Commentaire;
use App\Models\Notation;
use Illuminate\Support\Facades\Storage;

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
        $request->validate([

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:2048',
        ]);

        $imageName = 'univ_default.jpeg';

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/universites_images');
            $imageName = basename($imagePath);
        }

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
        $data->image = $imageName;
        $data->save();

        return redirect()->route('universites.index')->with('success', 'Université ajoutée avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Universite $universite)
    {
        //
        $commentaires = Commentaire::where('universite_id', $universite->id)
            ->join('users', 'users.id', '=', 'commentaires.utilisateur_id')
            ->select('commentaires.*', 'users.name as auteur')
            ->get();
        return view('pages.universiteDetail', compact('universite', 'commentaires'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Universite $universite)
    {
        //
        return view('pages.universiteEdit', compact('universite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $universite = Universite::findOrFail($id);

        // $request->validate([
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,JPEG,PNG,JPG,GIF,SVG|max:2048',

        // ]);

        // Sauvegarder l'ancienne image
        $ancienneImage = $universite->image;

        $universite->nom = $request->input('nom');
        $universite->description = $request->input('description');
        $universite->site_web = $request->input('site_web');
        $universite->contact = $request->input('contact');
        $universite->adresse = $request->input('adresse');
        $universite->programmes_etude = $request->input('programmes_etude');
        $universite->infrastructures = $request->input('infrastructures');
        $universite->historique = $request->input('historique');
        $universite->BP = $request->input('BP');

        if ($request->hasFile('image')) {
            // Stocker la nouvelle image
            $imagePath = $request->file('image')->store('public/universites_images');
            $imageName = basename($imagePath);
            $universite->image = $imageName;

            // Supprimer l'ancienne image
            Storage::delete('public/universites_images/' . $ancienneImage);
        }

        $universite->save();

        return redirect()->route('universites.show', $universite)->with('success', 'Université mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Universite $universite)
    {
        //
        $universite->notations()->delete();
        Commentaire::where('universite_id', $universite->id)->delete();
        $universite->delete();
        return redirect()->route('universites.index')->with('success', 'Université supprimée avec succès.');
    }
}
