@extends('layouts.app')
@section('content')
@if(Auth::user()?->is_admin)


<h1>Liste des critères</h1>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCriteriaModal">
    Ajouter un critere
</button>
<table class="table">
    <thead>
        <tr>
            <th>Libellé</th>
            <th>Description</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($criteres as $critere)
        <tr>
            <td>{{ $critere->libelle }}</td>
            <td>{{ $critere->description }}</td>
            <td>{{ $critere->statut ? 'Actif' : 'Inactif' }}</td>
            <td>
                <a href="{{ route('criteres.show', $critere->id) }}">Details</a>
                <form action="{{ route('criteres.destroy', $critere->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce critère ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Modal d'ajout d'un critère -->
<div class="modal fade" id="addCriteriaModal" tabindex="-1" role="dialog" aria-labelledby="addCriteriaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCriteriaModalLabel">Ajouter un critère</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addCriteriaForm" method="POST" action="{{ route('criteres.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="libelle">Libellé</label>
                        <input type="text" class="form-control" id="libelle" name="libelle" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="statut">Statut</label>
                        <select class="form-control" id="statut" name="statut" required>
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection