<?php 
    include("../../bd.php");
    //Recepción del envío txtID.    
    if (isset($_GET['txtID'])) {
        //Verificamos si está presente en la URL txtID, asignamos el valor en  $_GET['txtID'] de lo contrario no se asigna ningún valor con :"" .
        $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
        
        //Preparamos la conexion de Editar.
        $sentencia = $conexion->prepare ( "SELECT * FROM tbl_persona WHERE id=:id" );
        $sentencia->bindParam( ":id" ,$txtID );
        $sentencia->execute();
        
        //Utilizamos el FETCH_LAZY para que cargue solo un registro.
        $registro = $sentencia->fetch(PDO::FETCH_LAZY);
            $nombre = $registro["nombre"]; 
            $apellido = $registro["apellido"]; 
            $dni = $registro["dni"]; 
            $fechanacimiento = $registro["fechanacimiento"]; 
            $email = $registro["email"]; 
            $telefono = $registro["telefono"]; 
            $idrol = $registro["idrol"];
            $fechaingreso = $registro["fechaingreso"];
        
        //Preparamos la sentencia de $conexion y ejecutamos, seguido creamos una lista_tbl_rol, que las filas se devuelvan como un array asociativo.
        $sentencia = $conexion->prepare("SELECT * FROM `tbl_rol`");
        $sentencia->execute();
        $lista_tbl_rol = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
    if ($_POST){
        print_r($_POST);
        
        //Verificamos si existe una peticion $_POST, validamos si ese if isset sucedio, lo vamos igualar a ese valor, de lo contrario no sucedio
        //Lo verificamos a este valor $_POST["usuario"] lo comparamos con la llave de pregunta (?) $_POST["usuario"] si sucedio, de lo contrario va a quedar vacío.
        $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : "";
        $nombre = (isset($_POST["nombre"])) ? $_POST["nombre"]: "";
        $apellido = (isset($_POST["apellido"])) ? $_POST["apellido"]: "";
        $dni = (isset($_POST["dni"])) ? $_POST["dni"]: "";
        $fechanacimiento = (isset($_POST["fechanacimiento"])) ? $_POST["fechanacimiento"]: "";
        $email = (isset($_POST["email"])) ? $_POST["email"]: "";        
        $telefono = (isset($_POST["telefono"])) ? $_POST["telefono"]: "";
        $idrol = (isset($_POST["idrol"])) ? $_POST["idrol"]: "";
        $fechaingreso = (isset($_POST["fechaingreso"])) ? $_POST["fechaingreso"]: "";
            
        //Preparamos la insercción de los datos.
        $sentencia = $conexion->prepare("
        UPDATE tbl_persona 
        SET
            nombre=:nombre,
            apellido=:apellido,
            dni=:dni,
            fechanacimiento=:fechanacimiento,
            email=:email,
            telefono=:telefono,
            idrol=:idrol,
            fechaingreso=:fechaingreso
        WHERE id=:id ");
        
        //Asignando los valores que vienen del  método POST (Los que vienen del formulario).
        $sentencia->bindParam(":nombre",$nombre);
        $sentencia->bindParam(":apellido",$apellido);
        $sentencia->bindParam(":dni",$dni);
        $sentencia->bindParam(":fechanacimiento",$fechanacimiento);
        $sentencia->bindParam(":email",$email);
        $sentencia->bindParam(":telefono",$telefono);
        $sentencia->bindParam(":idrol",$idrol);
        $sentencia->bindParam(":fechaingreso",$fechaingreso);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        //Mensaje de Registro Actualizado (Sweet alert).
        $mensaje="Registro Actualizado";
        header("Location:index.php?mensaje=".$mensaje);
    }
?>

<?php include("../../templates/header.php");?>
<br>
<br>
<!--Estilo para Datos Personales-->
<style> 
    h1 {
        text-align: center; font-family: Georgia, sans-serif;
    }
</style>
    <h1>Datos Personales</h1> 


<div class="card">
    <div class="card-header" style="background-color:bisque">Ingrese los datos para el registro</div>
    
    <div class="card-body">
<!--Formulario para cargar los datos, con style de color-->   
    <form  action="" method="post" enctype="multipart/form-data" style="background-color:azure">
        
        <div class="mb-3">
            <label for="txtID" class="form-label">ID:</label>
            <!--En este input se encuentra el readonly es que un atributo de lectura solamente, el usuario no puede modificar el valor-->
            <input type="text" 
                value= "<?php echo $txtID; ?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID" />    
        </div>
        
        <div class="mb-3">
            <label for="nombre" class="form-label"><u>Nombre:</u></label>
            <input type="text" 
                value= "<?php echo $nombre; ?>"
                class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Ingrese Nombre"/>
        </div>
        
        <div class="mb-3"> 
            <label for="apellido" class="form-label"><u>Apellido:</u></label>
            <input type="text" 
                value= "<?php echo $apellido; ?>"
                class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="Ingrese Apellido"/>
        </div>
        
        <div class="mb-3">
            <label for="dni" class="form-label"><u>Dni:</u></label>
            <input type="number" 
                value= "<?php echo $dni; ?>"
                class="form-control" name="dni" id="dni" aria-describedby="helpId" placeholder="Ingrese Dni"/>            
        </div>
        
        <div class="mb-3">
            <label for="fechanacimiento" class="form-label"><u>Fecha/Nacimiento:</u></label>
            <input type="date" 
                value= "<?php echo $fechanacimiento; ?>"
                class="form-control" name="fechanacimiento" id="fechanacimiento" aria-describedby="helpId" placeholder="Ingrese Dni"/>            
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label"><u>Email:</u></label>
            <input type="email"
                value= "<?php echo $email; ?>" 
                class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder=" Por ejemplo: abc@mail.com"/> 
        </div>
        
        <div class="mb-3">
            <label for="telefono" class="form-label"><u>Teléfono:</u></label>
            <input type="number" 
                value= "<?php echo $telefono; ?>"
                class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Ingrese Teléfono"/>            
                    <small id="helpId" class="form-text text-muted"> sin (0) y sin (15)</small>
        </div>
        
        <div class="mb-3">
            <label for="idrol" class="form-label"><u>Rol:</u></label>
        
                <select
                    class="form-select form-select-ms" name="idrol" id="idrol">
                    <?php foreach ($lista_tbl_rol as $registro) {?>      
                        
                        <option <?php echo ($idrol== $registro['id'])? "selected" : ""; ?> value ="<?php echo $registro['id']?>">
                                        <?php echo $registro['nombredelrol']?>
                        </option>
                    <?php }?>
                </select>
        </div>

        <div class="mb-3">
            <label for="fechaingreso" class="form-label"><u>Fecha/Ingreso:</u></label>
            <input type="date" 
                value= "<?php echo $fechaingreso; ?>"
                class="form-control" name="fechaingreso" id="fechaingreso" aria-describedby="helpId" placeholder="Ingrese Fecha"/>
        </div>
            
        <!--Button bs5-button-default y bs5-button-a (sirve para direccionar) -->
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button" >Cancelar</a>
    </form>
    

<?php include("../../templates/footer.php"); ?>