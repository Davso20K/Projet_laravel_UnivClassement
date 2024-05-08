<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $commentaire = new Commentaire();
        $commentaire->utilisateur_id = auth()->user()->id;
        $commentaire->contenu = $request->contenu;
        $commentaire->universite_id = $request->universite_id;
        $commentaire->statut = True;
        $commentaire->save();

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès');
    }


    public function show(Commentaire $commentaire)
    {
        //
    }


    public function edit(Commentaire $commentaire)
    {
        //
    }



    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }


    public function destroy($commentaireId)
    {
        //
        $commentaireDel = Commentaire::find($commentaireId);
        $universiteId = $commentaireDel->universite_id;
        if (auth()->user()->is_admin) {
            $commentaireDel->delete();
            return redirect()->route('universites.show', $universiteId)->with('success', 'Commentaire supprimé avec succès.');
        } else {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à supprimer ce commentaire.');
        }
    }
}
