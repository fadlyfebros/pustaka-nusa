<nav class="navbar navbar-expand-lg bg-light border-bottom" style="box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="img/logo.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top me-2">
            <span style="color: black; font-weight: bold;">
                Pustaka Nusa
            </span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark fw-bold" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-bold" href="/about">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-bold" href="/contact">Kontak Kami</a>
                </li>
            </ul>
            <a href="/login"
               class="btn rounded-pill px-4 text-white text-decoration-none"
               style="background-color: #58C6BC; border-color: #58C6BC;">
                Masuk
            </a>
        </div>
    </div>
</nav>

<style>
    /* Animasi untuk tombol "Masuk" */
    .btn {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn:hover, .btn:active {
        background-color: #45b8a9;
        transform: scale(1.1);
    }

    /* Animasi untuk link navbar */
    .navbar-nav .nav-link {
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover, .navbar-nav .nav-link:active {
        color: #58C6BC;
        transform: translateY(-3px);
    }

    /* Navbar shadow */
    .navbar {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Thicker shadow */
    }
</style>
