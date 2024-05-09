@extends('layouts.app')
@section('content')

<head>
    <style>
        /* Styles spécifiques */
        .carousel-item {
            text-align: center;
        }

        .carousel-caption {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .carousel-inner img {
            max-height: 500px;
            object-fit: cover;
        }
    </style>
</head>
<section class="container mt-4">
    <div class="jumbotron">
        <h1 class="display-4">Bienvenue sur UnivClassement</h1>
        <p class="lead">Votre observatoire des classements d'universités.</p>
    </div>
</section>
<section class="container mt-4">
    <h2>Universités partenaires</h2>
    <div id="carouselImages" class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">
            @foreach($universites as $key => $universite)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <span style="font-weight: bold;"> {{$universite->nom}}</span>
                <img src="{{ asset('storage/universites_images/' . $universite->image) }}" class="d-block w-100" alt="{{ $universite->nom }}">
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselImages" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselImages" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
<!-- Présentation de l'application -->
<section class="container mt-4">
    <h2>À propos d'UnivClassement</h2>
    <p>UnivClassement est votre portail exclusif pour découvrir les meilleures universités du monde entier, évaluées selon des critères rigoureux pour vous aider à prendre des décisions éclairées pour votre avenir académique.</p>
    <p>Notre mission chez UnivClassement est de fournir aux étudiants, aux parents et aux universitaires des classements impartiaux et fiables des universités, basés sur des données factuelles et des évaluations précises.</p>
    <p>Avec UnivClassement, explorez les classements actualisés des universités les plus réputées dans divers domaines d'étude, et découvrez les institutions qui se distinguent par leur excellence académique et leur impact mondial.</p>
    <p>Découvrez les meilleures universités de votre pays ou à l'étranger avec UnivClassement, et bénéficiez d'une vue d'ensemble complète des critères qui définissent leur réputation et leur qualité.</p>
    <p>UnivClassement s'engage à fournir des informations objectives et transparentes sur les classements d'universités, afin de vous aider à trouver l'établissement qui correspond le mieux à vos aspirations académiques et professionnelles.</p>
</section>


@endsection