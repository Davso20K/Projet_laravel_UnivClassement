<head>
    <link rel="stylesheet" href="style.css">



    <!----===== Boxicons CSS ===== -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href="{{asset('css/style.css')}}">
</head>

<div class="row flex-nowrap">
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <!--<img src="logo.png" alt="">-->
                </span>
                <div class="text logo-text">
                    <span class="name">Codinglab</span>
                    <span class="profession">Web developer</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">



                <ul class="menu-links">
                    <div class="search-box">
                        <li class="nav-link">
                            <a href="#">
                                <i class='bx bx-home-alt icon'></i>
                                <span class="text nav-text">Dashboard</span>
                            </a>
                        </li>
                    </div>
                    <div class="search-box">

                        <li class="nav-link">
                            <a href="{{route('universites.index')}}">
                                <i class='bx bx-bar-chart-alt-2 icon'></i>
                                <span class="text nav-text">Universités</span>
                            </a>
                        </li>
                    </div>
                    <div class="search-box">

                        <li class="nav-link">
                            <a href="{{route('criteres.index')}}">
                                <i class='bx bx-bell icon'></i>
                                <span class="text nav-text">Critères</span>
                            </a>
                        </li>
                    </div>
                    <div class="search-box">

                        <li class="nav-link">
                            <a href="{{route('utilisateurs.index')}}">
                                <i class='bx bx-pie-chart-alt icon'></i>
                                <span class="text nav-text">Utilisateurs</span>
                            </a>
                        </li>
                        <!-- <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-wallet icon'></i>
                            <span class="text nav-text">Wallets</span>
                        </a>
                    </li>-->
                    </div>

                </ul>

                <!-- </div> 
            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li> -->

            </div>
        </div>
    </nav>
    <section class="home">
        @include('layouts.navigation')

        @yield('content')
        @include('layouts.components.footer')

    </section>

    <script src="{{asset('js/script.js')}}"></script>
</div>