<?php 
    
    session_start();
    if($_POST){
        include("./bd.php");
        
        //Preparamos la sentencia de $conexion y contamos cuantos registros hay, ejecutamos, seguido creamos una lista_tbl_rol, que las filas se devuelvan como un array asociativo.
        $sentencia = $conexion->prepare("SELECT * ,count(*) as n_usuario
        FROM `tbl_persona` 
        WHERE usuario=:usuario 
        AND password=:password
        ");
        
        $usuario=$_POST["usuario"];
        $password=$_POST["password"];

        $sentencia->bindParam( ":usuario" ,$usuario );
        $sentencia->bindParam( ":password" ,$password );

        $sentencia->execute();
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        $rolpersona = $registro->idrol;
        
        if ($registro["n_usuario"]>0) {
            $_SESSION['usuario']=$registro["usuario"];
            /* $_SESSION['rolpersona']=$rolpersona; */
            
            $sentencia = $conexion->prepare("SELECT * FROM `tbl_rol`");
            $sentencia->execute();
            $lista_tbl_rol = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($lista_tbl_rol as $rolfor) {
                if ($rolfor['id'] === $rolpersona) {
                    $_SESSION['rolpersona'] = $rolfor['nombredelrol'];
                    /* print_r($tipoderol); */
                    break; 
                }
            }
            /* print_r($_SESSION ['rolpersona']);  */
            switch ($_SESSION['rolpersona']) {
                case 'administrador':
                    header("Location:index.php");
                    break;
                case 'docente':
                    header("Location:secciones/docente/index.php");
                    break;
                case 'alumno':
                    header("Location:secciones/alumno/index.php");
                    break;
            }       
        }else{
            $mensaje="Error: El usuario o password son incorrecto";
        }        
        
    }

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>
    <body>
        <header>
            <head>
                <!--Estilo css para ver el ojo en el LOGIN-->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            </head>
        </header>
        <main class="container">
            <div class="row">
                <div class="col-md-4"></div>
                    
                <div class="col-md-4">
                    <br><br><br><br><br>
                    <style> 
                        h1 { text-align: center; font-family: Georgia, sans-serif; }
                    </style>
                    <h1>Iniciar Sesion</h1> 

                    <div class="card">
                        <div class="card-header" style="background-color:bisque"></div>
                            <div class="card-body"style="background-color:azure">
                            
                                <!--Alerta de error en el inicio de sesion con mensaje-->
                                <?php if (isset($mensaje)){?>
                                    <div
                                        class="alert alert-danger" role="alert">
                                        <strong><?php echo $mensaje;?></strong>
                                    </div>
                                <?php }?>

                                <form action="" method="post">
                                    <div class="mb-3">
                                        <label for="usuario" class="form-label">Usuario:</label>
                                            <input type="text" class="form-control" name="usuario" id="usuario"  placeholder="Escriba su usuario"/>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña:</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Escriba su contraseña"/>
                                            <span class="input-group-text" onclick="togglePassword()">
                                                <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <!--Script para ver el password-->
                                    <script>
                                        function togglePassword() {
                                                var passwordInput = document.getElementById("password");
                                                var toggleIcon = document.getElementById("togglePasswordIcon");
                                                if (passwordInput.type === "password") {
                                                    passwordInput.type = "text";
                                                    toggleIcon.classList.remove("fa-eye");
                                                    toggleIcon.classList.add("fa-eye-slash");
                                                } else {
                                                    passwordInput.type = "password";
                                                    toggleIcon.classList.remove("fa-eye-slash");
                                                    toggleIcon.classList.add("fa-eye");
                                                }
                                        }
                                    </script>
                                    <!--Contenedor para centrar el botón-->
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Entrar al sistema</button>
                                    </div>
                                    
                                </form>
                            </div>
                        <div class="card-footer text-muted" style="background-color:bisque"> </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
