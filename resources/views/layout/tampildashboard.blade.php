<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard</title>
  <style>
    /* Sidebar */
    .sidenav {
      height: 100%;
      width: 250px;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: #111;
      overflow-x: hidden;
      padding-top: 20px;
    }

    .sidenav a {
      padding: 10px 16px;
      text-decoration: none;
      font-size: 20px;
      color: #ccc;
      display: block;
      transition: 0.3s;
    }

    .sidenav a:hover {
      color: #fff;
      background-color: #575757;
    }

    /* Main content */
    .main {
      padding: 20px;
      background-color: #f9f9f9;
      min-height: 100vh;
      margin-left: 250px;
    }

    .no-sidebar .main {
      margin-left: 0 !important;
    }

    /* Responsive */
    @media screen and (max-width: 768px) {
      .sidenav {
        width: 100%;
        height: auto;
        position: relative;
      }

      .main {
        margin-left: 0;
      }
    }
  </style>
</head>
<body class="@yield('hideSidebar') ? 'no-sidebar' : ''">

  @if (!trim($__env->yieldContent('hideSidebar')))
    <div class="sidenav">
      <a href="{{ url('dashboard') }}">Dashboard</a>
      <a href="{{ url('pengumpulantugas') }}">Pengumpulan Tugas</a>
      <a href="{{ url('penilaiantugas') }}">Penilaian Tugas</a>
      <a href="{{ url('/logout') }}">Log Out</a>
    </div>
  @endif

  <div class="main">
    @yield('content')
  </div>

</body>
</html>
