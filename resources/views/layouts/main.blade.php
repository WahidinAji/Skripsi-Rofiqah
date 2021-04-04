<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Siswa</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" crossorigin="anonymous" />
        <script src="{{ asset('js/all.min.js') }}" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">ADMIN</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <h3 class="ml-2 text-white">Data Siswa</h3>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input hidden class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <!-- <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button> -->
                    </div>
                </div>
            </form>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="btn btn-sm">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm">Logout</button>
            </form>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading nav-link active">SMK NEGERI 1 BENGKULU SELATAN</div>
                            <a class="nav-link collapsed {{ Request::url() == url('siswa') ? 'active' : '' }} {{ Request::url() == url('nilai') ? 'active' : '' }}" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Tampil Data
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link {{ Request::url() == url('siswa') ? 'active' : '' }}" href="{{ URL::route('siswa.index') }}">Data Siswa</a>
                                    <a class="nav-link" href="{{ URL::route('nilai.index') }}">Nilai Siswa</a>
                                </nav>
                            </div>
                            <a class="nav-link {{ Request::url() == url('siswa/create') ? 'active' : '' }}" href="{{ URL::route('siswa.create') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></i></div>
                                Tambah Data
                            </a>
                            <a class="nav-link {{ Request::url() == url('status-beasiswa') ? 'active' : '' }}" href="{{URL::route('status.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Status Beasiswa
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{Auth::user()->name}}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                @yield('main')
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('assets/demo/datatables-demo.js') }}"></script>
    </body>
</html>
