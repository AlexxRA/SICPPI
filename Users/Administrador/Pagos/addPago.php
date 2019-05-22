<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Abarrotes RAGA</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="../../../css/sb-admin.css" rel="stylesheet">

  </head>

<body id="page-top">
<?php 
    //include("../../caducarSesion.php"); 
    include("addPagoP.php");
    session_start();

  ?>

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Abarrotes RAGA</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->


      <!-- Navbar -->
      <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
              <i><?php echo $_SESSION["nombre"] ?></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar sesión</a>
          </div>
        </li>
      </ul>

    </nav>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Información</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="../Productos/showProducto.php">Productos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Ventas/showVentas.php">Ventas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../User/showUser.php">Usuarios</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Departamentos/showDepartamento.php">Departamentos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Pedidos/showPedido.php">Pedidos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Pagos/showPago.php">Pagos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../DetallePedido/showDetPedido.php">Detalle Pedido</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Clientes/showCliente.php">Clientes</a>
          </div>
        </li>
      </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="showPago.php">Pagos</a>
                </li>
                <li class="breadcrumb-item active">Agregar</li>
            </ol>

            <!-- Registrar nuevo pedido-->
            <div class="card card-register mx-auto">
                <div class="card-header">Registrar nuevo pago</div>
                <div class="card-body">
                    <form action="addPago.php" method="post" name="formPagos">
                       
                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="date" id="fecha_pago" name="fecha_pago" class="form-control" placeholder="Fecha pago" required >
                                        <label for="fecha_pago">Fecha Pago</label>
                                        <div id="checkuser" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="number" step="0.01" id="monto" name="monto" class="form-control" placeholder="Monto" required >
                                        <label for="monto">Monto</label>
                                    </div>
                                </div>
                            </div>
                        </div>
           
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="id_pedido" >Numero de Pedido</label>
                                            </div>
                                            <?php
                                            $conn = mysqli_connect("localhost", "root", "", "sicppi");
                                            $conn->set_charset("utf8");
                                            $sql = mysqli_query($conn, "SELECT *  FROM pedidos");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location: showPago.php");
                                            }else{
                                                while($row = mysqli_fetch_assoc($sql)){
                                                    $option .= '<option value = "'.$row['id_pedido'].'">'.$row['id_pedido'].'</option>';
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="id_pedido" name="id_pedido" autofocus="autofocus" required>
                                                <?php echo $option; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="enviar" id="enviar" class="btn btn-sm btn-primary">Agregar</button>
                                <a href="showPago.php" class="btn btn-sm btn-danger">Cancelar</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php
            include("../include/footer.php")
        ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<!-- Logout Modal-->
<!-- Scripts-->
<?php
include("../include/scroll.php");
include("../include/logoutModal.php");
include ("../include/scripts.php");
?>

<script>
    /*$(document).ready(function () {
        $("#usuario").keyup(checarUser);
    });

    $(document).ready(function () {
        $("#usuario").change(checarUser);
    });

    function checarUser() {
        var usuario = document.getElementById('usuario').value;

        if (usuario) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("checkuser").innerHTML = xhttp.responseText;
                    nsresponsed = document.getElementById('userchecker').value;

                    if (nsresponsed == "0") {
                        document.getElementById("input").disabled = true;
                    } else {
                        document.getElementById("input").disabled = false;
                    }
                }
            };
            xhttp.open("POST", "checkUser.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("user=" + usuario + "");
        }
        else{
            document.getElementById("checkuser").innerHTML = "";
            document.getElementById("input").disabled = false;
        }
    }*/
</script>

</body>

</html>