<footer class="container-fluid mt-auto text-white py-3 animated-footer" style="background-color: #58C6BC;">
    <div class="container">
        <ul class="nav justify-content-center border-bottom border-light pb-3 mb-3">
            <li class="nav-item"><a href="/" class="nav-link px-2 text-white footer-link">Beranda</a></li>
            <li class="nav-item"><a href="/about" class="nav-link px-2 text-white footer-link">Tentang Kami</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-white footer-link">Kontak Kami</a></li>
        </ul>
        <p class="text-center mb-0">&copy; 2024 Pustaka Nusa</p>
    </div>
</footer>

<style>
    /* Animasi fade-in saat halaman dimuat */
    .animated-footer {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animasi hover pada link footer */
    .footer-link {
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .footer-link:hover {
        color: #fff;
        transform: translateY(-5px);
    }
</style>
