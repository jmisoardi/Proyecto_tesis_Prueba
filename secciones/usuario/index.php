<?php
    include ("../../bd.php");

    //Verificamos si se envío txtID por el metodo GET (enviar).    
    if (isset($_GET['txtID'])) {
                //Verificamos si está presente en la URL txtID, asignamos el valor en  $_GET['txtID'] de lo contrario no se asigna ningún valor con :"" .
                $txtID = (isset ($_GET['txtID'])) ? $_GET['txtID'] :"";
                //Preparamos la conexion de Borrado.
                $sentencia = $conexion->prepare ( "DELETE FROM tbl_usuario WHERE id=:id" );
                $sentencia->bindParam( ":id" ,$txtID );
                $sentencia->execute();
                //Mensaje de Registro Eliminado (Sweet alert).
                $mensaje="Registro Eliminado";
                header("Location:index.php?mensaje=".$mensaje);
            }

        //Preparamos la sentencia de $conexion y ejecutamos, seguido creamos una lista_tbl_rol, que las filas se devuelvan como un array asociativo.
        $sentencia = $conexion->prepare("SELECT * FROM `tbl_usuario`");
        $sentencia->execute();
        $lista_tbl_usuario = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php");?>
<br>
<br>
<style> 
    h1 {
        text-align: center; font-family: Georgia, sans-serif;
    }
</style>
    <h1>Usuarios</h1> 
<div class="card">
    <!--Header y button primary-->
        <div class="card-header" style="background-color:bisque">   
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button" >Agregar Usuarios</a>
        </div> 
    
        <div class="card-body" style="background-color:azure">
                    
            <div class="table-responsive-sm">
                <!--Usamos el id "tabla_id" para que tenga los estilos de busquedas, el script se encuentra en el footer-->
                <table class="table" id="tabla_id">
                    <thead>
                        <tr>
                            <!--Alineación central del ID, Nombre/Rol, Acciones-->
                            <style> 
                                th {
                                    text-align: center; font-family: Georgia, sans-serif;
                                    }
                            </style>
                                <th scope="col" style="background-color:azure"><u>ID</u></th>
                                <th scope="col" style="background-color:azure"><u>Nombre/Usuario</u></th>
                                <th scope="col" style="background-color:azure"><u>Password</u></th>
                                <th scope="col" style="background-color:azure"><u>Email</u></th>
                                <th scope="col" style="background-color:azure"><u>Acciones</u></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <!--Usamos el foreach para recorrer el arreglo de la lista de rol y asignarlo a la variable $registro-->  
                        <?php foreach ($lista_tbl_usuario as $registro) {?>     
                        
                            <!--Alineación central style-->
                            <style>
                                td  {
                                    text-align: center; font-family: Georgia, sans-serif;
                                    }   
                            </style>
                                <tr class="">
                                    <td scope="row"><?php echo $registro['id'];?></td>
                                    <td><?php echo $registro['usuario'];?></td>
                                    <td><?php echo $registro['password'];?></td>
                                    <td><?php echo $registro['email'];?></td>
                                
                                    <td>
                                        <!--Utilizamos bs5-button-a seguido de la línea de código para editar el ID de la fila. -->
                                        <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button" >Editar</a >
                                        <!--Utilizamos bs5-button-a seguido de la línea de código para obtener el ID y que nos elimine la fila. -->
                                        <!--El signo sirve para pasar parametros por URL.-->
                                        <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button" >Eliminar</a >   
                                    </td>
                                </tr>
                        <?php } ?>    
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted" style="background-color:bisque"></div>
</div>

<?php include("../../templates/footer.php");?>