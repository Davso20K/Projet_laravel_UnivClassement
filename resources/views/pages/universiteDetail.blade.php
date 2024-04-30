@extends('layouts.app')

@section('content')
<h1>{{ $universite->nom }}</h1>
<p>{{ $universite->description }}</p>
<p>Site web : <a href="{{ $universite->site_web }}">{{ $universite->site_web }}</a></p>
<p>Contact : {{ $universite->contact }}</p>
<p>Adresse : {{ $universite->adresse }}</p>
<p>Programmes d'étude : {{ $universite->programmes_etude }}</p>
<p>Infrastructures : {{ $universite->infrastructures }}</p>
<p>Historique : {{ $universite->historique }}</p>
<p>Code postal : {{ $universite->BP }}</p>
<p>Statut : {{ $universite->statut ? 'Actif' : 'Inactif' }}</p>
@endsection