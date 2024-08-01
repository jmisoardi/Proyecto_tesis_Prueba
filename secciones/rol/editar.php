<?php 
    
    include("../../bd.php");
    
    //Recepción del envío txtID.    
    if (isset($_GET['txtID'])) {
                //Verificamos si está presente en la URL txtID, asignamos el valor en  $_GET['txtID'] de lo contrario no se asigna ningún valor con :"" .
                $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
                
                //Preparamos la conexion de Editar.
                $sentencia = $conexion->prepare ( "SELECT * FROM tbl_rol WHERE id=:id" );
                $sentencia->bindParam( ":id" ,$txtID );
                $sentencia->execute();
                
                //Utilizamos el FETCH_LAZY para que cargue solo un registro.
                $registro = $sentencia->fetch(PDO::FETCH_LAZY);
                $nombredelrol = $registro["nombredelrol"]; 
                
    }
        if ($_POST) {
            print_r($_POST);
            //Verificamos si existe una peticion $_POST, validamos si ese if isset sucedio, lo vamos igualar a ese valor, de lo contrario no sucedio
            //Lo verificamos este valor $_POST["nombredelrol"] lo comparamos con la llave de pregunta (?) $_POST["nombredelrol"] si sucedio, por lo contrario va a quedar en blanco.
            $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "" ;
            $nombredelrol= (isset($_POST["nombredelrol"])) ? $_POST["nombredelrol"] : "";
            
            //Evitamos dejar espacios vacíos !empty.
            if(!empty($nombredelrol)){    
                //Actualizamos los datos.
                $sentencia = $conexion->prepare (" UPDATE tbl_rol  SET  nombredelrol=:nombredelrol WHERE id=:id ");
                
                //Asignando los valores que vienen del POST (Los que vienen del formulario)
                $sentencia->bindParam(":nombredelrol",$nombredelrol);
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
    <h1>Rol/Editar</h1> 

    <div class="card">
    <div class="card-header" style="background-color:bisque" >Actualizar datos del registro</div>
    
    <form action="" method="post" enctype="multipart/form-data" style="background-color:azure">
        <div class="card-body">
            
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <!--En este input se encuentra el readonly es que un atributo de lectura solamente, el usuario no puede modificar el valor-->
                <input type="text" 
                    value= "<?php echo $txtID; ?>"
                    class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />    
            </div>
            
            <div class="mb-3">
                <label for="nombredelrol" class="form-label"><u>Nombre del Rol:</u></label>
                <input type="text" 
                    value= "<?php echo $nombredelrol; ?>"    
                    class="form-control" name="nombredelrol" id="nombredelrol" aria-describedby="helpId" placeholder=""/>                    
            </div>
                    
            <button type="Submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a >

        </div>
    </form>
    
    <div class="card-footer text-muted" style="background-color:bisque"></div>
</div>


<?php include("../../templates/footer.php");?>