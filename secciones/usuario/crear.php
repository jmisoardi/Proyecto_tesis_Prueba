<?php 
    include("../../bd.php");
    if ($_POST){
        //print_r($_POST);
        
        //Verificamos si existe una peticion $_POST, validamos si ese if isset sucedio, lo vamos igualar a ese valor, de lo contrario no sucedio
        //Lo verificamos este valor $_POST["usuario"] lo comparamos con la llave de pregunta (?) $_POST["usuario"] si sucedio, de lo contrario va a quedar vacío.
        $usuario = (isset($_POST["usuario"])) ? $_POST["usuario"]: "";
        $password = (isset($_POST["password"])) ? $_POST["password"]: "";
        $email = (isset($_POST["email"])) ? $_POST["email"]: "";
        
        //Usamos este if para que no este vacio el campo, cuando tiene que introducir el "Nombre del Usuario","password" y "email".
        if (!empty ($usuario) && !empty($password) && !empty ($email) ){
            
            //Preparamos la insercción de los datos.
            $sentencia = $conexion->prepare("INSERT INTO `tbl_usuario`(id, usuario, password, email) VALUES (null, :usuario, :password, :email)");
            
            //Asignando los valores que vienen del  método POST (Los que vienen del formulario).
            $sentencia->bindParam(":usuario",$usuario);
            $sentencia->bindParam(":password",$password);
            $sentencia->bindParam(":email",$email);
            $sentencia->execute();
            //Mensaje de Registro Agregado (Sweet alert).
            $mensaje="Registro Agregado";
            header("Location:index.php?mensaje=".$mensaje);
        }
    
    }

?>

<?php include("../../templates/header.php");?>

<br>
<br>
<style> 
    h1 {
        text-align: center; font-family: Georgia, sans-serif;
    }
</style>
    <h1>Creación de Usuario</h1> 

<div class="card">
    <div class="card-header" style="background-color:bisque" >Ingrese los datos para el registro</div>
    
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data" style="background-color:azure">
            <div class="mb-3">
                <label for="usuario" class="form-label"><u>Nombre del Usuario:</u></label>
                <input
                    type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder=""/>                    
            </div>

            <div class="mb-3"> 
                <label for="password" class="form-label"><u>Password:</u></label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" />
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label"><u>Email:</u></label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder=""/>
            </div>
            

            <button type="Submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a >
        </form>
    </div>
    
    <div class="card-footer text-muted" style="background-color:bisque"></div>
</div>


<?php include("../../templates/footer.php");?>