<?php
namespace Solicitud\Form\Formulario;
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

function getMateriasYProfesoresUsuario(AdapterInterface $sapDbAdapter, $numeroDocumento, $actual){
	
	if ($actual){
		$restriccion = " AND axc.curso_actual = TRUE";	
	}else{
		$restriccion = " ";
	}
	
	$sql       = "SELECT m.materia, m.nombre AS n_materia, p.profesor , p.nombre AS n_profesor FROM materias AS m INNER JOIN cursos AS c ON m.materia = c.materia
				INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso AND axc.numero_de_documento = ".$numeroDocumento.$restriccion."
				INNER JOIN profesores_por_curso AS pxc ON  pxc.curso = c.curso  INNER JOIN profesores AS p ON pxc.profesor = p.profesor";
	
	//$usuarioLogueado
	$statement = $sapDbAdapter->query($sql);
	$result    = $statement->execute();
	
	$selectDataMat = array();
	
	foreach ($result as $res) {
		$selectDataMat[$res['n_materia']] = $res['n_materia'];
		$selectDataProf[$res['n_profesor']] = $res['n_profesor'];
	}
	return array("materias" => $selectDataMat, "profesores" => $selectDataProf);
}