<?php

namespace Solicitud\Sapientia;
use Zend\Soap\Client;

class SapientiaClientBeta {
	public function getNroDocumentoMatriculaCarrera($idSolicitud, $dbAdapter) {
		$sql  = "SELECT so.fecha_solicitada, u.numero_de_documento, so.matricula, so.carrera
					FROM solicitudes AS so
					INNER JOIN usuarios AS u ON u.usuario = so.usuario_solicitante
					AND so.solicitud =".$idSolicitud;
	
	
		$statement = $dbAdapter->query($sql);
		$result = $statement->execute();
		return $result;
	}
	
	public function getMatriculaCarrera($databaseAdapter, $usuarioLogueado, $idSolicitud)
	{
		$datos = getDatosUsuario ($databaseAdapter, $usuarioLogueado);
		$numeroDocumentoUsuario = $datos['numero_de_documento'];
	
		//matricula carrera
		$client = new Client("http://localhost/servicios/matricula_carrera_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'numero_documento' => $numeroDocumentoUsuario);
		$data = json_encode($param);
		$response = $client->matricula_carrera($data);
		return json_decode($response,True);
	}
	
	
	public function getAsistencia ($databaseAdapter, $usuarioLogueado, $idSolicitud)
	{
		$result = getNroDocumentoMatriculaCarrera($idSolicitud, $databaseAdapter);
	
		foreach ($result as $res) {
			$numeroDocumento = $res['numero_de_documento'];
		}
	
	
		$sql  = "SELECT axs.asignatura, axs.seccion, axs.semestre_anho, axs.anho
						FROM solicitudes AS so
						INNER JOIN asignaturas_por_solicitud AS axs
						ON axs.solicitud = so.solicitud AND so.solicitud =".$idSolicitud."
						INNER JOIN usuarios AS u ON u.usuario = so.usuario_solicitante";
	
	
	
		$statement = $databaseAdapter->query($sql);
		$result = $statement->execute();
	
	
		foreach ($result as $res) {
			$asignaturaSolicitud = $res['asignatura'];
			$seccionAsignatura = $res['seccion'];
			$semestreAnhoAsignatura = $res['semestre_anho'];
			$anhoAsignatura = $res['anho'];
		}
	
		//Asistencia
		$client = new Client("http://localhost/servicios/asistencia_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
	
		$param = array( 'asign' => trim($asignaturaSolicitud),
				'numero_documento' => trim($numeroDocumento),
				'semestre' => trim($semestreAnhoAsignatura),
				'seccion' => trim($seccionAsignatura),
				'anho' => trim($anhoAsignatura)
		);
	
		$data = json_encode($param);
		$response = $client->asistencia($data);
	
		return json_decode($response, True);
	
	}
	
	
	public function getInscripcionesExamen($databaseAdapter, $usuarioLogueado, $idSolicitud)
	{
	
		$result = getNroDocumentoMatriculaCarrera($idSolicitud, $databaseAdapter);
	
		foreach ($result as $res) {
			$numeroDocumento = $res['numero_de_documento'];
			$matriculaSolicitud = $res['matricula'];
		}
	
		//Inscripcion a examenes por alumno
		$client = new Client("http://localhost/servicios/inscripcion_examen_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'matricula' => $matriculaSolicitud,
				'numero_documento' => $numeroDocumento,
				'filtro' => 'TODOS');
		$data = json_encode($param);
		$response = $client->inscripcion_examenes($data);
	
	
		return json_decode($response, True);
	}
	
	public function getHorariosExamen($databaseAdapter, $usuarioLogueado, $idSolicitud)
	{
		
		$result = getNroDocumentoMatriculaCarrera($idSolicitud, $databaseAdapter);
		
		foreach ($result as $res) {
			$carreraSolicitud = $res['carrera'];
		}
		
		//Horarios de examenes
		$client = new Client("http://localhost/servicios/horario_examen_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'carrera' => $carreraSolicitante);
		$data = json_encode($param);
		$response = $client->horario_examen($data);
		return json_decode($response,True);
	}
	
	public function getCalificaciones ($databaseAdapter, $usuarioLogueado, $idSolicitud)
	{
		$result = getNroDocumentoMatriculaCarrera($idSolicitud, $databaseAdapter);
		
		foreach ($result as $res) {
			$numeroDocumento = $res['numero_de_documento'];
			$matriculaSolicitud = $res['matricula'];
		}
		//Calificaciones
		$client = new Client("http://localhost/servicios/calificaciones_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'numero_documento' => $cedulaSolicitante, 'matricula' => $matriculaSolicitante);
		$data = json_encode($param);
		$response = $client->calificaciones($data);
		return json_decode($response,True);
	}
	
	public function getAsignaturas ($databaseAdapter, $usuarioLogueado, $idSolicitud, $filtro)
	{
		$result = getNroDocumentoMatriculaCarrera($idSolicitud, $databaseAdapter);
		
		foreach ($result as $res) {
			$matriculaSolicitante = $res['matricula'];
			$carreraSolicitante = $res['carrera'];
		}
		//Asignaturas
		$client = new Client("http://localhost/servicios/asignaturas_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'carrera' => $carreraSolicitante,
				'matricula' => $matriculaSolicitante,
				'filtro' => $filtro);
		$data = json_encode($param);
		$response = $client->asignaturas($data);
		return json_decode($response,True);
	}
	
	public function getCorrelatividad($carreraSolicitante, $asignaturaSolicitante){
		//Correlatividad
		$client = new Client("http://localhost/servicios/correlatividad_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'carrera' => $carreraSolicitante,
				'asignatura' => $asignaturaSolicitante);
		$data = json_encode($param);
		$response = $client->correlatividad($data);
		return json_decode($response,True);
	}
	
	public function getProfesoresPorCurso($asignatura, $seccion, $semestreAnho, $anho){
		//Correlatividad
		$client = new Client("http://localhost/servicios/profesores_asignatura_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'asign' => $asignatura,
				'seccion' => $seccion,
				'semestre' => $semestreAnho,
				'anho' => $anho
		);
		$data = json_encode($param);
		$response = $client->profesores_asignatura($data);
		return json_decode($response,True);
	}
}