{{-- filepath: c:\projekwebsitemaskaisan\fortopoliokaisan\resources\views\navbar.blade.php --}}
<style>
    .navbar {
        background-color: #343a40;
        color: white;
        padding: 1rem;
        position: fixed; /* Navbar tetap di atas */
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
    }

    .navbar a {
        color: #ffffff;
        text-decoration: none;
        margin: 0 1rem;
        font-size: 1rem;
    }

    .navbar a:hover {
        color: #f8f9fa;
        text-decoration: underline;
    }

    .navbar .brand {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .navbar .nav-links {
        display: flex;
        align-items: center;
        margin-left: auto; /* Memindahkan menu ke sebelah kanan */
        margin-right: 1cm; /* Memberikan jarak 3 cm dari sisi kanan */
    }

    .navbar .nav-item {
        list-style: none;
    }
</style>

<nav class="navbar">
    <a href="/" class="brand">BrandName</a>
    <ul class="nav-links">
        <li class="nav-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('register') }}">Register</a>
        </li>
    </ul>
</nav>



