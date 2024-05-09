@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editer l'université</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('universites.update', $universite->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="nom">Nom de l'université</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $universite->nom }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required>{{ $universite->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="site_web">Site Web</label>
                            <input type="text" class="form-control" id="site_web" name="site_web" value="{{ $universite->site_web }}" required>
                        </div>

                        <div class="form-group">
                            <label for="contact">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact" value="{{ $universite->contact }}" required>
                        </div>

                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ $universite->adresse }}" required>
                        </div>

                        <div class="form-group">
                            <label for="programmes_etude">Programmes d'étude</label>
                            <input type="text" class="form-control" id="programmes_etude" name="programmes_etude" value="{{ $universite->programmes_etude }}" required>
                        </div>

                        <div class="form-group">
                            <label for="infrastructures">Infrastructures</label>
                            <input type="text" class="form-control" id="infrastructures" name="infrastructures" value="{{ $universite->infrastructures }}" required>
                        </div>

                        <div class="form-group">
                            <label for="historique">Historique</label>
                            <textarea class="form-control" id="historique" name="historique" required>{{ $universite->historique }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="BP">Boîte postale</label>
                            <input type="text" class="form-control" id="BP" name="BP" value="{{ $universite->BP }}" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">

                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button style="margin-top: 15px;" type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection