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
        <div class="dropdown">
            <div class="con"></div>
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('img/person.png') }}" alt="Profile Picture" width="40" height="40" class="rounded-circle">
                <span class="ms-2">{{ session('user.username') }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-center shadow-lg" aria-labelledby="profileDropdown">
                <li class="profile-card">
                    <div class="text-center">
                        <img src="{{ asset('img/person.png') }}" alt="Profile Picture" width="80" height="80" class="rounded-circle mb-2">
                        <h6 class="mb-0">{{ session('user.fullname', 'Nama Tidak Ditemukan') }}</h6>
                    </div>
                    <small class="text-muted d-block mt-2">Tanggal Bergabung: {{ \Carbon\Carbon::parse(session('user.join_date'))->format('d-m-Y') }}</small>
                    <small class="text-muted d-block">Terakhir Login: {{ \Carbon\Carbon::parse(session('user.last_login'))->format('d-m-Y (H:i:s)') }}</small>
                </li>
                <li class="text-center">
                    <form action="/logout">
                        @csrf
                        <button class="btn btn-danger py-2 px-4" style="width: 240px; border-radius: 5px;">Keluar</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
