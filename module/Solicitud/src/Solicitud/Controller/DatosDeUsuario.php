<?php
namespace Solicitud\Controller;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Ddl\Column\Boolean;


function getDatosUsuario (AdapterInterface $dbadapter, $usuario){
	
	$sql       = 'SELECT u.nombres, u.apellidos, u.telefono, u.email,  u.numero_de_documento  FROM usuarios AS u
				WHERE u.usuario = '.$usuario;
	
	$statement = $dbadapter->query($sql);
	$result    = $statement->execute();
	
	foreach ($result as $res) {
		// retornar nombre del usuario
		$nombresUsuario = $res['nombres'];
		$apellidosUsuario = $res['apellidos'];
		$telefonoUsuario = $res['telefono'];
		$numeroDocumento = $res['numero_de_documento'];
		$emailUsuario = $res['email'];
	}
	
	return array("nombres"=>$nombresUsuario, "apellidos" => $apellidosUsuario,
			"telefono" => $telefonoUsuario, "numero_de_documento" => $numeroDocumento,
			"email" => $emailUsuario);

	
}

