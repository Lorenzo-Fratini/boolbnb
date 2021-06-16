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
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          User
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Login</a>
          <a class="dropdown-item" href="#">Register</a>
          <a class="dropdown-item" href="#">Siuummm</a>
        </div>
      </div>
    </div>
  </div>

</header>
