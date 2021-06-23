<header>
    <div class="container-header">

        <div class="logo-header">
            <a href="{{ route('index')}}"><img src="{{ asset('storage/images/logo.svg') }}" alt="Logo BoolB&B"></a>
        </div>

        <div class="searchbar-header">
            <form method="GET" action="{{ route('search') }}">

                @csrf
                @method('GET')

                <input id="searchString" type="text" class="form-control" name="searchString" placeholder="Inserisci una via..." required>

                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>

            </form>

        </div>

        <div class="user-header">
                @guest
                        <a class="login-header-btn" href="{{ route('login') }}">Login</a>
                        <a class="register-header-btn" href="{{ route('register') }}">Register</a>
                @else
                <div id="user-logged">
                        <button class="hamburger" id="hamburger">
    
                            <i class="fas fa-bars"></i>
    
                        </button>
                        <ul class="nav-ul" id="nav-ul">
                            <li>
                                <h3 class="hello-user">
                                    {{ Auth::user() -> firstname }}
                               </h3>
                            </li>

                            <li>
                                <a class="dashboard-header-btn" href="{{ route('dashboard', ['id' => Auth::id()]) }}">Dashboard</a>
                            </li>

                            <li>
                                <a class="btn logout-header-btn" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
    
                            </li>
                        </ul>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>    
                @endguest
        </div>
    </div>

</header>

<script>

    const hamburger = document.getElementById('hamburger');
    const navUL = document.getElementById('nav-ul');
    
    hamburger.addEventListener('click', () => {
        navUL.classList.toggle('show')
    });

</script>