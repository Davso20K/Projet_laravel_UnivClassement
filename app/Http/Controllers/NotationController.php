<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Notation;
use App\Models\Universite;
use Illuminate\Http\Request;

class NotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $universiteId)
    {
        //

        $universite = Universite::findOrFail($universiteId);
        $notes = $request->input('notes');
        foreach ($notes as $critereId => $note) {
            $notation = new Notation();
            $notation->valeur = $note;
            $notation->critere_id = $critereId;
            $notation->utilisateur_id = auth()->user()->id;
            $notation->universite_id = $universite->id;
            $notation->statut = 1;
            $notation->save();
        }
        return redirect()->route('universites.index')->with('success', 'université notée avec succès');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notation $notation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notation $notation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $universiteId)
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $userId = auth()->user()->id;
        $notesByCriteria = $this->getNotesByUniversityAndUser($universiteId)->original['notesByCriteria'];

        $notes = $request->input('notes');
        foreach ($notes as $criteriaId => $note) {
            if (array_key_exists($criteriaId, $notesByCriteria)) {
                $notation = Notation::where('universite_id', $universiteId)
                    ->where('utilisateur_id', $userId)
                    ->where('critere_id', $criteriaId)
                    ->first();
                $notation->valeur = $note;
                $notation->save();
            } else {
                $notation = new Notation();
                $notation->valeur = $note;
                $notation->critere_id = $criteriaId;
                $notation->utilisateur_id = $userId;
                $notation->universite_id = $universiteId;
                $notation->statut = 1;
                $notation->save();
            }
        }

        return response()->json(['success' => true]);
    }


    public function getNotesByUniversityAndUser($universiteId)
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $notes = Notation::where('universite_id', $universiteId)
                ->where('utilisateur_id', $userId)
                ->get();

            $notesByCriteria = [];
            foreach ($notes as $note) {
                $notesByCriteria[$note->critere_id] = $note->valeur;
            }

            $criteres = Critere::all();

            return response()->json(['notesByCriteria' => $notesByCriteria, 'criteres' => $criteres]);
        }

        return response()->json(['error' => 'User not authenticated'], 401);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notation $notation)
    {
        //
    }
}
