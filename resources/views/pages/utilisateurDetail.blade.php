@extends('layouts.app')

@section('content')
<h1>Détails de l'utilisateur</h1>
<p><strong>Nom :</strong> {{ $utilisateur->name }}</p>
<p><strong>Email :</strong> {{ $utilisateur->email }}</p>
<p><strong>Date de naissance :</strong> {{ $utilisateur->date_naiss }}</p>
<p><strong>Statut :</strong> {{ $utilisateur->est_actif ? 'Actif' : 'Inactif' }}</p>
<p><strong>Vérifié le :</strong> {{ $utilisateur->email_verified_at }}</p>
<p><strong>Créé le :</strong> {{ $utilisateur->created_at }}</p>
<p><strong>Mis à jour le :</strong> {{ $utilisateur->updated_at }}</p>
@endsection