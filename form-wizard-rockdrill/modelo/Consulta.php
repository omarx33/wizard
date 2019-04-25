<?php

class Consulta{


function lista(){

try {
  $conexion = new Conexion();
  $modelo   = $conexion->get_conexion();
  $sql      = "SELECT * FROM usuario WHERE estado='01'
         ORDER BY nombres";
  $statement= $modelo->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
  return $result;

} catch (\Exception $e) {
  echo "Error".$e->getMessage();
}


}



function lista_empresa(){

try {
  $conexion = new Conexion();
  $modelo   = $conexion->get_conexion();
  $sql      = "SELECT * FROM empresa  WHERE estado='01' ORDER BY descripcion";
  $statement= $modelo->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
  return $result;

} catch (\Exception $e) {
  echo "Error".$e->getMessage();
}


}


function lista_actividad(){

try {
  $conexion = new Conexion();
  $modelo   = $conexion->get_conexion();
  $sql      = "SELECT * FROM actividad  WHERE estado='01' and version=2 and dependencia is null
    order by descripcion";
  $statement= $modelo->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
  return $result;

} catch (\Exception $e) {
  echo "Error".$e->getMessage();
}


}


function listar(){

try {
  $conexion = new Conexion();
  $modelo   = $conexion->get_conexion();
  $sql      = "SELECT t.fecha_asignacion,t.idticket_cab,CONCAT(u.nombres,' ',u.apellidos)AS fullname,
  t.detalle,t.archivo,a.descripcion as actividades,t.idteamviewer,t.passteamviewer,
  e.descripcion as empresas,DATE_FORMAT(t.fecha_creacion,'%d-%m-%Y %H:%i:%s')as fecha_creacion,c.categoria FROM ticket_cab AS t INNER JOIN actividad AS a  ON
  t.actividad_idactividad=a.idactividad INNER JOIN empresa AS e  ON
  t.empresa_idempresa=e.idempresa INNER JOIN usuario AS u  ON
  t.usuario_idusuario=u.idusuario left join categoria as c on t.idcategoria=c.idcategoria
  WHERE t.estado='02'ORDER BY t.idticket_cab DESC";
  $statement= $modelo->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll();
  return $result;

} catch (\Exception $e) {
  echo "Error".$e->getMessage();
}


}


function SubirArchivo($file)
{

	/*Inicio*/
/*Recuperar el archivo y guardar la variable*/
$carpeta="../files-ticket/";
opendir($carpeta);
$destino=$carpeta.date('d-m-Y H:i:s').'_'.$file['name'];//ruta donde se va a guardar la foto
copy($file['tmp_name'], $destino);//copiado a ruta
return $archivo=date('d-m-Y H:i:s').'_'.$file['name'];//variable que almacena la ruta
/*fin*/


}


function FormatoDetalle($detalle)
{

$ValidarDetalle=eregi_replace("[\n|\r|\n\r]",' ',$detalle);

return addslashes($ValidarDetalle);
}


public function agregar($foto,$f_detalle,$usuario,$actividad,$completo,$idteam,$passteam,$empresa)
{

try {

  $modelo    = new Conexion();
  $conexion  = $modelo->get_conexion();
  $query     = "INSERT INTO ticket_cab
  (usuario_idusuario,detalle,archivo,correo,estado,actividad_idactividad,fecha_creacion,idteamviewer,passteamviewer,
      usuario_tecnico,empresa_idempresa)
      VALUES(:usuario,:f_detalle,:foto,:completo,'02',:actividad, DATE_ADD(NOW(), INTERVAL -5 HOUR),:idteam,:passteam,0,:empresa)";
      $statement = $conexion->prepare($query);
      $statement->bindParam(':usuario',$usuario);
      $statement->bindParam(':f_detalle',$f_detalle);
      $statement->bindParam(':foto',$foto);
      $statement->bindParam(':completo',$completo);
      $statement->bindParam(':actividad',$actividad);
      $statement->bindParam(':idteam',$idteam);
      $statement->bindParam(':passteam',$passteam);
      $statement->bindParam(':empresa',$empresa);

      $statement->execute();
      return "ok";





} catch (\Exception $e) {

  echo "Error: ".$e->getMessage();

}





}


//--------------------------
function Correo($usuario)
{
  try {

    $modelo    = new Conexion();
    $conexion  = $modelo->get_conexion();
    $query     = "SELECT * FROM usuario WHERE idusuario=:usuario";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':usuario',$usuario);
    $statement->execute();
    $result   = $statement->fetch();
    return $result['correo'];
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage();
    }


}


function Nombres_user($nombres)
{
  try {

    $modelo    = new Conexion();
    $conexion  = $modelo->get_conexion();
    $query     = "SELECT concat(nombres,' ',apellidos)as fullname FROM usuario WHERE idusuario=:nombres";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':nombres',$nombres);
    $statement->execute();
    $result   = $statement->fetch();
    return $result['fullname'];
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage();
    }

}


function Dato($empresa)
{
  try {

    $modelo    = new Conexion();
    $conexion  = $modelo->get_conexion();
    $query     = "SELECT * FROM empresa WHERE idempresa=:empresa";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':empresa',$empresa);
    $statement->execute();
    $result   = $statement->fetch();
    return $result['descripcion'];
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage();
    }

}


function Actividad($actividad)
{
  try {

    $modelo    = new Conexion();
    $conexion  = $modelo->get_conexion();
    $query     = "SELECT * FROM actividad WHERE idactividad=:actividad";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':actividad',$actividad);
    $statement->execute();
    $result   = $statement->fetch();
    return $result['descripcion'];
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage();
    }

}



function mensaje($titulo,$tipo,$texto,$tiempo)
{
return  '<script>
		swal({
		title: "'.$titulo.'",
		type:"'.$tipo.'",
		text: "'.$texto.'",
		timer: '.$tiempo.'000,
		showConfirmButton: false
		});
        </script>';
}




function sweetalert()
{
echo '
<script src="http://t4t5.github.io/sweetalert/dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="http://t4t5.github.io/sweetalert/dist/sweetalert.css">
';
}



function Dominio($empresa)
{
  try {

    $modelo    = new Conexion();
    $conexion  = $modelo->get_conexion();
    $query     = "SELECT * FROM empresa WHERE idempresa=:empresa";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':empresa',$empresa);
    $statement->execute();
    $result   = $statement->fetch();
    return $result['correo_corporativo'];
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage();
    }

}
//------------------------------




function Correlativo(){

try {

$modelo = new Conexion();
$conexion = $modelo->get_conexion();
$query    = "SELECT idticket_cab FROM  ticket_cab  order by idticket_cab desc limit 1";
$statement = $conexion->prepare($query);
$statement->execute();
$result  = $statement->fetch();
return $result['idticket_cab']+1;
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}


}





public function actualizar($correlativo,$detalle2){
try {
  $modelo = new Conexion();
  $conexion = $modelo->get_conexion();
  $query="UPDATE ticket_cab set actividad_idactividad =:detalle2 where idticket_cab=:correlativo";
  $statement = $conexion->prepare($query);
  $statement->bindParam(':correlativo',$correlativo);
  $statement->bindParam(':detalle2',$detalle2);

  $statement->execute();
  return "ok";



} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}


}




}





 ?>
