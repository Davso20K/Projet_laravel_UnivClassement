@extends('layouts.app')

@section('content')
@auth
@if(Auth::user()?->is_admin and Auth::user()?->est_actif)

<h1>Liste des utilisateurs</h1>

<table class="table">
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
                <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                    <a href="{{ route('utilisateurs.show', $utilisateur->id) }}" class="btn btn-primary" title="Voir les détails de cet utilisateur">
                        <img src="{{ asset('icones/infos.svg') }}" style="height: 30px;" />
                    </a>
                    @if($utilisateur->est_actif)
                    <a href="{{ route('utilisateurs.desactiver', $utilisateur->id) }}" class="btn " title="Désactiver ce compte utilisateur">
                        <img src="{{ asset('icones/activated.svg') }}" style="height: 30px;" />
                    </a>
                    @else
                    <a href="{{ route('utilisateurs.activer', $utilisateur->id) }}" class="btn " title="Activer ce compte utilisateur">
                        <img src="{{ asset('icones/desactivated.svg') }}" style="height: 30px;" />
                    </a>
                    @endif
                    <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Cliquez pour supprimer cet utilisateur">
                            <img src="{{ asset('icones/supprimer.svg') }}" style="height: 30px;" />
                        </button>
                    </form>
                </div>
            </td>


        </tr>
        @endforeach
    </tbody>
</table>
@else
Ce compte est désactivé.

@endif
@endauth
@endsection