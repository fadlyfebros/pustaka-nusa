<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Pustaka Nusa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .sidebar {
      height: 100vh;
      background-color: #f8f9fa;
      position: fixed;
      top: 0;
      left: 0;
      width: 250px;
      transition: all 0.3s ease;
      z-index: 1051;
      overflow-y: auto;
    }

    .sidebar.collapsed {
      width: 0;
    }
    .sidebar{
      padding-top: 40px;
    }
    .sidebar .menu-header {
      font-size: 16px;
      font-weight: bold;
      text-transform: uppercase;
      padding: 15px 20px;
      color: #6c757d;
      border-bottom: 1px solid #dee2e6;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      font-size: 16px;
      color: #495057;
      padding: 8px 20px;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #e9ecef;
      border-radius: 5px;
    }

    .sidebar a i {
      margin-right: 10px;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1050;
      display: none;
    }

    .overlay.active {
      display: block;
    }

    .navbar {
      z-index: 1052;
    }

    .content {
      margin-left: 250px;
      transition: margin-left 0.3s ease;
    }

    .content.fullscreen {
      margin-left: 0;
    }

    /* Media Query untuk Responsivitas */
    @media (max-width: 2560px) {
      .sidebar {
        width: 300px;
      }

      .content {
        margin-left: 300px;
      }
    }

    @media (max-width: 1440px) {
      .sidebar {
        width: 250px;
      }

      .content {
        margin-left: 250px;
      }
    }

    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        left: -250px;
        width: 200px;
      }

      .sidebar.active {
        left: 0;
      }

      .content {
        margin-left: 0;
      }
    }

    @media (max-width: 425px) {
      .sidebar {
        width: 180px;
      }
    }

    @media (max-width: 375px) {
      .sidebar {
        width: 160px;
      }

      .sidebar a {
        font-size: 14px;
        padding: 8px 15px;
      }

      .sidebar .menu-header {
        font-size: 14px;
      }
    }

    @media (max-width: 320px) {
      .sidebar {
        width: 140px;
      }

      .sidebar a {
        font-size: 12px;
        padding: 6px 10px;
      }

      .sidebar .menu-header {
        font-size: 12px;
      }
    }

    .profile-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .profile-info img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
    }
    .profile-section {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 15px 20px;
      border-bottom: 1px solid #dee2e6;
    }
    .profile-section img {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
    }
    .profile-text {
      display: flex;
      flex-direction: column;
      margin-top: 5px;
    }

    .profile-text h5 {
      margin: 0;
      font-size: 18px;
      font-weight: bold;
    }

    .profile-text p {
      margin: 0;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
          <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="img/logo.png" alt="Pustaka Nusa Logo" width="30" height="30" class="d-inline-block align-top">
            <span class="ms-2">Pustaka Nusa</span>
          </a>
          <button class="btn btn-dark ms-3" id="hamburger-menu" type="button" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
          </button>
        </div>
        <div class="profile-info">
          <img src="img/person.png" alt="Profile Picture">
          <span>Fadly Febro</span>
        </div>
      </div>
    </nav>

    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="menu-header mt-5">Main Menu</div>
      <a href="dashboard.html"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="peminjaman.html"><i class="fas fa-book"></i> Peminjaman Buku</a>
      <a href="#"><i class="fas fa-undo"></i> Pengembalian Buku</a>
      <div class="menu-header mt-5">Lanjutan</div>
      <a href="#"><i class="fas fa-sign-out-alt"></i> Keluar</a>
    </div>

    <!-- Main Content -->
    <div class="content" id="content">
      <div class="p-4">
        <h1 class="mb-3">Dashboard</h1>
        <p class="alert alert-secondary">
          Selamat Siang, Selamat datang <strong>Fadly Febro</strong> di Pustaka Nusa.
        </p>
        <div class="text-center">
          <img src="img/logo.png" alt="Pustaka Nusa Logo">
          <h2 class="mt-3">Pustaka Nusa</h2>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const content = document.getElementById('content');

    function toggleSidebar() {
      if (window.innerWidth > 991) {
        sidebar.classList.toggle('collapsed');
        content.classList.toggle('fullscreen');
      } else {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
      }
    }
  </script>
</body>
</html>
