<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Pustaka Nusa')</title>
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
    .blur {
        filter: blur(5px);
        transition: filter 0.3s ease;
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
<div class="container-fluid">
    <!-- Navbar -->
    @include('admin.components.navbar')

    <!-- Overlay -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    @include('admin.components.sidebar')

    <!-- Main Content -->
    <div class="content" id="content">
        @yield('content')
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