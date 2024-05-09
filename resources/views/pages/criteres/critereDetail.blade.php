@extends('layouts.app')

@section('content')
@auth

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

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

<body>
    <div class="container">
        <h1>Détails du critère</h1>

        <p><strong>Libellé :</strong> {{ $critere->libelle }}</p>
        <p><strong>Description :</strong> {{ $critere->description }}</p>
        <p><strong>Statut :</strong> {{ $critere->statut ? 'Actif' : 'Inactif' }}</p>
        <p><strong>Créé le :</strong> {{ $critere->created_at }}</p>
        <p><strong>Mis à jour le :</strong> {{ $critere->updated_at }}</p>
        <div class="btn-group" role="group">
            <div class="col-md-4">
                <a href="{{ route('criteres.edit', $critere->id) }}" class="btn " title="Mettre à jour les informations de ce critère">
                    <img src="{{ asset('icones/editer.svg') }}" style="height: 30px; width:150px;" />
                </a>
            </div>

            <form action="{{ route('criteres.destroy', $critere->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce critère ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <img src="{{ asset('icones/supprimer.svg') }}" style="height: 20px;" />
                </button>
            </form>
        </div>
    </div>
</body>

</html>
@endauth
@endsection