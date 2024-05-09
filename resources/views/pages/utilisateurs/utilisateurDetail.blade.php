@extends('layouts.app')

@section('content')
@auth

<head>
    <style>
        .container {
            max-width: 1450px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>
<div class="container">
    <h1>Détails de l'utilisateur</h1>

    <p><strong>Nom :</strong> {{ $utilisateur->name }}</p>
    <p><strong>Email :</strong> {{ $utilisateur->email }}</p>
    <p><strong>Date de naissance :</strong> {{ $utilisateur->date_naiss }}</p>
    <p><strong>Statut :</strong> {{ $utilisateur->est_actif ? 'Actif' : 'Inactif' }}</p>
    <p><strong>Vérifié le :</strong> {{ $utilisateur->email_verified_at }}</p>
    <p><strong>Créé le :</strong> {{ $utilisateur->created_at }}</p>
    <p><strong>Mis à jour le :</strong> {{ $utilisateur->updated_at }}</p>
    <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
        @if($utilisateur->est_actif)
        <div class="col-md-4">

            <a href="{{ route('utilisateurs.desactiver', $utilisateur->id) }}" class="btn " title="Désactiver ce compte utilisateur">
                <img src="{{ asset('icones/activated.svg') }}" style="height: 30px;width:150px;" />
            </a>
        </div>
        @else
        <div class="col-md-4">

            <a href="{{ route('utilisateurs.activer', $utilisateur->id) }}" class="btn " title="Activer ce compte utilisateur">
                <img src="{{ asset('icones/desactivated.svg') }}" style="height: 30px;width:150px;" />
            </a>
        </div>
        @endif
        <form action="{{ route('utilisateurs.destroy', $utilisateur->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" title="Cliquez pour supprimer cet utilisateur">
                <img src="{{ asset('icones/supprimer.svg') }}" style="height: 30px;" />
            </button>
        </form>
    </div>
</div>
@endauth
@endsection