<?php

namespace App\Http\Controllers;

use App\Models\Universite;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $universites = Universite::all();

        return view('welcome', compact('universites'));
    }
}
