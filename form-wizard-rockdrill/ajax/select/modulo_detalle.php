<?php
include('../../modelo/Conexion.php');

include('../../modelo/Funciones.php');
$usuario =  new Funciones();

  $id     =  $_POST['elegido'];


 ?>
 <?php if ($id==52 || $id==53): ?>


  <h5>DETALLES</h5>
   <select class="form-control" name="detalle2">
       <option value="">SELECCIONAR</option>
       <?php foreach ($usuario->lista_actividad($id) as $key => $value): ?>
         <option value="<?php echo $value['idactividad'] ?>"><?php echo $value['descripcion']; ?></option>
       <?php endforeach; ?>
   </select>

<br>
 <?php endif; ?>
