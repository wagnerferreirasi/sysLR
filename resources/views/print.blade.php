<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

    <!-- styles -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/adminlte/adminlte.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
        type="text/css">

    <!-- Bootstrap icons -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('assets/js/jquery.min.js') }}" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        window.print();
        document.close();
    });
    </script>
    <style>
    @page {
        /* size: 58mm 300mm; */
        margin: 0;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #printarea,
        #printarea * {
            visibility: visible;
        }

        #printarea {
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    .page {
        page-break-after: always;
    }

    .texto-maior {
        font-size: 20pt;
        font-weight: bold;
    }
    .text-center {
        text-align: center;
    }
    </style>
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Suporte</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline" wire:submit.prevent="">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Buscar"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-dark bg-warning elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('dashboard') }}" class="text-center brand-link">
                <img src="<?= asset('assets/img/logoalpha_branco.png'); ?>" width="120" alt="Logo"
                    class="img-fluid mb-3">
            </a>

            <div class="sidebar">
                <div class="user-panel d-flex border-0 m-0">
                    <div class="info m-0">
                        <p class="fw-bold mb-0">{{ session('place_name') }}:</p>
                    </div>
                </div>

                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= asset('assets/img/adminlte/user2-160x160.png'); ?>" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        {{ Auth::user()->name; }}
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="{{ route('dashboard') }}" class="nav-link active">
                                <i class="fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}"
                                        class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-home nav-icon"></i>
                                        <p>Home</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.cashiers') }}"
                                        class="nav-link {{ request()->is('dashboard/cashiers') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-cash-register nav-icon"></i>
                                        <p>Abrir/Fechar Caixa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.clients') }}"
                                        class="nav-link {{ request()->is('dashboard/clients') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-user-tie nav-icon"></i>
                                        <p>Clientes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.packages') }}"
                                        class="nav-link {{ request()->is('dashboard/packages') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-box nav-icon"></i>
                                        <p>Pacotes</p>
                                    </a>
                                </li>
                                @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'master')
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.places') }}"
                                        class="nav-link {{ request()->is('dashboard/places') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-store nav-icon"></i>
                                        <p>Lojas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.destinies') }}"
                                        class="nav-link {{ request()->is('dashboard/destinies') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-map-marked-alt nav-icon"></i>
                                        <p>Destinos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.routes') }}"
                                        class="nav-link {{ request()->is('dashboard/routes') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-route nav-icon"></i>
                                        <p>Rotas</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="{{-- route('dashboard.reports') --}}" class="nav-link {{ request()->is('dashboard/reports') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-poll nav-icon"></i>
                                        <p>Relatórios</p>
                                    </a>
                                </li> -->
                                @endif
                                <!-- <li class="nav-item">
                                    <a href="{{-- route('dashboard.alerts') --}}" class="nav-link {{ request()->is('dashboard/alerts') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-exclamation-triangle nav-icon"></i>
                                        <p>Avisos</p>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="{{-- route('dashboard.plans') --}}" class="nav-link {{ request()->is('dashboard/plans') ? 'active' : '' }} text-dark">
                                        <i class="fas fa-truck-loading nav-icon"></i>
                                        <p>Manifestos</p>
                                    </a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link text-dark">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                                <p>
                                    Sair do Sistema
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item active">
                                    <a class="text-warning" href="{{ request()->segment(2) }}">
                                        {{ str_replace('-', ' ', ucfirst(request()->segment(2))) }}
                                    </a>
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <?php $package = session()->get('package'); ?>
            <div class="content">
                <div class="receipt" id="printarea" onload="print()">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                <div class="row">
                                    <div class="col-sm-12 px-5 py-4">
                                        <h3>Comprovante</h3>
                                    </div>
                                    <div class="col-sm-12 px-5">
                                        <span class="badge badge-pill badge-warning">
                                            <h6 class="mb-0">
                                                <strong>LRCODE:</strong> {{ $package->code ?? '' }}
                                            </h6>
                                        </span>
                                    </div>
                                    <div class="col-sm-12 px-5">
                                        <div id="printable">
                                            <div class="row d-flex justify-content-center">
                                                <div class="col">
                                                    <hr>
                                                    <p>LR TUR TRANSLOG</p>
                                                    <p class="small my-0">CNPJ: </p>
                                                    <p class="small my-0">LOJA: </p>
                                                    <p class="small my-0">
                                                        ENDEREÇO: <br />
                                                        <br />
                                                        CEP:
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-center">
                                                <div class="col">
                                                    <hr>
                                                    <p class="my-2">COMPROVANTE DO CLIENTE</p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-center">
                                                <div class="col">
                                                    <p class="text-left my-0">MOVIMENTO: {{ date('d/m/Y H:i:s') }}</p>
                                                        <br />
                                                    <h3>
                                                        @if ($package->payment_method_id == 7)
                                                            <span class="badge badge-pill badge-success">PAGAMENTO NO DESTINO</span>
                                                        @endif
                                                    </h3>
                                                    </p>
                                                    <p class="my-0">OPERADOR(A): </p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-center">
                                                <div class="col">
                                                    <table class="table table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">ITEM</th>
                                                                <th scope="col">VALOR</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>

                                                                <th>Pac {{$package->length}} x {{$package->width}} x {{$package->height}}</th>
                                                                <td>R$ {{session()->get('package')->value ?? ''}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <p class="my-0">VALOR DO PACOTE: R$
                                                        {{session()->get('package')->value ?? ''}}</p>
                                                    </p>
                                                    <p class="my-0">DESTINO: {{ session()->get('package')->destiny ?? '' }}</p>
                                                    <p class="my-0">MEDIDAS(CxLxA): {{$package->length}} x {{$package->width}} x {{$package->height}}</p>
                                                    <p class="my-0 texto-maior">RASTREADOR:</p>
                                                    <p class="my-0 texto-maior">
                                                        {{ $package->code ?? ''}}
                                                    </p>
                                                    <p class="my-0 display-4"></p>
                                                    <p class="lead my-0 font-weight-bold"></p>
                                                    <hr>
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-center">
                                                <div class="d-flex">
                                                    <img src="{{ route('qrcode', ['id'=>$package->code]) }}" width="300" alt="QRCode">
                                                    <hr>
                                                </div>
                                                <div class="col">
                                                    <p class="my-0 texto-maior">{{ $package->code ?? '' }}</p>
                                                    <p class="my-0 display-4"></p>
                                                </div>
                                            </div>


                                            <div class="page"></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Side Panel</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Painel de Controle
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2021-<?= date('Y') ?> <a class="text-warning" target="_blank"
                    href="https://ferreirasi.tk">Ferreira S.I</a>.</strong> Todos os direitos reservados.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->

    <!-- font awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"
        integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/js/adminlte/adminlte.min.js') }}"></script>
    <!-- Charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <!-- swal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- toastr -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- viaCep -->
    <script src="{{ asset('assets/js/viaCep.js') }}"></script>
    <!-- Swal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- OPTIONAL SCRIPTS -->
    @livewireScripts
    <script src="{{ asset('vendor/pharaonic/pharaonic.select2.min.js') }}"></script>
    @yield('scripts')

    <script>
    document.addEventListener('alert', event => {
        Swal.fire({
            title: event.detail.title,
            text: event.detail.message,
            icon: event.detail.type,
            showConfirmButton: false,
            timer: event.detail.timer ?? 4000,
            timerProgressBar: true,
        })
    })
    </script>
</body>

</html>

</html>
