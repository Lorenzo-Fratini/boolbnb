<header>
    <div class="container-header">

        <div class="logo-header">
            <img src="{{ asset('storage/images/logo.svg') }}" alt="">
        </div>

        <div class="searchbar-header">
            <form class="" method="post">
                <input type="text" placeholder="Inizia la ricerca...">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </form>

        </div>

        <div class="user-header">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    User
                </button>
                @guest
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                    </div>
                @else
                    <h1>
                        Hello {{ Auth::user() -> firstname }}
                    </h1>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="btn" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>
        </div>
    </div>

</header>
