<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="profile-section text-center p-3">
        <img src="{{ asset('img/person.png') }}" alt="Profile Picture">
        <div class="profile-text">
            <h5 class="text-start">{{ session('user.fullname') }}</h5>
        </div>
    </div>

    <!-- Main Menu -->
    <div class="menu-header">Main Menu</div>
    <a href="/anggota"><i class="fas fa-tachometer-alt"></i> Dashboard</a>

    <!-- Peminjaman Buku -->
    <a href="/anggota/datapeminjaman"><i class="fas fa-book-reader"></i> Peminjaman Buku</a>

    <!-- Pengembalian Buku -->
    <a href="/anggota/datapengembalian"><i class="fas fa-undo-alt"></i> Pengembalian Buku</a>

    <!-- Keluar -->
    <div class="menu-header">Lanjutan</div>
    <a href="/logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
</div>
