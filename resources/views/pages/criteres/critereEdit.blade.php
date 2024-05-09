@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editer le critère</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('criteres.update', $critere->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="libelle">Libellé</label>
                            <input id="libelle" type="text" class="form-control" name="libelle" value="{{ $critere->libelle }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" class="form-control" name="description" required>{{ $critere->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="statut">Statut</label>
                            <select id="statut" class="form-control" name="statut" required>
                                <option value="1" {{ $critere->statut == 1 ? 'selected' : '' }}>Actif</option>
                                <option value="0" {{ $critere->statut == 0 ? 'selected' : '' }}>Inactif</option>
                            </select>
                        </div>

                        <button type="submit" style="margin-top: 15px;" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection