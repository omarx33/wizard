<?php
include('modelo/Conexion.php');
include('modelo/Consulta.php');
include('modelo/Funciones.php');
date_default_timezone_set('America/Lima');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once('librerias/PHPMailer/src/Exception.php');
require_once('librerias/PHPMailer/src/PHPMailer.php');
require_once('librerias/PHPMailer/src/SMTP.php');

$subir = new Consulta();
$db = new Conexion();


$funciones  =  new Funciones();
  //  $id = uniqid();//genera una id
  $usuario      = $_POST['usuario'];
  $empresa      = $_POST['empresa'];
  $actividad    = $funciones->validar_xss($_POST['actividad']);
  $descripcion  = $funciones->validar_xss($_POST['descripcion']);
  $archivo      = $_FILES['archivo'];
  $idteam       = $_POST['idteam'];
  $passteam     = $_POST['pass'];

  $detalle2     = $_POST['detalle2'];






 $correlativo           = $subir->Correlativo();
 $foto                  = $subir->SubirArchivo($archivo);
 $dominio               = $subir->Dominio($empresa);
 $correo_usuario        = $subir->Correo($usuario);
 $nombreempresa   = $subir->Dato($empresa);
 $fullname       = $subir->Nombres_user($usuario);
 $nombreactividad       = $subir->Actividad($actividad);
 $completo              =$correo_usuario.$dominio;

 $valor   =  $subir->agregar($foto,$descripcion,$usuario,$actividad,$completo,$idteam,$passteam,$empresa);

 $valor2 = $subir->actualizar($correlativo,$detalle2);

switch ($valor) {
	case 'ok':
$mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->SMTPOptions = array(
'ssl' => array(
'verify_peer' => false,
'verify_peer_name' => false,
'allow_self_signed' => true
)
);

$mail->Host = 'mail.overprimegroup.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'ticket@overprimegroup.com';                 // SMTP username
      $mail->Password = 'Overketov951';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;

      $mail->setFrom('ticket'.$dominio, 'Tickets ROVHECO');
          //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
          $mail->addAddress($completo);
    $mail->isHTML(true);
      $mail->Subject = 'Ticket Registrado N°'.$correlativo;
     $mail->Body    = '<html>
<head>
<title>Ticket Registrado</title>

<style>

body{font-family: arial;   font-weight: bold;}

th{	text-align: left;}
</style>
</head>
<body>
<h1>Registro de Ticket Exitoso</h1>
<h2>Hola '.$fullname.' acabas de registrar el ticket '.$correlativo.',
con el siguiente detalle:</h2>

<table border="1">
	<thead>
		<tr>
			<th>N° de Ticket</th>
			<th>'.$correlativo.'</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th>Usuario</th>
			<th>'.$fullname.'</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th>Empresa</th>
			<th>'.$nombreempresa.'</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th>Tipo</th>
			<th>'.$nombreactividad .'</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th>Detalle</th>
			<th>'.$descripcion.'</th>
		</tr>
	</thead>
	<thead>
		<tr>
			<th>Correo:</th>
			<th>'.$completo.'</th>
		</tr>
	</thead>
</table>
<hr>
Nos estaremos contactando contigo en breves minutos.
<br>
<p>Por favor, no responder a este e-mail. El mensaje le fue enviado usando un sistema automatizado. Esta direcci&oacute;n de e-mail no es revisada ni monitoreada, por lo tanto no recibiriá ninguna respuesta.
</p>

<div >
  <p>Verifica el estado de tu ticket  <a  style="text-decoration: none;" href="#">  aquí..!  </a></p>
</div>
<br>

Atentamente.
<br>
Área de TI
</body>
</html>';
$mail->CharSet = 'UTF-8';
    $mail->send();

//echo 'Correo enviado';



  } catch (Exception $e) {
echo 'Error: ', $mail->ErrorInfo;
  }




  header('Location: form.php');
		break;
	default:
	echo "datos incorrectos";
		break;
}




 ?>
