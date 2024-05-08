<?php

namespace App\Http\Controllers;

use App\Models\Critere;
use App\Models\Notation;
use App\Models\Universite;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUtilisateurs = User::count();

        $totalUniversites = Universite::count();

        $totalCriteres = Critere::count();

        $totalUniversitesNotees = Notation::distinct('universite_id')->count('universite_id');

        return view('dashboard', compact('totalUtilisateurs', 'totalUniversites', 'totalCriteres', 'totalUniversitesNotees'));
    }
}
