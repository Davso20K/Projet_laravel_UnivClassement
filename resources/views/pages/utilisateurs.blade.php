@extends('layouts.app')

@section('content')
@auth
<h1>Liste des utilisateurs</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Date de naissance</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($utilisateurs as $utilisateur)
        <tr>
            <td>{{ $utilisateur->name }}</td>
            <td>{{ $utilisateur->email }}</td>
            <td>{{ $utilisateur->date_naiss }}</td>
            <td>{{ $utilisateur->est_actif ? 'Actif' : 'Inactif' }}</td>
            <td>
                <a href="{{ route('utilisateurs.show', $utilisateur->id) }}">Voir</a>
                <a href="{{ route('utilisateurs.update', $utilisateur->id) }}">désactiver</a>
                <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endauth

@endsection