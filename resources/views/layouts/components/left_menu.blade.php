<head>

    <link rel='stylesheet' href="{{asset('css/style.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

</head>


<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <!--<img src="logo.png" alt="">-->
            </span>

        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>
    <div class="menu-bar">
        <div class="menu">


            <ul class="menu-links">

                @if(Auth::user()?->is_admin)


                <div class="">
                    <li class="nav-link">
                        <a href="{{route('dashboard')}}">
                            <img src="{{ asset('icones/dashboard.svg') }}" title="Dashboard" style="height: 30px;margin-left: -15px;margin-right:10px;" />

                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                </div>
                @endif
                <div class="">

                    <li class="nav-link">
                        <a href="{{route('accueil')}}">
                            <img src="{{ asset('icones/accueil.svg') }}" title="Accueil" style="height: 30px;margin-left: -15px;margin-right:10px;" />

                            <span class="text nav-text">accueil</span>
                        </a>
                    </li>
                </div>
                <div class="">

                    <li class="nav-link">
                        <a href="{{route('universites.index')}}">
                            <!-- <i class='bx bx-bar-chart-alt-2 icon' style="margin-left: -25px;"></i> -->
                            <img src="{{ asset('icones/universites.svg') }}" title="Universités" style="height: 30px;margin-left: -15px;margin-right:10px;" />

                            <span class="text nav-text">Universités</span>
                        </a>
                    </li>
                </div>
                @auth
                @if(Auth::user()?->is_admin)

                <div class="">

                    <li class="nav-link">
                        <a href="{{route('criteres.index')}}">
                            <img src="{{ asset('icones/criteres.svg') }}" title="Critères" style="height: 30px;margin-left: -15px;margin-right:10px;" />
                            <span class="text nav-text">Critères</span>
                        </a>
                    </li>
                </div>
                <div class="">

                    <li class="nav-link">
                        <a href="{{route('utilisateurs.index')}}">
                            <img src="{{ asset('icones/users.svg') }}" title="Utilisateurs" style="height: 30px;margin-left: -15px;margin-right:10px;" />
                            <span class="text nav-text">Utilisateurs</span>
                        </a>
                    </li>

                </div>
                @endauth
                @endif

            </ul>



        </div>
    </div>
</nav>
<section class="homeSection ">
    @include('layouts.navigation')

    @yield('content')
    @include('layouts.components.footer')

</section>


<script src="{{asset('js/script.js')}}"></script>