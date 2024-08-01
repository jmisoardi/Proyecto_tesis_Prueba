<?php 
    include("../../bd.php");
    
    if ($_POST) {
        print_r($_POST);
        
        //Verificamos si existe una peticion $_POST, validamos si ese if isset sucedio, lo vamos igualar a ese valor, de lo contrario no sucedio
        //Lo verificamos este valor $_POST["nombredelrol"] lo comparamos con la llave de pregunta (?) $_POST["nombredelrol"] si sucedio, de lo contrario va a quedar vacío.
        $nombredelrol = (isset($_POST["nombredelrol"])) ? $_POST["nombredelrol"]: "";
        
        //Usamos este if para que no este vacio el campo, cuando tiene que introducir el "Nombre del Rol".
        if(!empty($nombredelrol)){
            
            //Preparamos la insercción de los datos.
            $sentencia = $conexion->prepare("INSERT INTO `tbl_rol`(id, nombredelrol) VALUES (null, :nombredelrol)");
            
            //Asignando los valores que vienen del  método POST (Los que vienen del formulario).
            $sentencia->bindParam(":nombredelrol",$nombredelrol);
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
    <h1>Asignación de Roles</h1> 

<div class="card">
    <div class="card-header" style="background-color:bisque" >Ingrese los datos para el registro</div>
    
    <div class="card-body">
        
        <form action="" method="post" enctype="multipart/form-data" style="background-color:azure">
            <div class="mb-3">
                <label for="nombredelrol" class="form-label"><u>Nombre del Rol:</u></label>
                <input type="text" class="form-control" name="nombredelrol" id="nombredelrol" aria-describedby="helpId" placeholder=""/>                    
            </div>
            
            <button type="Submit" class="btn btn-success">Agregar</button>
            <a  class="btn btn-primary" href="index.php" role="button">Cancelar</a >
        </form>
    </div>
    
    <div class="card-footer text-muted" style="background-color:bisque"></div>
</div>

<?php include("../../templates/footer.php");?>