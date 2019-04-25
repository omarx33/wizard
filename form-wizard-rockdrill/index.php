


<?php
include('modelo/Conexion.php');
include('modelo/Consulta.php');

 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>

    <title>Formulario ticket</title>
    <link rel="shortcut icon" type="image/x-icon" href="/form-wizard/img/ticket.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
    <link rel="shortcut icon" type="image/x-icon" href="http://192.168.1.7/form-wizard/img/ticket.png">

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.1/build/css/themes/default.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

  <link rel="stylesheet" href="http://selectize.github.io/selectize.js/css/selectize.default.css" >
    <script src="http://selectize.github.io/selectize.js/js/selectize.js"></script>



</head>
<body>

    <div class="container">
        <form action="save.php" method="post"  enctype="multipart/form-data" >

          <div style="background-color:#db1515; color:white; ">



            <h5 style="padding: 10px">MESA DE AYUDA - TIC   <i class="fa fa-user-secret" aria-hidden="true"></i> <a style="float: right;">Bienvenido: ROVHECO DATA</a> </h5>

          </div>


          <div  >
          <h1 align="center" style="color:#3D3F1F">Registro de ticket <i class="fa fa-file-text-o"> </i></h1>
         </div>

            <div class="wizards">
                <div class="progressbar">
                    <div class="progress-line" data-now-value="12.11" data-number-of-steps="5" style="width: 12.11%;"></div> <!-- 19.66% -->
                </div>
                <div class="form-wizard active">
                    <div class="wizard-icon"><i class="fa fa-search-plus"></i></div>
                    <p>PASO 1</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-user"></i></div>
                    <p>PASO 2</p>
                </div>
                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-envelope-o"></i></div>
                    <p>PASO 3</p>
                </div>


                <div class="form-wizard">
                    <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                    <p>PASO 4</p>
                </div>

            </div>
            <fieldset>
                <iframe src="texto.html"></iframe>
                <label class="form-check-label">

                    <input class="form-check-input" type="checkbox" value="yes"> Acepto los términos y condiciones
                </label>
                <div class="wizard-buttons" >
                    <button type="button" class="btn btn-next">Siguiente</button>
                </div>
            </fieldset>
            <fieldset>

<u><h4 style="text-align:center" >CAMPOS OBLIGATORIOS</h4></u>
                  <h5>USUARIO</h5>
                <div class="form-group">
<?php $usuario = new Consulta(); ?>
                  <select name="usuario" id="idnombre" required>
                    <option value="">SELECCIONAR</option>
                <?php foreach ($usuario->lista() as $key => $value): ?>
                  <option value="<?php echo $value['idusuario'] ?>"><?php echo $value['nombres'].' '.$value['apellidos']; ?></option>
                <?php endforeach; ?>
                  </select>

                </div>

                <script >
 $('#idnombre').selectize({
 maxItems: 1
 });
 </script>


 <div class="row">
 <div class="col-md-6">
                <div class="form-group">
                    <h5>EMPRESA</h5>

                    <select name="empresa" id="idempresa" required >
                      <option value="">SELECCIONAR</option>
                      <?php foreach ($usuario->lista_empresa() as $key => $value): ?>
                        <option value="<?php echo $value['idempresa'] ?>"><?php echo $value['descripcion']; ?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
</div>

<script >
                $('#idempresa').selectize({
                maxItems: 1
                });
                </script>



                <div class="col-md-6">
                <div class="form-group">
    <h5>ACTIVIDAD</h5>

    <select name="actividad" id="idactividad" class="form-control" autofocus required >
      <option value="">SELECCIONAR</option>
      <?php foreach ($usuario->lista_actividad() as $key => $value): ?>
        <option value="<?php echo $value['idactividad'] ?>"><?php echo $value['descripcion']; ?></option>
      <?php endforeach; ?>
    </select>

  </div>

  </div>

  <div class="col-md-6">
  <div id="modulo_detalle"></div>
  </div>
  </div>







<script>

$(document).ready(function() {
// Parametros para el combo

$("#idactividad").change(function () {
$("#idactividad option:selected").each(function () {
elegido=$(this).val();
$.post("ajax/select/modulo_detalle.php", { elegido: elegido }, function(data){
$("#modulo_detalle").html(data);
});
});
});
});

</script>
<!--
<script >
$('#idactividad').selectize({
maxItems: 1
});
</script>
-->

                <div class="form-group">
                    <h5>DESCRIPCIÓN</h5>
                    <textarea name="descripcion" rows = "5" class="form-control" placeholder="Describir detalladamente su incidente para que nuestra Mesa de Ayuda pueda atender su solicitud, puede adjuntar su archivo y compartir los datos de conexión del TeamViewer."></textarea>
                </div>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-previous">Anterior</button>
                    <button type="button" class="btn btn-next">Siguiente</button>
                </div>
            </fieldset>


  <fieldset>
      <u>    <h4 style="text-align:center" >CAMPOS OPCIONALES</h4></u>
          <br>
          <br>
          <div class="form-group" >
              <h5>ARCHIVO:</h5>
              <input type="file" name="archivo" class="form-control" >
          </div>

          <div class="form-group">
              <H5>ID TEAMVIEWER:</H5>
              <input type="text" name="idteam" autocomplete="off" class="form-control"/>
          </div>
          <div class="form-group">
              <H5>PASS TEAMVIEWER:</H5>
              <input type="text" name="pass" class="form-control" />

          </div>



<br>
<br>
      <div class="wizard-buttons">
          <button type="button" class="btn btn-previous">Anterior</button>
          <button type="button" class="btn btn-next">Siguiente</button>
      </div>
  </fieldset>



            <fieldset>
                <div class="jumbotron text-center">
                <h1>DATOS CORRECTAMETE LLENADOS</h1>
                <P>(Guardar para terminar)</P>
                <p>No te olvides de revisar el estado de tu ticket en el siguiente link: <a href="http://192.168.1.7/tickets-pendientes/" target="_blank">aqui!</a></p>
                </div>
                <div class="wizard-buttons">
                    <button type="button" class="btn btn-previous">Regresar</button>
                    <button type="submit"  class="btn btn-primary btn-submit">Guardar</button>
                </div>
            </fieldset>

        </form>
    </div>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
