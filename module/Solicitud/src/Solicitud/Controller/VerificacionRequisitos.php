<?php

use Solicitud\Controller;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Soap\Client;

define ("AGOSTO", 8);

require_once 'SapientiaClient.php';

function getDatosSolicitante ($idSolicitud, $tipoSolicitud, AdapterInterface $dbAdapter, AdapterInterface $sapientiaDbAdapter){
	
	$sql  = "SELECT so.fecha_solicitada, u.numero_de_documento, so.matricula
				FROM solicitudes AS so 
				INNER JOIN ".$tipoSolicitud." AS s ON so.solicitud = s.solicitud
				AND s.solicitud =".$idSolicitud."
				INNER JOIN usuarios AS u ON u.usuario = so.usuario_solicitante";
	
		
	$statement = $dbAdapter->query($sql);
	$result = $statement->execute();
		
	foreach ($result as $res) {
		$numeroDocumento = $res['numero_de_documento'];
		$fechaSolicitud = $res['fecha_solicitada'];
		$matriculaSolicitud = $res['matricula'];	
	}
	
	$sql  = "SELECT axs.asignatura, axs.seccion, axs.semestre_anho, axs.anho
					FROM solicitudes AS so
					INNER JOIN ".$tipoSolicitud." AS s ON so.solicitud = s.solicitud
					INNER JOIN asignaturas_por_solicitud AS axs
					ON axs.solicitud = s.solicitud AND s.solicitud =".$idSolicitud."
					INNER JOIN usuarios AS u ON u.usuario = so.usuario_solicitante";
	
	
	
	$statement = $dbAdapter->query($sql);
	$result = $statement->execute();
	
	
	foreach ($result as $res) {
		$asignaturaSolicitud = $res['asignatura'];
		$seccionAsignatura = $res['seccion'];
		$semestreAnhoAsignatura = $res['semestre_anho'];
		$anhoAsignatura = $res['anho'];
	}
	
	$sql  = "SELECT c.nombre AS carrera, d.nombre AS departamento FROM
			matriculas_por_alumno AS mxa
			INNER JOIN  matriculas_por_carrera AS mxc ON mxa.matricula = mxc.matricula
			AND mxa.numero_de_documento = ".$numeroDocumento."
			INNER JOIN carreras AS c ON mxc.carrera = c.carrera
			INNER JOIN departamentos AS d ON c.departamento = d.departamento";
	
	$statement = $sapientiaDbAdapter->query($sql);
	$result = $statement->execute();
	
	foreach ($result as $res) {
		$carreraSolicitante = $res['carrera'];
		$departamentoSolicitante = $res['departamento'];
	}
	
	return array("numero_de_documento" => $numeroDocumento, "fecha_solicitada" => $fechaSolicitud,
				 "asignatura" => $asignaturaSolicitud, "carrera" => $carreraSolicitante,
				"departamento" => $departamentoSolicitante,
				"seccion_asignatura" => $seccionAsignatura,
				"semestre_anho" => $semestreAnhoAsignatura,
				"anho_asignatura" => $anhoAsignatura,
				"matricula" => $matriculaSolicitud);
	
}

