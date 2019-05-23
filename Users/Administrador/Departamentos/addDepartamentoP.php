<?php
    if(isset($_POST['enviar'])) {
        include("../include/conexion.php");

   
        
        
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
       

        $sql="INSERT INTO departamentos(nombre) VALUES ('$nombre');";


        $query = mysqli_query($conn,$sql);
        if ($query) {
            header("Location: showDepartamento.php?e=2");
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>