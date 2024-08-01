
<?php 
    include("../../bd.php");

     //Recepción del envío txtID.    
    if (isset($_GET['txtID'])) {
        //Verificamos si está presente en la URL txtID, asignamos el valor en  $_GET['txtID'] de lo contrario no se asigna ningún valor con :"" .
        $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
        
        //Preparamos la conexion de Editar.
        $sentencia = $conexion->prepare ( "SELECT * FROM tbl_usuario WHERE id=:id" );
        $sentencia->bindParam( ":id" ,$txtID );
        $sentencia->execute();
        
        //Utilizamos el FETCH_LAZY para que cargue solo un registro.
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
        $usuario = $registro["usuario"];
        $password = $registro["password"];
        $email = $registro["email"];
    }
    if ($_POST) {
        //print_r($_POST);
        //Verificamos si existe una peticion $_POST, validamos si ese if isset sucedio, lo vamos igualar a ese valor, de lo contrario no sucedio
        //Lo verificamos este valor $_POST["nombredelrol"] lo comparamos con la llave de pregunta (?) $_POST["nombredelrol"] si sucedio, por lo contrario va a quedar en blanco.
        $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "" ;
        $usuario= (isset($_POST["usuario"])) ? $_POST["usuario"] : "";
        $password= (isset($_POST["password"])) ? $_POST["password"] : "";
        $email= (isset($_POST["email"])) ? $_POST["email"] : "";
        
        //Evitamos dejar espacios vacíos !empty.
        if (!empty($usuario) && !empty($password) && !empty($email)){   
            //Actualizamos los datos.
            $sentencia = $conexion->prepare (" UPDATE tbl_usuario  SET  usuario=:usuario, password=:password, email=:email  WHERE id=:id ");
            
            //Asignando los valores que vienen del POST (Los que vienen del formulario)
            $sentencia->bindParam(":usuario",$usuario);
            $sentencia->bindParam(":password",$password);
            $sentencia->bindParam(":email",$email);
            $sentencia->bindParam(":id",$txtID);
            $sentencia->execute();
            //Mensaje de Registro Actualizado (Sweet alert).
            $mensaje="Registro Actualizado";
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
    <h1>Usuario/Editar</h1> 

<div class="card">
    <div class="card-header" style="background-color:bisque" >Actualizar datos del registro</div>
    
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data" style="background-color:azure">
            
        <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <!--En este input se encuentra el readonly es que un atributo de lectura solamente, el usuario no puede modificar el valor-->
                <input type="text" 
                    value= "<?php echo $txtID; ?>"
                    class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />    
            </div>
        
            <div class="mb-3">
                <label for="usuario" class="form-label"><u>Nombre del Usuario:</u></label>
                <input
                    type="text" 
                    value= "<?php echo $usuario; ?>"
                    class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder=""/>                    
            </div>

            <div class="mb-3"> 
                <label for="password" class="form-label"><u>Password:</u></label>
                <input 
                    type="password" 
                    value= "<?php echo $password; ?>"
                    class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="" />
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label"><u>Email:</u></label>
                <input 
                    type="email" 
                    value= "<?php echo $email; ?>"
                    class="form-control" name="email" id="email" aria-describedby="helpId" placeholder=""/>
            </div>
            

            <button type="Submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a >
        </form>
    </div>
    
    <div class="card-footer text-muted" style="background-color:bisque"></div>
</div>


<?php include("../../templates/footer.php");?>