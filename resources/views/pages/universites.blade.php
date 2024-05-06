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

<head>
    <link rel='stylesheet' href="{{asset('css/checkbox.css')}}">

</head>
<h1>Liste des universités</h1>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUniversiteModal">
    Ajouter une université
</button>
<div id="criteriaCheckboxes" data-criteres="{{ json_encode($criteres) }}">
    @if (count($criteres) > 0)
    <div class="form-group">
        <label for="criteria">Critères de classement:</label>
        <div class="form-check" style="align-content: center;">
            <ul style="display: flex; flex-wrap: wrap;">
                @foreach ($criteres as $critere)
                <li style="display: flex; align-items: center;">
                    <div class="checkbox-wrapper-26">
                        <input type="checkbox" id="criteria_{{ $critere->id }}" name="criteria[]" value="{{ $critere->id }}">
                        <label for="criteria_{{ $critere->id }}">
                            <div class="tick_mark"></div>
                        </label>
                    </div>
                    <label class="form-check-label" for="criteria_{{ $critere->id }}">{{ $critere->libelle }}</label>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>




<table class="table" id="universitiesTable" data-universities="{{ json_encode($universites) }}">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Description</th>
            <th>Site web</th>
            <th>Actions</th>


            <th>Statut</th>
            <th class="average-header" style="display: none;">Moyenne</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($universites as $universite)
        <tr data-universite-id="{{ $universite->id }}">
            <td>{{ $universite->nom }}</td>
            <td>{{ $universite->description }}</td>
            <td><a href="{{ $universite->site_web }}">{{ $universite->site_web }}</a></td>
            <td>
                <a href="{{ route('universites.show', $universite->id) }}">Voir</a>
                @auth
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NoteUniversiteModal" data-universite-id="{{ $universite->id }}">
                    Noter {{ $universite->id }}
                </button>
                <a href="{{ route('universites.edit', $universite->id) }}">Modifier</a>
                @if (count($criteres) > 0)
                <form action="{{ route('universites.destroy', $universite->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette université ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
                @endif
                @endauth
            </td>
            <td>Non classée</td>

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

@php
$universitesJson = json_encode($universites);
@endphp
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
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const criteriaCheckboxes = document.getElementById('criteriaCheckboxes');
        const universitiesTable = document.getElementById('universitiesTable');
        const universities = JSON.parse(universitiesTable.dataset.universities);

        criteriaCheckboxes.addEventListener('change', function() {
            const selectedCriteriaIds = Array.from(criteriaCheckboxes.querySelectorAll('input[type="checkbox"]:checked'))
                .map(checkbox => parseInt(checkbox.value));

            const filteredUniversities = universities.map(university => {
                let totalRating = 0;
                let totalCriteria = 0;

                selectedCriteriaIds.forEach(criterionId => {
                    const averageRating = university[`average_${criterionId}`];
                    if (averageRating > 0) {
                        totalRating += averageRating;
                        totalCriteria++;
                    }
                });

                university.averageRating = totalCriteria > 0 ? totalRating / totalCriteria : 0;
                return university;
            }).filter(university => university.averageRating > 0);

            renderUniversities(filteredUniversities);
            const averageHeader = document.querySelector('.average-header');
            averageHeader.style.display = selectedCriteriaIds.length > 0 ? 'table-cell' : 'none';
        });

        function renderUniversities(universities) {
            const tbody = universitiesTable.querySelector('tbody');
            tbody.innerHTML = '';

            universities.sort((a, b) => {
                return b.averageRating - a.averageRating; // Tri par ordre décroissant
            });

            universities.forEach(university => {
                const tr = document.createElement('tr');
                tr.setAttribute('data-universite-id', university.id);
                tr.innerHTML = `
                <td>${university.nom}</td>
                <td>${university.description}</td>
                <td><a href="${university.site_web}">${university.site_web}</a></td>
                <td>
                    <a href="/universites/${university.id}">Voir</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NoteUniversiteModal" data-universite-id="${university.id}">
                        Noter ${university.id}
                    </button>
                    <a href="/universites/${university.id}/edit">Modifier</a>
                    <form action="/universites/${university.id}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette université ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
                <td>Classé</td>
                <td>${university.averageRating.toFixed(2)}</td>
                
            `;
                tbody.appendChild(tr);
            });

            // Ajouter le th "Moyenne" si nécessaire
            const thead = universitiesTable.querySelector('thead');
            if (selectedCriteriaIds.length > 0) {
                addAverageHeader(thead);
            } else {
                removeAverageHeader(thead);
            }
        }

        function addAverageHeader(thead) {
            const existingAverageTh = thead.querySelector('.ranking-score');
            if (!existingAverageTh) {
                const averageTh = document.createElement('th');
                averageTh.classList.add('ranking-score');
                averageTh.textContent = 'Moyenne';

                // Insérer le th "Moyenne" après le th "Actions"
                const actionsTh = thead.querySelector('th:nth-child(4)');
                actionsTh.parentNode.insertBefore(averageTh, actionsTh.nextSibling);
            }
        }


        function removeAverageHeader(thead) {
            const existingAverageTh = thead.querySelector('.ranking-score');
            if (existingAverageTh) {
                existingAverageTh.remove();
            }
        }
    });
</script>


@endsection