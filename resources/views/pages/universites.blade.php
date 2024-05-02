@extends('layouts.app')

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<h1>Liste des universités</h1>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUniversiteModal">
    Ajouter une université
</button>
@if (count($criteres) > 0)
<div class="form-group">
    <label for="criteria">Critères de classement:</label>
    <div class="form-check">
        @foreach ($criteres as $critere)
        <input type="checkbox" class="form-check-input" id="criteria_{{ $critere->id }}" name="criteria[]" value="{{ $critere->id }}" checked>
        <label class="form-check-label" for="criteria_{{ $critere->id }}">{{ $critere->libelle }}</label>
        <br>
        @endforeach
    </div>
</div>
@endif
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Site web</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($universites as $universite)
        <tr>
            <td>{{ $universite->nom }}</td>
            <td>{{ $universite->description }}</td>
            <td><a href="{{ $universite->site_web }}">{{ $universite->site_web }}</a></td>
            <td>
                <a href="{{ route('universites.show', $universite->id) }}">Voir</a>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NoteUniversiteModal" data-universite-id="{{ $universite->id }}">
                    Noter {{ $universite->id }}
                </button>
                <a href="{{ route('universites.edit', $universite->id) }}">Modifier</a>
                @if (count($criteres) > 0)
            <td colspan="{{ count($criteres) }}">
                {{ isset($universite->rankingScore) ? number_format($universite->rankingScore, 2) : 'Non classé' }}
            </td>
            @endif
            <form action="{{ route('universites.destroy', $universite->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette université ?');">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



<!-- Modal d'ajout d'une université -->
<div class="modal fade" id="createUniversiteModal" tabindex="-1" role="dialog" aria-labelledby="createUniversiteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('universites.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createUniversiteModalLabel">Ajouter une université</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_web">Site web</label>
                                <input type="url" class="form-control" id="site_web" name="site_web">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="programmes_etude">Programmes d'étude</label>
                                <input type="text" class="form-control" id="programmes_etude" name="programmes_etude">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="infrastructures">Infrastructures</label>
                                <input type="text" class="form-control" id="infrastructures" name="infrastructures">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="historique">Historique</label>
                                <input type="text" class="form-control" id="historique" name="historique">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="BP">Code postal</label>
                                <input type="text" class="form-control" id="BP" name="BP">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="statut" name="statut" checked>
                        <label class="form-check-label" for="statut">Statut actif</label>
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
<!-- Modal de notation d'une université -->
<div class="modal fade" id="NoteUniversiteModal" tabindex="-1" role="dialog" aria-labelledby="NoteUniversiteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NoteUniversiteModalLabel">Noter l'université</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="noteUniversiteForm" method="POST">
                @csrf
                @method('PUT')
                <input type="text" name="universite_id" id="universite_id">
                <div class="modal-body">
                    <div id="criteriaInputs"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#NoteUniversiteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var universiteId = button.data('universite-id');
            var modal = $(this);
            modal.find('#universite_id').val(universiteId);

            // Requête AJAX pour obtenir les critères de notation
            $.ajax({
                url: `/notations/get/${universiteId}`,
                method: 'GET',
                success: function(response) {
                    var notesByCriteria = response.notesByCriteria;
                    var criteres = response.criteres;

                    var criteriaInputs = '';
                    $.each(criteres, function(index, critere) {
                        var noteValue = notesByCriteria[critere.id] ? notesByCriteria[critere.id] : 0;
                        criteriaInputs += `
                <div class="form-group">
                    <label for="note_${critere.id}">${critere.libelle}</label>
                    <input type="number" class="form-control" id="note_${critere.id}" name="notes[${critere.id}]" min="0" max="10" value="${noteValue}" required>
                </div>
            `;
                    });
                    $('#criteriaInputs').html(criteriaInputs);
                },
                error: function() {
                    alert('Erreur lors de la récupération des critères de notation.');
                }
            });

        });

        $('#noteUniversiteForm').on('submit', function(event) {
            event.preventDefault();
            var universiteId = $('#universite_id').val();
            $.ajax({
                url: `/notations/update/${universiteId}`,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#NoteUniversiteModal').modal('hide');
                        alert('Notation enregistrée avec succès.');
                    }
                },
                error: function() {
                    alert('Erreur lors de l\'enregistrement de la notation.');
                }
            });
        });

    });



    const criteriaCheckboxes = document.querySelectorAll('input[name="criteria[]"]');
    const criteria = {
        ...($criteres || []).reduce((acc, critere) => {
            acc[critere.id] = {
                description: critere.description
            };
            return acc;
        }, {}),
    };

    function getAverageRating(university, criterionId) {
        const ratings = university.notes.filter(note => note.critere_id === criterionId);
        if (ratings.length > 0) {
            return ratings.reduce((acc, rating) => acc + rating.valeur, 0) / ratings.length;
        }
        return 0;
    }

    function calculateRankingScore(university) {
        let score = 0;
        criteriaCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const criterionId = parseInt(checkbox.value);
                const averageRating = getAverageRating(university, criterionId);
                const criterion = criteria[criterionId];
                score += averageRating * criterion.description;
            }
        });
        return score;
    }

    function updateRankingScores() {
        universities.forEach(university => {
            university.rankingScore = calculateRankingScore(university);
        });
    }

    criteriaCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateRankingScores);
    });

    updateRankingScores();
    if ($selectedCriteriaIds) {
        criteriaCheckboxes.forEach(checkbox => {
            if ($selectedCriteriaIds.includes(parseInt(checkbox.value))) {
                checkbox.checked = true;
            }
        });
    };
</script>


@endsection