function verificarRequisitos($idSolicitud, $tipoSolicitud, AdapterInterface $dbAdapter, AdapterInterface $sapientiaDbAdapter){
	
	date_default_timezone_set('America/Asuncion'); // setea la zona horaria para algunas funciones date()
	
	$requisitosVerificados = array();
	
	$datosSolicitud = getDatosSolicitante($idSolicitud, $tipoSolicitud, $dbAdapter, $sapientiaDbAdapter);
		
	$numeroDocumento = $datosSolicitud['numero_de_documento'];
	$fechaSolicitud = $datosSolicitud['fecha_solicitada'];
	$asignaturaSolicitud = $datosSolicitud['asignatura'];
	$carreraSolicitante = $datosSolicitud['carrera'];
	$dptoSolicitante = $datosSolicitud['departamento'];
	$seccionAsignatura = $datosSolicitud['seccion_asignatura'];
	$semestreAnhoAsignatura = $datosSolicitud['semestre_anho'];
	$anhoAsignatura = $datosSolicitud['anho_asignatura'];
	$matriculaSolicitud = $datosSolicitud['matricula'];
	
	$calificacionMinimaParaAprobar = 2; 
	
	switch ($tipoSolicitud){
		
		case 'solicitud_de_extraordinario':
			// servicios inscripcion a examen, horario de examen
			$oportunidad = 3;			
			$LimiteDias = 5;
			$presenciaExamen = null;
			
			$requisitOportunidad = 'NO_CUMPLE';
			$requisitoAusencia = 'NO_CUMPLE';
			$requisitoLimiteDias = 'NO_CUMPLE';

			$resultInscripcion = getInscripcionesExamen($numeroDocumento, $matriculaSolicitud);
			
			
			
			foreach ($resultInscripcion as $res) {
				
				if ($res['asignatura'] == $asignaturaSolicitud && $res['oportunidad'] == $oportunidad){
					$presenciaExamen = $res['presencia'];
				}
			}
				
			
			$resultHorario = getHorariosExamen($carreraSolicitante);
			
			//llamada a horario
			$fechaExamen = null;
			
			foreach ($resultHorario as $res) {
				if (trim($res['asignatura']) == $asignaturaSolicitud){
					$fechaExamen = $res['fecha_examen'];
				}
			}
			
			
			
			if (isset($fechaExamen)){ //Si la consulta no nos devuelve nada no hay examen en Tercera
				$requisitOportunidad = 'CUMPLE';
				if ($presenciaExamen == 'f'){
					$requisitoAusencia = 'CUMPLE';
					
					
					$segundos=strtotime($fechaSolicitud) - strtotime($fechaExamen);
					$diferenciaDias=intval($segundos/60/60/24);
						
					if ($diferenciaDias <= $LimiteDias){
						$requisitoLimiteDias = 'CUMPLE';
					}
					else 
					{
						$requisitoLimiteDias = 'NO_CUMPLE';
					}
				}
				else
				{
					$requisitoAusencia = 'NO_CUMPLE';
				}
			}

			
			$sql = sprintf("UPDATE solicitud_de_extraordinario SET cumple_fecha = '%s', ausente_tercera_op = '%s', inscripto_tercera_op = '%s'  WHERE solicitud = %d", $requisitoLimiteDias, $requisitoAusencia, $requisitOportunidad, $idSolicitud );
			
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			$requisitosVerificados = array ("Plazo de 5 días para la presentación de la solicitud: "=>$requisitoLimiteDias,
											"Inscripto en tercera oportunidad: " => $requisitOportunidad,
											"Ausente en tercera oportunidad: " => $requisitoAusencia);
			break;
			
		case 'solicitud_de_reduccion_de_asistencia':
						
			$asistenciaRequerida = 0.75; // requisito de la solicitud
			 
 			$resultAsistencia = getAsistencia($asignaturaSolicitud, $numeroDocumento, $semestreAnhoAsignatura, $seccionAsignatura, $anhoAsignatura);
 			
 			$sumAsistidas='0';
 			$sumTotales='0';
 			
 			foreach ($resultAsistencia as $res) {
 				$sumAsistidas += $res['horas_asistidas'];
 				$sumTotales += $res['horas_totales'];
 				
 			}
 			
 			$porcentajeAsistenciaSolicitante = $sumAsistidas/$sumTotales;
 			
			if ($porcentajeAsistenciaSolicitante >= $asistenciaRequerida){
				$requisitoAsistencia = "CUMPLE";
			}
			else 
			{
				$requisitoAsistencia = "NO_CUMPLE";
			}
			
			$porcentajeAsistenciaSolicitante = $porcentajeAsistenciaSolicitante*100;
			$porcentajeAsistenciaSolicitante = $porcentajeAsistenciaSolicitante."%";
			
			$sql = sprintf("UPDATE solicitud_de_reduccion_de_asistencia SET asistencia_minima = '%s'  WHERE solicitud = %d", $requisitoAsistencia, $idSolicitud );
			
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
				
			
			$requisitosVerificados = array("Asistencia Minima: " => $requisitoAsistencia,
			"Porcentaje de Semestre Anterior: "=> $porcentajeAsistenciaSolicitante,
			"Sección de la asignatura cursada" => $seccionAsignatura,
			"Semestre año cursado" => $semestreAnhoAsignatura,
			"Año Cursado" => $anhoAsignatura); // segundo valor devuelve el porcentaje de asistencia
			break;
			
		case 'solicitud_de_titulo':
			
			$requisitoCreditos = 'NO_CUMPLE';
			$requisitoAprobacionTotalMaterias = 'NO_CUMPLE';
			$presentoTesis = 'NO_CUMPLE';
			
			// aprobación total y tesis
			$resultCalificaciones = getCalificaciones($numeroDocumento, $matriculaSolicitud);
			$filtro = 'TODAS';
			$resultAsignaturas = getAsignaturas($carreraSolicitante, $matriculaSolicitud, $filtro);
			
			$cantidadAsignaturasAprobadas= 0;
			foreach ($resultCalificaciones as $res){
				if($res['calificacion'] >= '2'){
					$cantidadAsignaturasAprobadas++;
				}
			}
				
			$totalMateriasPorCarrera = count($resultAsignaturas);
			$totalMateriasAprobadas = $cantidadAsignaturasAprobadas;
			

			
			if ($totalMateriasAprobadas == $totalMateriasPorCarrera){
				$requisitoAprobacionTotalMaterias = 'CUMPLE';
				$presentoTesis = 'CUMPLE';
			}
			else
			{
				$requisitoAprobacionTotalMaterias = 'NO_CUMPLE';
				$presentoTesis = 'NO_CUMPLE';
				
			}
			
			
			// Creditos
			$sql = "SELECT sum(creditos_otorgados) AS creditos FROM solicitud_de_creditos_academicos AS sca
					INNER JOIN solicitudes AS s ON sca.solicitud = s.solicitud AND s.matricula = ".$matriculaSolicitud;
			
			$statement = $dbAdapter->query($sql);
			$resultSumTotal = $statement->execute();
			
			foreach ($resultSumTotal as $res) {
				$creditosAcumulados = $res['creditos'];
			}
			
			$sql = "SELECT creditos_requeridos FROM  creditos_por_carrera WHERE nombre = '".$carreraSolicitante."'";
			$statement = $dbAdapter->query($sql);
			$resultCredPorCarrera = $statement->execute();
			
			foreach ($resultCredPorCarrera as $res) {
				$creditosPorCarrera = $res['creditos_requeridos'];
			}
			
			
			if ($creditosAcumulados >= $creditosPorCarrera){
				$requisitoCreditos = 'CUMPLE'; 
			}
			
			
			$sql = sprintf("UPDATE solicitud_de_titulo 
					SET aprobacion_total_de_materias = '%s', cumple_creditos_requeridos = '%s', presento_tesis = '%s'  
					WHERE solicitud = %d", 
					$requisitoAprobacionTotalMaterias, $requisitoCreditos, $presentoTesis, $idSolicitud );
			
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			$requisitosVerificados = array( "Aprobación total de materias: " => $requisitoAprobacionTotalMaterias,
										"Presentación de Tesis: " => $presentoTesis, "Cantidad de créditos requerida: " => $requisitoCreditos );
			
			break;
			
		case 'solicitud_de_colaborador_de_catedra':
			
			$notaMinima = '3';
			$primerSemestreUltimoAnho = 9;
			
			$requisitoCalificacionMinima = 'NO_CUMPLE';
			$requisitoUltimoAnho = 'NO_CUMPLE';
			
			$resultCalificaciones = getCalificaciones($numeroDocumento, $matriculaSolicitud);

			foreach ($resultCalificaciones as $res){

				if ($res['asignatura'] == $asignaturaSolicitud && $res['calificacion'] >= $notaMinima){
					$requisitoCalificacionMinima = 'CUMPLE';
					
				}			
			}
			
			
			//////////////////////***********************
			$resultCalificaciones = getCalificaciones($numeroDocumento, $matriculaSolicitud);

				
			$cantidadAsignaturasAprobadas= 0;
			foreach ($resultCalificaciones as $res){
				if($res['calificacion'] >= '2' && $res['semestre_carrera'] <= $primerSemestreUltimoAnho){
					$cantidadAsignaturasAprobadas++;
				}
			}
			
			$totalMateriasPorCarrera = count($resultAsignaturas);
			$totalMateriasAprobadas = $cantidadAsignaturasAprobadas;

			
			$filtro = 'TODAS';
			$resultAsignaturas = getAsignaturas($carreraSolicitante, $matriculaSolicitud, $filtro);
			
			$cantidadAsignaturasHastaPenultimoAnho=0;
			foreach ($resultAsignaturas as $res){
				if($res['semestre_carrera'] <= $primerSemestreUltimoAnho){
					$cantidadAsignaturasHastaPenultimoAnho++;
				}
			}
			
			
			if ($totalMateriasAprobadas >= $cantidadAsignaturasHastaPenultimoAnho){
				$requisitoUltimoAnho = 'CUMPLE';
			}
			
			
			/////////////////////////*************************
			

			
			$sql = sprintf("UPDATE solicitud_de_colaborador_de_catedra
					SET nota_minima_requerida = '%s', solicitante_licenciado_ultimo_anho = '%s'
					WHERE solicitud = %d",
					$requisitoCalificacionMinima, $requisitoUltimoAnho, $idSolicitud );
			
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			$requisitosVerificados = array("Alumno del último anho: " => $requisitoUltimoAnho,
									"Calificación mínima de 3: "=> $requisitoCalificacionMinima);
			break;
			
			
		case 'solicitud_de_tutoria_de_catedra':
		
			
			$calificacionMinima = 3;
			
			
			$requisitoCalificacionMinima = 'NO_CUMPLE';
		
				
			$resultCalificaciones = getCalificaciones($numeroDocumento, $matriculaSolicitud);
			
			foreach ($resultCalificaciones as $res){
			
				if ($res['asignatura'] == $asignaturaSolicitud && $res['calificacion'] >= $calificacionMinima){
					$requisitoCalificacionMinima = 'CUMPLE';
						
				}
			}
			
			
			
			$sql = sprintf("UPDATE solicitud_de_tutoria_de_catedra
					SET cumple_nota_minima_requerida = '%s'
					WHERE solicitud = %d",
					$requisitoCalificacionMinima, $idSolicitud );
			
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			$requisitosVerificados = array("Nota mínima requerida: " => $requisitoCalificacionMinima);
			
			break;
			
		case 'solicitud_de_ruptura_de_correlatividad':
			
			$semestreMinimoDEI = 4;
			$promedioMinimoDICIA = 3;
			
			
			$dptoSolicitante = str_replace(" ", "", $dptoSolicitante);
			switch ($dptoSolicitante){
				case "DEI":
					//////////////////////***********************
					$requisitoAprobadoCuartoSemestre = 'NO_CUMPLE';
					$resultCalificaciones = getCalificaciones($numeroDocumento, $matriculaSolicitud);
		
						
					$cantidadAsignaturasAprobadas= 0;
					foreach ($resultCalificaciones as $res){
						if($res['calificacion'] >= '2' && $res['semestre_carrera'] <= $semestreMinimoDEI){
							$cantidadAsignaturasAprobadas++;
						}
					}
					
					
					$totalMateriasAprobadas = $cantidadAsignaturasAprobadas;
		
					
					
					$filtro = 'TODAS';
					$resultAsignaturas = getAsignaturas($carreraSolicitante, $matriculaSolicitud, $filtro);
					
					$cantidadAsignaturasHastaCuartoSemestre=0;
					foreach ($resultAsignaturas as $res){
						if($res['semestre_carrera'] <= $semestreMinimoDEI){
							$cantidadAsignaturasHastaCuartoSemestre++;
						}
					}
					
					
					if ($totalMateriasAprobadas >= $cantidadAsignaturasHastaCuartoSemestre){
						$requisitoAprobadoCuartoSemestre = 'CUMPLE';
					}
					
					
					/////////////////////////*************************
					
					$sql = sprintf("UPDATE solicitud_de_ruptura_de_correlatividad
					SET hasta_cuarto_semestre_regular = '%s'
					WHERE solicitud = %d",
							$requisitoAprobadoCuartoSemestre, $idSolicitud );
					
					$statement = $dbAdapter->query($sql);
					$result = $statement->execute();
					
					$requisitosVerificados = array("Materias Aprobadas hasta el cuarto semestre" => $requisitoAprobadoCuartoSemestre);
				break;
				case "DICIA":
				//DICIA
					$requisitoPromedioDICIA = 'NO_CUMPLE';
					$resultCalificaciones = getCalificaciones($numeroDocumento, $matriculaSolicitud);
					
					
					
					$sumCalificaciones = 0;
					
					foreach ($resultCalificaciones as $res){
						$sumCalificaciones	+= $res['calificacion'];
					}
					
					$promedioActual = $sumCalificaciones/count($resultCalificaciones);
					
					
					if ($promedioActual >= $promedioMinimoDICIA){
						$requisitoPromedioDICIA = 'CUMPLE';
					}
					
					$sql = sprintf("UPDATE solicitud_de_ruptura_de_correlatividad
					SET cumple_promedio_minimo = '%s'
					WHERE solicitud = %d",
							$requisitoPromedioDICIA, $idSolicitud );
						
					$statement = $dbAdapter->query($sql);
					$result = $statement->execute();
					
					$requisitosVerificados = array("Promedio mínimo 3: " => $requisitoPromedioDICIA);
					break;
				default:
					$requisitosVerificados = array();
					break;
			}
			

			break;
			
		case 'solicitud_de_exoneracion':
			
			$asistenciaRequerida = 0.75; // requisito de la solicitud
			$requisitoAsistencia = "NO_CUMPLE";
	 		$resultAsistencia = getAsistencia($asignaturaSolicitud, $numeroDocumento, $semestreAnhoAsignatura, $seccionAsignatura, $anhoAsignatura);
 			
 			$sumAsistidas=0;
 			$sumTotales=0;
 			
 			foreach ($resultAsistencia as $res) {
 				$sumAsistidas += $res['horas_asistidas'];
 				$sumTotales += $res['horas_totales'];
 				
 			}
 			
 			$porcentajeAsistenciaSolicitante = $sumAsistidas/$sumTotales;
 			
			if ($porcentajeAsistenciaSolicitante >= $asistenciaRequerida){
				$requisitoAsistencia = "CUMPLE";
			}
			
			$porcentajeAsistenciaSolicitante = $porcentajeAsistenciaSolicitante*100;
			$porcentajeAsistenciaSolicitante = $porcentajeAsistenciaSolicitante."%";
			
			$resultInscripcion = getInscripcionesExamen($numeroDocumento, $matriculaSolicitud);
	
			$requisitoNoRendir = 'CUMPLE';
			foreach ($resultInscripcion as $res) {
			
				if ($res['asignatura'] == $asignaturaSolicitud){
					if ($res['presencia'] == 't'){
						$requisitoNoRendir = 'NO_CUMPLE';
					}
				}
			}
			
			
			
			$sql = sprintf("UPDATE solicitud_de_exoneracion
					SET cumple_porcentaje_asistencia = '%s', ausencia_finales = '%s'
					WHERE solicitud = %d",
					$requisitoAsistencia, $requisitoNoRendir, $idSolicitud );
				
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			$requisitosVerificados = array("Asistencia Minima" => $requisitoAsistencia,
											"Porcentaje de Asistencia" => $porcentajeAsistenciaSolicitante,
											"Sección de la asignatura cursada" => $seccionAsignatura,
											"Semestre año cursado" => $semestreAnhoAsignatura,
											"Año Cursado" => $anhoAsignatura,
											"No rindio el semestre pasado" => $requisitoNoRendir);
			
			break;
			
		case 'solicitud_de_tesis':
					
			$requisitoTotalMateriasAprobadas = 'NO_CUMPLE';
			
			$resultCalificaciones = getCalificaciones($numeroDocumento, $matriculaSolicitud);
			$filtro = 'TODAS';
			$resultAsignaturas = getAsignaturas($carreraSolicitante, $matriculaSolicitud, $filtro);
				
			$cantidadAsignaturasAprobadas= 0;
			foreach ($resultCalificaciones as $res){
				if($res['calificacion'] >= '2'){
					$cantidadAsignaturasAprobadas++;
				}
			}
			
			$totalMateriasPorCarrera = count($resultAsignaturas);
			$totalMateriasAprobadas = $cantidadAsignaturasAprobadas;
				
			
				
			if ($totalMateriasAprobadas == $totalMateriasPorCarrera){
				$requisitoTotalMateriasAprobadas = 'CUMPLE';
			}
		
			
			$sql = sprintf("UPDATE solicitud_de_tesis
			SET cumple_aprobacion_materias = '%s'
			WHERE solicitud = %d",
					$requisitoTotalMateriasAprobadas, $idSolicitud );
				
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			$requisitosVerificados = array("Aprobación total de las materias de la carrera: " => $requisitoTotalMateriasAprobadas);
			break;
			
		case 'solicitud_de_traspaso_de_pago_examen':
			$requisitoLimiteDeDias = 'NO_CUMPLE';
			
			$sql = "SELECT s.fecha_solicitada, st.fecha_oportunidad_a_pagar AS fecha_examen
					FROM solicitud_de_traspaso_de_pago_examen AS st 
					INNER JOIN solicitudes AS s ON s.solicitud =  st.solicitud AND s.solicitud =".$idSolicitud;
			 
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			foreach ($result as $res) {
				$fechaExamen = $res['fecha_examen'];
				$fechaSolicitud = $res['fecha_solicitada'];
			}
			
			$segundos=strtotime($fechaSolicitud) - strtotime($fechaExamen);
			$diferenciaDias=intval($segundos/60/60/24);
			
			if ($diferenciasDias >= 2){
				$requisitoLimiteDeDias = 'CUMPLE';
			}
			$requisitosVerificados = array("Cumple límite de días" => $requisitoLimiteDeDias);
			
			break;
			
		case'solicitud_de_inscripcion_tardia_a_examen':
			$requisitoLimiteDeDias = 'NO_CUMPLE';
				
			$sql = "SELECT s.fecha_solicitada, st.fecha_de_examen AS fecha_examen
					FROM solicitud_de_inscripcion_tardia_a_examen AS st
					INNER JOIN solicitudes AS s ON s.solicitud =  st.solicitud AND s.solicitud =".$idSolicitud;
			
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
				
			foreach ($result as $res) {
				$fechaExamen = $res['fecha_examen'];
				$fechaSolicitud = $res['fecha_solicitada'];
			}
				
			$segundos=strtotime($fechaSolicitud) - strtotime($fechaExamen);
			$diferenciaDias=intval($segundos/60/60/24);
				
			if ($diferenciasDias >= 2){
				$requisitoLimiteDeDias = 'CUMPLE';
			}
			$requisitosVerificados = array("Cumple límite de días" => $requisitoLimiteDeDias);
			
			break;
			
		default:
			$requisitosVerificados = array();
			break;
	}
	
	return $requisitosVerificados;
}



