@extends('layouts.app')
@section('content')

<head>
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}" />
</head>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Dashboards') }}
    </h2>
</x-slot>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="element">
                <div class="center-vertically">
                    <h4>Nombre d'utilisateurs</h4>
                    <p>{{ $totalUtilisateurs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="element">
                <div class="center-vertically">
                    <h4>Nombre d'universités</h4>
                    <p>{{ $totalUniversites }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="element">
                <div class="center-vertically">
                    <h4>Nombre de critères</h4>
                    <p>{{ $totalCriteres }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="element">
                <div class="center-vertically">
                    <h4>Nombre d'universités notées</h4>
                    <p>{{ $totalUniversitesNotees }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection