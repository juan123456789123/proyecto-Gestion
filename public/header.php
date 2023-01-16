<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reportes Greencore Solutions</title>
    <link rel="shortcut icon" type="image/x-icon" href="public//img/logo.ico" />
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/modern-business.css" rel="stylesheet">
    <link href="public/css/site.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-network.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="text/javascript" src="public/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.js"></script>
    <script src="https://kit.fontawesome.com/0ca66e1d09.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis-network.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="public/js/password.js"></script>
    <!-- <script src="public/js/select.js"></script> -->
</head>

<body id="cuerpo">
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <!-- href="?controlador=Default" -->
            <a class="navbar-brand" href="?controlador=Default&accion=principal"><img class="img-fluid" id="logo" src="public/img/logo-greencore-solutions.png" alt="logo" width="200" /></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="?controlador=Reporte&accion=accionMostrarReportes"> Consultar Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controlador=Usuario&accion=accionMostrarUsuarios">Gestionar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controlador=Cliente&accion=accionMostrarClientes">Gestionar Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controlador=Contrato&accion=accionMostrarContratos">Gestionar Contratos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?controlador=Login&accion=cerrarSession">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Page Content -->
    <div class="container">