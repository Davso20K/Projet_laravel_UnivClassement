<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        //
        $utilisateurs = User::all();
        return view('pages.utilisateurs.utilisateurs', compact('utilisateurs'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(User $utilisateur)
    {

        return view('pages.utilisateurs.utilisateurDetail', compact('utilisateur'));
    }


    public function edit(User $user)
    {
        //
    }


    public function update(Request $request, $userId)
    {
        //
    }
    public function desactiver(Request $request, $userId)
    {

        // echo ($userId);
        $Utilisateur = User::find($userId);



        $Utilisateur->est_actif = false;
        $Utilisateur->save();
        return redirect()->route('utilisateurs.index')->with('success', 'utilisateur désactivé avec succès');
    }
    public function activer(Request $request, $userId)
    {

        // echo ($userId);
        $Utilisateur = User::find($userId);



        $Utilisateur->est_actif = true;
        $Utilisateur->save();
        return redirect()->route('utilisateurs.index')->with('success', 'utilisateur activé avec succès');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->commentaires()->delete();
        $user->notations()->delete();
        $user->delete();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
