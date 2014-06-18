<?php

namespace Solicitud\Sapientia;
use Zend\Soap\Client;

class SapientiaClient {
	public function getMatriculaCarrera($numeroDocumentoUsuario)
	{
		//matricula carrera
		$client = new Client("http://servicios.localhost/matricula_carrera_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'numero_documento' => $numeroDocumentoUsuario);
		$data = json_encode($param);
		$response = $client->matricula_carrera($data);
		return json_decode($response,True);
	}
	
	
	public function getAsistencia ($asignaturaSolicitud, $numeroDocumento, $semestreAnhoAsignatura,
						$seccionAsignatura, $anhoAsignatura)
	{
		//Asistencia
		$client = new Client("http://servicios.localhost/asistencia_server.php?wsdl");
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
	
	public function getInscripcionesExamen($numeroDocumento, $matriculaSolicitud)
	{
		//Inscripcion a examenes por alumno
		$client = new Client("http://servicios.localhost/inscripcion_examen_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'matricula' => $matriculaSolicitud,
				'numero_documento' => $numeroDocumento,
				'filtro' => 'TODOS');
		$data = json_encode($param);
		$response = $client->inscripcion_examenes($data);
		
		
		return json_decode($response, True);
	}
	
	public function getHorariosExamen($carreraSolicitante)
	{
		//Horarios de examenes
		$client = new Client("http://servicios.localhost/horario_examen_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'carrera' => $carreraSolicitante);
		$data = json_encode($param);
		$response = $client->horario_examen($data);
		return json_decode($response,True);
	}
	
	public function getCalificaciones ($numeroDocumento, $matriculaSolicitante)
	{
		//Calificaciones
		$client = new Client("http://servicios.localhost/calificaciones_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'numero_documento' => $numeroDocumento, 'matricula' => $matriculaSolicitante);
		$data = json_encode($param);
		$response = $client->calificaciones($data);
		return json_decode($response,True);
	}
	
	public function getAsignaturas ($carreraSolicitante, $matriculaSolicitante, $filtro){
		//Asignaturas
		$client = new Client("http://servicios.localhost/asignaturas_server.php?wsdl");
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
		$client = new Client("http://servicios.localhost/correlatividad_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'carrera' => $carreraSolicitante,
				'asignatura' => $asignaturaSolicitante);
		$data = json_encode($param);
		$response = $client->correlatividad($data);
		return json_decode($response,True);
	}
	
	public function getProfesoresPorCurso($asignatura, $seccion, $semestreAnho, $anho ){
		//Correlatividad
		$client = new Client("http://servicios.localhost/profesores_asignatura_server.php?wsdl");
		$client->setSoapVersion(SOAP_1_1);
		$param = array( 'asign' => $asignatura,
				'semestre' => $semestreAnho,
				'anho' => $anho,
				'seccion' => $seccion);
		$data = json_encode($param);
		$response = $client->profesores_asignatura($data);
		return json_decode($response,True);
	}
}