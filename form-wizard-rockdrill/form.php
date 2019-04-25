<?php

include('modelo/Conexion.php');
include('modelo/Consulta.php');

$subir = new Consulta();
 $correlativo           = $subir->Correlativo();
$db = new Conexion();


 ?>
<!DOCTYPE html>
<html>
<head>

    <title>Formulario tickets</title>
    <link rel="shortcut icon" type="image/x-icon" href="/img/ticket.png">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
    <link href="style.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
</head>
<body >
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10" style="margin-top: 20px;">
<div  class="panel panel-info">
  <div class="panel-heading">
    <h2  class="panel-title"><i class="glyphicon glyphicon-user"></i> LISTADO DE TICKETS EN COLA</h2>
  </div>
  <div class="panel-body">

<div class="table-responsive">


        <table id="consulta" class="table table-bordered table-striped">
            <thead>
                <tr  class="success">
                    <th style="text-align:center">Ticket</th>
                    <th style="text-align:center">Fecha creación</th>
                    <th style="text-align:center">Usuario</th>
                    <th style="text-align:center">Detalle</th>
                    <th style="text-align:center">Actividad</th>

                    <th style="text-align:center">Empresa</th>

                    <th style="text-align:center">Estado</th>

                </tr>
            </thead>
            <tbody>
              <?php foreach ($subir->listar() as $key => $value): ?>
            			<tr>
            			<td><?php echo $value['idticket_cab']; ?></td>
            			<td><?php echo $value['fecha_creacion']; ?></td>
            			<td><?php echo $value['fullname']; ?></td>
            			<td><?php echo $value['detalle']; ?></td>
                 <td><?php echo $value['actividades']; ?></td>
            			<td><?php echo $value['empresas']; ?></td>
                  <td><?php echo $value['categoria']; ?></td>

            			</tr>
             			<?php endforeach ?>

            </tbody>
        </table>
        </div>
        <p class="text-center">
            <br/>
            <a href="http://ticket.rockdrillgroup.info/" class="btn btn-primary">Generar otro Ticket</a>
            <a href="http://192.168.1.7/aplicaciones/" class="btn btn-primary">Ir al integrador de Aplicaciones</a>
        </p>
    </div>

    <script>
    $(document).ready(function() {
        $('#consulta').DataTable({
          "order": [[ 0, "desc" ]],
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"

    }
  });
    } );
    </script>


    <script>
      swal({

    title:"Registro Exitoso",
    text: "Ticket Registrado Nro"+' '+<?php echo $correlativo-1 ?>,
    type: 'success',
    timer: 3000,
    showConfirmButton:false
  });

    </script>
  </div>
</div>
</div>
</div>
</body>
</html>
