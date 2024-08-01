<!-- Dirección base del proyecto-->
<?php 
    session_start();
    $url_base = "http://localhost/Proyecto_tesis/";
    
    // Verifica si la sesión de usuario está establecida
    if (!isset($_SESSION['usuario']) || !isset($_SESSION['rolpersona'])) {
        header("Location: " . $url_base . "login.php");
        exit(); // Detiene la ejecución del script después de redirigir
    } else {
            }
?>
<!--Contiene Menu y parte del Container -->
<!doctype html>
<html lang="en">
    <head>
        <title>BridgeClass</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        
        <!--Script para data table-->
        <script 
            src="https://code.jquery.com/jquery-3.7.1.min.js" 
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
            crossorigin="anonymous">
        </script>

        <!--Data table installation, brinda estilo y funciones para el data table-->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
        
        <!--Script para sweet alert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
    </head>
    <body>
        <header style="background-color:#63cdda;  text-align:center; font-family: Georgia, sans-serif;" >
            <h1><u>Gestión de Datos</u></h1>
        </header>
        
            <!--Corresponde a la barra de navegación que incluye Sistema, Personal, Rol, Usuario, Cerrar Sesión-->
            <nav class="navbar navbar-expand navbar-light bg-light">
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo $url_base;?>" aria-current="page">Sistema<span class="visually-hidden">(current)</span></a>
                    </li>
                    <!--Ingresamos en "href php con la dirección base"-->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base;?>secciones/personal/">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base;?>secciones/rol/">Rol</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base;?>secciones/usuario/">Usuarios</a>
                    </li>
<!--Se agrego para usarlo en el navegador simplemente comodidad, ver si va en la linea con Personal, rol, usuario, -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base;?>secciones/alumno/">Alumno</a>
                    </li>
<!--Se agrego para usarlo en el navegador simplemente comodidad, ver si va en la linea con Personal, rol, usuario, -->                    
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base;?>secciones/docente/">Docente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $url_base;?>cerrar.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </nav>
            
        <main class="container"> 
        <!--Sweet alert Mensaje de confirmación-->
        <?php if (isset($_GET['mensaje'])) { ?>
            <script>
                Swal.fire({icon:"success", title:"<?php echo $_GET['mensaje']; ?>"});    
            </script>
        <?php } ?>
    </body>