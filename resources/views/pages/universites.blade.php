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



<div class="row">
    @foreach ($universites as $key => $universite)
    @if ($key % 3 === 0)
</div>
<div id="universitiesContainer" data-universities="{{ $universites->toJson() }}" class="row">
    @endif
    <div class="col-md-4">
        <div class="card" style="margin-top: 10px;">
            <div class="card-body">
                <h5 class="card-title">{{ $universite->nom }}</h5>
                <p class="card-text">{{ $universite->description }}</p>
                <a href="{{ $universite->site_web }}" class="card-link">{{ $universite->site_web }}</a>
            </div>
            <div class="card-footer">
                <a href="{{ route('universites.show', $universite->id) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M7.143 1.5c.97 0 1.927.18 2.833.536a13.29 13.29 0 0 1 2.361 1.237c.715.636 1.364 1.37 1.926 2.16a15.84 15.84 0 0 1 1.524 2.36c.356.714.64 1.497.835 2.333a13.29 13.29 0 0 1 .536 2.834c0 .97-.18 1.927-.536 2.833a13.29 13.29 0 0 1-1.237 2.361c-.636.715-1.37 1.364-2.16 1.926a15.84 15.84 0 0 1-2.36 1.524c-.714.356-1.497.64-2.333.835a13.29 13.29 0 0 1-2.834.536zM8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8zm0 6a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                    </svg>
                </a>
                @auth
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NoteUniversiteModal" data-universite-id="{{ $universite->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                        <path d="M7.868.235a.5.5 0 0 1 .264 0l1.723.286a.5.5 0 0 1 .276.148l.824.823a.5.5 0 0 1 .149.276l.286 1.723a.5.5 0 0 1-.073.353l-1.187 1.49a.5.5 0 0 1-.312.164l-1.563.28a1.5 1.5 0 0 1-1.11-.44l-.74-.739a.5.5 0 0 1-.138-.403L5.66 4.418a1.5 1.5 0 0 1 .21-1.042l.823-1.097a.5.5 0 0 1 .353-.186zM8 12.5a.5.5 0 0 1-.377-.171l-1.454-1.663a.5.5 0 0 1-.094-.301L6.07 7.398a.5.5 0 0 1 .144-.34l1.187-1.49a.5.5 0 0 1 .312-.164l1.563-.28a1.5 1.5 0 0 1 1.11.44l.74.739a.5.5 0 0 1 .138.403l-.286 1.723a.5.5 0 0 1-.149.276l-.824.823a.5.5 0 0 1-.276.148l-1.723.286a.5.5 0 0 1-.264 0zM3.5 14a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2zm10 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2zM2 14.5a.5.5 0 0 1-.5-.5V2.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 .5.5v11a.5.5 0 0 1-.5.5H2z" />
                    </svg>
                </button>

                <a href="{{ route('universites.edit', $universite->id) }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                        <path d="M13.293 0.293a1 1 0 0 1 1.414 0l1 1a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-.39.242l-4 1a1 1 0 0 1-1.242-1.242l1-4a1 1 0 0 1 .242-.39l10-10zM12 2l1.586 1.586-9.172 9.172-.086.329.329-.086 9.172-9.172L14 3.414 12.586 2H12zm-3.086 10.5l-1.75 1.75a.5.5 0 0 1-.707 0l-6-6a.5.5 0 0 1 0-.707l1.75-1.75L9.914 11.5z" />
                    </svg>
                </a>
                @if (count($criteres) > 0)
                <form action="{{ route('universites.destroy', $universite->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette université ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1h15a.5.5 0 0 1 .5.5V3h-16V1.5zm1-1A1.5 1.5 0 0 0 .5 1v.5h15V1a1.5 1.5 0 0 0-1.5-1.5H1zM3.879 13a2 2 0 0 1-1.975-1.65L1.5 5H14.5l-.404 6.35A2 2 0 0 1 12.12 13H3.88zm-1.732-.5a1 1 0 0 0 1.007.832h8.845a1 1 0 0 0 1.007-.832L13.096 5H2.904l-.757 7.5z" />
                        </svg>
                    </button>
                </form>
                @endif
                @endauth
            </div>
        </div>
    </div>
    @endforeach
</div>








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

                    alert('Erreur lors de la récupération des critères de notation ou vous n"êtes pas autorisé.');
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
        const universitiesContainer = document.getElementById('universitiesContainer');
        const universities = JSON.parse(universitiesContainer.dataset.universities);

        const criteriaCheckboxes = document.getElementById('criteriaCheckboxes');
        let selectedCriteriaIds = [];

        criteriaCheckboxes.addEventListener('change', function() {
            selectedCriteriaIds = Array.from(criteriaCheckboxes.querySelectorAll('input[type="checkbox"]:checked'))
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
        });

        function renderUniversities(universities) {
            universitiesContainer.innerHTML = '';

            universities.sort((a, b) => {
                return b.averageRating - a.averageRating; // Tri par ordre décroissant
            });

            universities.forEach((university, index) => {
                const card = document.createElement('div');
                card.classList.add('col-md-4', 'mb-4');
                card.innerHTML = `
                <div class="card" style="margin-top: 10px;">
                    <div class="card-body">
                        <h5 class="card-title">${index + 1}. ${university.nom}</h5>
                        <p class="card-text">${university.description}</p>
                        <a href="${university.site_web}" class="card-link">${university.site_web}</a>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('universites.show', $universite->id) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="M7.143 1.5c.97 0 1.927.18 2.833.536a13.29 13.29 0 0 1 2.361 1.237c.715.636 1.364 1.37 1.926 2.16a15.84 15.84 0 0 1 1.524 2.36c.356.714.64 1.497.835 2.333a13.29 13.29 0 0 1 .536 2.834c0 .97-.18 1.927-.536 2.833a13.29 13.29 0 0 1-1.237 2.361c-.636.715-1.37 1.364-2.16 1.926a15.84 15.84 0 0 1-2.36 1.524c-.714.356-1.497.64-2.333.835a13.29 13.29 0 0 1-2.834.536zM8 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8zm0 6a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                            </svg>
                        </a>
                        @auth
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NoteUniversiteModal" data-universite-id="${university.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M7.868.235a.5.5 0 0 1 .264 0l1.723.286a.5.5 0 0 1 .276.148l.824.823a.5.5 0 0 1 .149.276l.286 1.723a.5.5 0 0 1-.073.353l-1.187 1.49a.5.5 0 0 1-.312.164l-1.563.28a1.5 1.5 0 0 1-1.11-.44l-.74-.739a.5.5 0 0 1-.138-.403L5.66 4.418a1.5 1.5 0 0 1 .21-1.042l.823-1.097a.5.5 0 0 1 .353-.186zM8 12.5a.5.5 0 0 1-.377-.171l-1.454-1.663a.5.5 0 0 1-.094-.301L6.07 7.398a.5.5 0 0 1 .144-.34l1.187-1.49a.5.5 0 0 1 .312-.164l1.563-.28a1.5 1.5 0 0 1 1.11.44l.74.739a.5.5 0 0 1 .138.403l-.286 1.723a.5.5 0 0 1-.149.276l-.824.823a.5.5 0 0 1-.276.148l-1.723.286a.5.5 0 0 1-.264 0zM3.879 13a2 2 0 0 1-1.975-1.65L1.5 5H14.5l-.404 6.35A2 2 0 0 1 12.12 13H3.88zm-1.732-.5a1 1 0 0 0 1.007.832h8.845a1 1 0 0 0 1.007-.832L13.096 5H2.904l-.757 7.5z" />
                            </svg>
                        </button>

                        <a href="{{ route('universites.edit', $universite->id) }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M13.293 0.293a1 1 0 0 1 1.414 0l1 1a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-.39.242l-4 1a1 1 0 0 1-1.242-1.242l1-4a1 1 0 0 1 .242-.39l10-10zM12 2l1.586 1.586-9.172 9.172-.086.329.329-.086 9.172-9.172L14 3.414 12.586 2H12zm-3.086 10.5l-1.75 1.75a.5.5 0 0 1-.707 0l-6-6a.5.5 0 0 1 0-.707l1.75-1.75L9.914 11.5z" />
                            </svg>
                        </a>
                        @if (count($criteres) > 0)
                        <form action="{{ route('universites.destroy', $universite->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette université ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1h15a.5.5 0 0 1 .5.5V3h-16V1.5zm1-1A1.5 1.5 0 0 0 .5 1v.5h15V1a1.5 1.5 0 0 0-1.5-1.5H1zM3.879 13a2 2 0 0 1-1.975-1.65L1.5 5H14.5l-.404 6.35A2 2 0 0 1 12.12 13H3.88zm-1.732-.5a1 1 0 0 0 1.007.832h8.845a1 1 0 0 0 1.007-.832L13.096 5H2.904l-.757 7.5z" />
                                </svg>
                            </button>
                        </form>
                        @endif
                        @endauth
                    </div>
                </div>
            `;
                universitiesContainer.appendChild(card);
            });
        }
    });

    function addAverageHeader(thead) {
        const existingAverageTh = thead.querySelector('.ranking-score');
        if (!existingAverageTh) {
            const averageTh = document.createElement('th');
            averageTh.classList.add('ranking-score');
            averageTh.textContent = 'Moyenne';

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
</script>


@endsection