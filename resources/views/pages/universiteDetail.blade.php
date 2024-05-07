@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ $universite->nom }}</div>

                <div class="card-body">
                    <p><strong>Description :</strong> {{ $universite->description }}</p>
                    <p><strong>Site web :</strong> <a href="{{ $universite->site_web }}" class="text-primary">{{ $universite->site_web }}</a></p>
                    <p><strong>Contact :</strong> {{ $universite->contact }}</p>
                    <p><strong>Adresse :</strong> {{ $universite->adresse }}</p>
                    <p><strong>Programmes d'étude :</strong> {{ $universite->programmes_etude }}</p>
                    <p><strong>Infrastructures :</strong> {{ $universite->infrastructures }}</p>
                    <p><strong>Historique :</strong> {{ $universite->historique }}</p>
                    <p><strong>Code postal :</strong> {{ $universite->BP }}</p>
                    <p><strong>Statut :</strong> {{ $universite->statut ? 'Actif' : 'Inactif' }}</p>

                    <hr>

                    <h4 class="mb-4">Commentaires</h4>
                    @foreach ($commentaires as $commentaire)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $commentaire->auteur }}</h5>
                            <p class="card-text">{{ $commentaire->contenu }}</p>
                        </div>
                    </div>
                    @endforeach

                    @auth
                    <hr>
                    <h4 class="mb-4">Ajouter un commentaire</h4>
                    <form action="{{ route('commentaires.store', $universite->id )}}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="contenu">Commentaire :</label>
                            <textarea class="form-control" id="contenu" name="contenu" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection