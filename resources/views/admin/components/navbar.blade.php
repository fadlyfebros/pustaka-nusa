<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img src="{{ asset('img/logo.png') }}" alt="Pustaka Nusa Logo" width="30" height="30" class="d-inline-block align-top">
          <span class="ms-2">Pustaka Nusa</span>
        </a>
        <button class="btn btn-dark ms-3" id="hamburger-menu" type="button" onclick="toggleSidebar()">
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>
      <div class="profile-info">
        <img src="{{ asset('img/person.png') }}" alt="Profile Picture">
        <span>Fadly Febro</span>
      </div>
    </div>
</nav>
