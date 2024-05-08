@extends('layouts.app')

@section('content')
@auth
<h1>Détails du critère</h1>
<p><strong>Libellé :</strong> {{ $critere->libelle }}</p>
<p><strong>Description :</strong> {{ $critere->description }}</p>
<p><strong>Statut :</strong> {{ $critere->statut ? 'Actif' : 'Inactif' }}</p>
<p><strong>Créé le :</strong> {{ $critere->created_at }}</p>
<p><strong>Mis à jour le :</strong> {{ $critere->updated_at }}</p>
@endauth
@endsection