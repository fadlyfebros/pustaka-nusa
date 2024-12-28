<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="profile-section text-center p-3">
    <img src="{{ asset('img/person.png') }}" alt="Profile Picture">
    <div class="profile-text">
        <h5>{{ session('user.fullname') }}</h5>
        <p class="text-success"><i class="fas fa-check-circle"></i> Akun Terverifikasi</p>
    </div>
    </div>

    <!-- Main Menu -->
    <div class="menu-header">Main Menu</div>
    <a href="/admin"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

    <!-- Master Data -->
    <a href="#" data-bs-toggle="collapse" data-bs-target="#masterDataMenu" aria-expanded="false">
    <i class="fas fa-folder"></i> Master Data
    </a>
    <div class="collapse" id="masterDataMenu">
    <a href="/admin/anggota" class="submenu"><i class="fas fa-circle"></i> Data Anggota</a>
    <a href="/admin/datapenerbit" class="submenu"><i class="fas fa-circle"></i> Data Penerbit</a>
    <a href="/admin/dataadmin" class="submenu"><i class="fas fa-circle"></i> Administrator</a>
    <a href="/admin/datapeminjamanbuku" class="submenu"><i class="fas fa-circle"></i> Data Peminjaman</a>
    </div>

    <!-- Katalog Buku -->
    <a href="#" data-bs-toggle="collapse" data-bs-target="#katalogBukuMenu" aria-expanded="false">
    <i class="fas fa-book"></i> Katalog Buku
    </a>
    <div class="collapse" id="katalogBukuMenu">
    <a href="/admin/categories" class="submenu"><i class="fas fa-circle"></i> Kategori Buku</a>
    <a href="/admin/books" class="submenu"><i class="fas fa-circle"></i> Data Buku</a>
    </div>

    <!-- Keluar -->
    <div class="menu-header">Lanjutan</div>
    <a href="/logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
</div>
