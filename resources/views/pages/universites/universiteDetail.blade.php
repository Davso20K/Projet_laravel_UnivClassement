@extends('layouts.app')
@section('content')

<head>
    <link rel="stylesheet" href="{{asset('css/commentaires.css')}}" />
</head>
<div class="" style="margin-left: 10px;margin-right: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ $universite->nom }}</div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Description :</strong></p>
                            <p>{{ $universite->description }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Site web :</strong></p>
                            <p><a href="{{ $universite->site_web }}" class="text-primary">{{ $universite->site_web }}</a></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Contact :</strong></p>
                            <p>{{ $universite->contact }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Adresse :</strong></p>
                            <p>{{ $universite->adresse }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Programmes d'étude :</strong></p>
                            <p>{{ $universite->programmes_etude }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Infrastructures :</strong></p>
                            <p>{{ $universite->infrastructures }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Historique :</strong></p>
                            <p>{{ $universite->historique }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Code postal :</strong></p>
                            <p>{{ $universite->BP }}</p>
                        </div>
                    </div>


                    <hr>


                    <div class="row mb-4" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <h4 style="margin-bottom: 20px;">Ajouter un commentaire</h4>
                            <form action="{{ route('commentaires.store', $universite->id )}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <textarea class="form-control" id="contenu" name="contenu" rows="3" required></textarea>
                                </div>
                                <button type="submit" style="margin-top:15px" class="btn btn-primary">Valider</button>
                            </form>
                        </div>
                    </div>


                    <div class="container mt-5">

                        <div class="row  d-flex justify-content-center">

                            <div class="col-md-8">

                                <div class="  justify-content-between  mb-3">
                                    <h5 style="margin-left: -150px;">Commentaires({{count($commentaires)}})</h5>


                                </div>

                                <div class="scrollView border rounded">
                                    @foreach ($commentaires as $commentaire)
                                    <div class="comment">
                                        <div class="comment-header d-flex justify-content-between">
                                            <div class="user d-flex flex-row align-items-center">
                                                <img src="{{ asset('icones/user.svg') }}" width="30" class="user-img rounded-circle mr-2">
                                                <span>
                                                    <h4 class="font-weight-bold text-primary">{{ $commentaire->auteur }}</h4>
                                                </span>
                                            </div>
                                            <h6>Posté le {{ $commentaire->created_at }}</h6>
                                        </div>
                                        <div class="comment-content">
                                            <p>{{ $commentaire->contenu }}</p>
                                        </div>
                                        @if(Auth::user()?->is_admin)
                                        <div class="comment-actions d-flex justify-content-between mt-2 align-items-center">
                                            <form action="{{ route('commentaires.destroy', $commentaire->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link">Supprimer</button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>


                            </div>


                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection