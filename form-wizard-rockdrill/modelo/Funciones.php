<?php


class  Funciones

{

  function validar_xss($string)
  {
  return htmlspecialchars(trim($string), ENT_QUOTES,'UTF-8');
  }


  function lista_actividad($id){

  try {
    $conexion = new Conexion();
    $modelo   = $conexion->get_conexion();
    $sql      = "SELECT * FROM actividad  WHERE estado='01' and version=2 and dependencia =:id
      order by descripcion";
    $statement= $modelo->prepare($sql);
      $statement->bindParam(':id',$id);
    $statement->execute();
    $result = $statement->fetchAll();
    return $result;

  } catch (\Exception $e) {
    echo "Error".$e->getMessage();
  }


  }




}



 ?>
