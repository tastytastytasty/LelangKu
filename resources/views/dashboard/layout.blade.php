<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset('assets/img/icons/leg.png')}}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>LelangKu</title>

    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand">
                    <span class="align-middle">LelangKu</span>
                </a>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Menu
                    </li>
                    @if (auth()->guard('masyarakat')->check())
                        <li class="sidebar-item {{ request()->is('masyarakat/dashboard') ? 'active' : '' }}">
                            <a class="sidebar-link" href="/masyarakat/dashboard">
                                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Beranda</span>
                            </a>
                        </li>
                        <li class="sidebar-header">
                            Transaksi
                        </li>
                        <li class="sidebar-item {{ request()->is('lelang') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{route('lelang')}}">
                                <i class="align-middle" data-feather="tag"></i> <span class="align-middle">Transaksi
                                    Lelang</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('history') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{route('history')}}">
                                <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Histori
                                    Lelang</span>
                            </a>
                        </li>
                    @elseif (auth()->guard('petugas')->check() && auth()->guard('petugas')->user()->id_level == 1)
                        <li class="sidebar-item {{ request()->is('petugas/dashboard') ? 'active' : '' }}">
                            <a class="sidebar-link" href="/petugas/dashboard">
                                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Beranda</span>
                            </a>
                        </li>
                        <li class="sidebar-header">
                            Data
                        </li>
                        <li class="sidebar-item {{ request()->is('petugas') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{route('petugas')}}">
                                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Kelola
                                    Petugas</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('masyarakat') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{route('masyarakat')}}">
                                <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Kelola
                                    Masyarakat</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('barang') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('barang') }}">
                                <i class="align-middle" data-feather="box"></i> <span class="align-middle">Data
                                    Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-header">
                            Laporan
                        </li>
                        <li class="sidebar-item {{ request()->is('laporan') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('laporan') }}">
                                <i class="align-middle" data-feather="clipboard"></i> <span
                                    class="align-middle">Laporan</span>
                            </a>
                        </li>
                    @elseif (auth()->guard('petugas')->check() && auth()->guard('petugas')->user()->id_level == 2)
                        <li class="sidebar-item {{ request()->is('petugas/dashboard') ? 'active' : '' }}">
                            <a class="sidebar-link" href="/petugas/dashboard">
                                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Beranda</span>
                            </a>
                        </li>
                        <li class="sidebar-header">
                            Data
                        </li>
                        <li class="sidebar-item {{ request()->is('barang') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('barang') }}">
                                <i class="align-middle" data-feather="box"></i> <span class="align-middle">Data
                                    Barang</span>
                            </a>
                        </li>
                        <li class="sidebar-header">
                            Transaksi
                        </li>
                        <li class="sidebar-item {{ request()->is('lelang') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{route('lelang')}}">
                                <i class="align-middle" data-feather="tag"></i> <span class="align-middle">Transaksi
                                    Lelang</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->is('history') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{route('history')}}">
                                <i class="align-middle" data-feather="clock"></i> <span class="align-middle">Histori
                                    Lelang</span>
                            </a>
                        </li>
                        <li class="sidebar-header">
                            Laporan
                        </li>
                        <li class="sidebar-item {{ request()->is('laporan') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('laporan') }}">
                                <i class="align-middle" data-feather="clipboard"></i> <span
                                    class="align-middle">Laporan</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                @if (auth()->guard('masyarakat')->user())
                                    <img src="{{asset('storage/' . auth()->guard('masyarakat')->user()->gambar)}}"
                                        class="avatar img-fluid rounded-circle mx-2" alt="User" />
                                @else
                                    <img src="{{asset('storage/' . auth()->guard('petugas')->user()->gambar)}}"
                                        class="avatar img-fluid rounded-circle mx-2" alt="User" />
                                @endif
                                <span class="text-dark">
                                    @if (auth()->guard('masyarakat')->check())
                                        {{ auth()->guard('masyarakat')->user()->nama_lengkap }}
                                    @elseif (auth()->guard('petugas')->check())
                                        {{ auth()->guard('petugas')->user()->username }}
                                    @endif
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{route('profile.edit')}}"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="align-middle me-1" data-feather="corner-down-left"></i>
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="content">
                <div class="container-fluid p-0">
                    @if (session('success'))
                        <div id="alertBox" class="alert alert-success text-success"
                            style="padding:10px; margin-bottom:10px; background:#d4edda; position:relative;">
                            {{ session('success') }}
                            <button id="closeAlert" class="text-success"
                                style="position:absolute; top:5px; right:10px; background:none; border:none; font-size:20px; line-height:20px; cursor:pointer;">
                                &times;
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div id="alertBox" class="alert alert-danger text-danger"
                            style="padding:10px; margin-bottom:10px; background:#f8d7da; position:relative;">
                            {{ session('error') }}
                            <button id="closeAlert" class="text-danger"
                                style="position:absolute; top:5px; right:10px; background:none; border:none; font-size:20px; line-height:20px; cursor:pointer;">
                                &times;
                            </button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" target="_blank"><strong>LelangKu</strong></a> &copy;
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{asset('assets/js/app.js')}}"></script>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var closeBtn = document.getElementById("closeAlert");
        var alertBox = document.getElementById("alertBox");

        if (closeBtn) {
            closeBtn.addEventListener("click", function () {
                alertBox.style.display = "none";
            });
        }
    });
</script>

</html>