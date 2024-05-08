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

<div class="overflow-auto" style="max-height: 300px; margin-top:10px;">
    <div id="criteriaCheckboxes" data-criteres="{{ json_encode($criteres) }}">
        @if (count($criteres) > 0)
        <div class="form-group">
            <h5 for="criteria">Cochez des critères pour classer les universités</h5>
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
</div>
<div style="display: flex; ">
    <h3 style="margin-right: 10px;">Liste des universités</h3>
    @if(Auth::user()?->is_admin)

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUniversiteModal">
        Ajouter une université
    </button>
    @endif
</div>



<div class="scrollView border  rounded">
    <div class="row" id="universitiesContainer" data-universities="{{ $universites->toJson() }}">
        @foreach ($universites as $key => $universite)
        <div class="col-md-3" data-key="{{ $key }}">
            <div class="card fixed-height" style="margin-top: 10px;">
                <img src="{{ asset('storage/universites_images/' . $universite->image) }}" class="card-img-top fixed-image" alt="Université image">
                <div class="card-body">
                    <h5 class="card-title">{{ $universite->nom }}</h5>
                    <p class="card-text">{{ $universite->description }}</p>
                    <a href="{{ $universite->site_web }}" class="card-link">{{ $universite->site_web }}</a>
                </div>
                <div class="card-footer">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <a href="{{ route('universites.show', $universite->id) }}" class="btn btn-primary" title="Voir les détails de cette université">
                                <img src="{{ asset('icones/infos.svg') }}" style="height: 40px;" />
                            </a>
                        </div>
                        @if(Auth::user())
                        <div class="col-md-3">
                            <button type="button" title="Cliquez pour noter cette université" class="btn btn-warning" data-toggle="modal" data-target="#NoteUniversiteModal" data-universite-id="{{ $universite->id }}">
                                <img src="{{ asset('icones/noter.svg') }}" style="height: 40px;" />
                            </button>
                        </div>
                        @else
                        <div class="col-md-3">
                            <a href="{{ route('login') }}" class="btn btn-warning" title="Cliquez pour noter cette université">
                                <img src="{{ asset('icones/noter.svg') }}" style="height: 40px;" />
                            </a>
                        </div>
                        @endif
                        @if(Auth::user()?->is_admin)
                        <div class="col-md-3">
                            <a href="{{ route('universites.edit', $universite->id) }}" class="btn btn-secondary" title="Mettre à jour les informations de cette université">
                                <img src="{{ asset('icones/editer.svg') }}" style="height: 40px;" />
                            </a>
                        </div>
                        @if (count($criteres) > 0)
                        <div class="col-md-3">
                            <form action="{{ route('universites.destroy', $universite->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette université ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Cliquez pour supprimer cette université">
                                    <img src="{{ asset('icones/supprimer.svg') }}" style="height: 40px;" />
                                </button>
                            </form>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if (($key + 1) % 4 === 0 || $key === count($universites) - 1)
    </div>
    @if ($key !== count($universites) - 1)
    <div class="row" id="universitiesContainer">
        @endif
        @endif
        @endforeach
    </div>
</div>









<!-- Modal d'ajout d'une université -->
<div class="modal fade" id="createUniversiteModal" tabindex="-1" role="dialog" aria-labelledby="createUniversiteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('universites.store') }}" method="POST" enctype="multipart/form-data">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/jpeg, image/png">
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
        let universities = JSON.parse(universitiesContainer.dataset.universities);

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

            updateUniversitiesOrder(filteredUniversities);
        });

        function updateUniversitiesOrder(newOrder) {
            universities = newOrder; // Mise à jour directe des universités avec le nouvel ordre
            while (universitiesContainer.firstChild) {
                universitiesContainer.removeChild(universitiesContainer.firstChild);
            }
            renderUniversities(universities);
        }

        function renderUniversities(universities) {
            universitiesContainer.innerHTML = '';
            const imagePath = "{{ asset('storage/universites_images/') }}";
            universities.sort((a, b) => {
                return b.averageRating - a.averageRating; // Tri par ordre décroissant
            });

            let row = document.createElement('div');
            row.classList.add('row');

            universities.forEach((university, index) => {
                const card = document.createElement('div');
                card.classList.add('col-md-3', 'mb-4');
                const rank = index + 1;
                card.innerHTML = `
    <div class="card fixed-height" style="margin-top: 10px;">
        <img src="${imagePath}/${university.image}" class="card-img-top fixed-image" alt="Université image">
        <div class="card-body">
            <h5 class="card-title">${rank}. ${university.nom}</h5>
            <p class="card-text">${university.description}</p>
            <a href="${university.site_web}" class="card-link">${university.site_web}</a>
        </div>
        <div class="card-footer">
            <div class="form-group row">
                <div class="col-md-3">
                    <a href="/universite/${university.id}" class="btn btn-primary">
                        <img src="{{ asset('icones/infos.svg') }}" style="height: 40px;" />
                    </a>
                </div>
                @if(Auth::user())
                <div class="col-md-3">
                    <button type="button" title="Cliquez pour noter cette université" class="btn btn-warning" data-toggle="modal" data-target="#NoteUniversiteModal" data-universite-id="${university.id}">
                        <img src="{{ asset('icones/noter.svg') }}" style="height: 40px;" />
                    </button>
                </div>
                @else
                <div class="col-md-3">
                    <a href="{{ route('login') }}" class="btn btn-warning" title="Cliquez pour noter cette université">
                        <img src="{{ asset('icones/noter.svg') }}" style="height: 40px;" />
                    </a>
                </div>
                @endif
                @if(Auth::user()?->is_admin)
                <div class="col-md-3">
                    <a href="/universite/${university.id}/edit" class="btn btn-secondary" title="Mettre à jour les informations de cette université">
                        <img src="{{ asset('icones/edit.svg') }}" style="height: 40px;" />
                    </a>
                </div>
                @if (count($criteres) > 0)
                <div class="col-md-3">
                    <form action="/universitedes/${university.id}" method="POST" style="display: inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette université ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" title="Cliquez pour supprimer cette université">
                            <img src="{{ asset('icones/supprimer.svg') }}" style="height: 40px;" />
                        </button>
                    </form>
                </div>
                @endif
                @endif
            </div>
        </div>
        <div class="card-footer">
            <p class="rank">Rang: ${rank}</p>
            <p class="average">Moyenne: ${university.averageRating}</p>
        </div>
    </div>
    `;

                row.appendChild(card);

                if ((index + 1) % 4 === 0 || index === universities.length - 1) {
                    universitiesContainer.appendChild(row);
                    row = document.createElement('div');
                    row.classList.add('row');
                }
            });
        }

    });
</script>




@endsection