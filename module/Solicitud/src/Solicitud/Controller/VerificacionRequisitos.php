<?php

use Zend\Db\Adapter\AdapterInterface;

define ("AGOSTO", 8);


function getDatosSolicitante ($idSolicitud, $tipoSolicitud, AdapterInterface $dbAdapter, AdapterInterface $sapientiaDbAdapter){
	
	$sql  = "SELECT so.fecha_solicitada, a.cedula
					FROM solicitudes AS so 
					INNER JOIN ".$tipoSolicitud." AS s ON so.solicitud = s.solicitud
					AND s.solicitud =".$idSolicitud."
					INNER JOIN usuarios AS u ON u.usuario = so.usuario_solicitante
					INNER JOIN alumnos AS a ON u.usuario = a.usuario";
	
		
	$statement = $dbAdapter->query($sql);
	$result = $statement->execute();
		
	foreach ($result as $res) {
		$cedulaSolicitante = $res['cedula'];
		$fechaSolicitud = $res['fecha_solicitada'];
		$asignaturaSolicitud = $res['asignatura'];	
	}
	
	$sql  = "SELECT axs.asignatura
					FROM solicitudes AS so
					INNER JOIN ".$tipoSolicitud." AS s ON so.solicitud = s.solicitud
					INNER JOIN asignaturas_por_solicitud AS axs
					ON axs.solicitud = s.solicitud AND s.solicitud =".$idSolicitud."
					INNER JOIN usuarios AS u ON u.usuario = so.usuario_solicitante
					INNER JOIN alumnos AS a ON u.usuario = a.usuario";
	
	
	$statement = $dbAdapter->query($sql);
	$result = $statement->execute();
	
	foreach ($result as $res) {
		$asignaturaSolicitud = $res['asignatura'];
	}
	
	$sql  = "SELECT c.nombre AS carrera, d.nombre AS departamento FROM
			matriculas_por_alumno AS mxa
			INNER JOIN  matriculas_por_carrera AS mxc ON mxa.matricula = mxc.matricula
			AND mxa.numero_de_documento = ".$cedulaSolicitante."
			INNER JOIN carreras AS c ON mxc.carrera = c.carrera
			INNER JOIN departamentos AS d ON c.departamento = d.departamento";
	
	$statement = $sapientiaDbAdapter->query($sql);
	$result = $statement->execute();
	
	foreach ($result as $res) {
		$carreraSolicitante = $res['carrera'];
		$departamentoSolicitante = $res['departamento'];
	}
	
	return array("cedula" => $cedulaSolicitante, "fecha_solicitada" => $fechaSolicitud,
				 "asignatura" => $asignaturaSolicitud, "carrera" => $carreraSolicitante,
				"departamento" => $departamentoSolicitante);
	
}

function getDatosReduccionExoneracion ($cedulaSolicitante, $asignaturaSolicitud, AdapterInterface $sapientiaDbAdapter){
	
	$anhoParaVerificar = date ('Y');
	$mesActual = date ('n');
		
		
	if ( $mesActual >= AGOSTO ) {
		$semestreAnterior = 1;
	}
	else
	{
		$semestreAnterior = 2;
		$anhoParaVerificar = $anhoParaVerificar - 1; // anho anterior
	}
		
		
	
	$sql  = "SELECT avg((presencia::boolean::int)) AS asistencia FROM asistencias_por_alumno AS axa
					INNER JOIN cursos AS c ON axa.curso = c.curso
					AND axa.numero_de_documento = ".$cedulaSolicitante."
					AND c.anho = ".$anhoParaVerificar."
					AND c.semestre_anho = ".$semestreAnterior."
					INNER JOIN materias AS m ON c.materia = m.materia AND m.nombre = '".$asignaturaSolicitud."'"; 
		

	$statement = $sapientiaDbAdapter->query($sql);
	$result = $statement->execute();
	
	foreach ($result as $res) {
		
		$porcentajeAsistencia = $res['asistencia'];
		
	}
	
	
	$sql = "SELECT iexa.oportunidad, iexa.presencia 
			FROM inscripcion_examen_por_alumno AS iexa 
			INNER JOIN cursos AS c ON iexa.curso = c.curso
			INNER JOIN materias AS m ON c.materia = m.materia AND m.nombre = '".$asignaturaSolicitud."' AND iexa.numero_de_documento = ".$cedulaSolicitante."
			AND c.anho = ".$anhoParaVerificar." AND c.semestre_anho = ".$semestreAnterior;
	
	$statement = $sapientiaDbAdapter->query($sql);
	$result = $statement->execute();
	
	$oportunidades = array();
	$i = 0;
	
	foreach ($result as $res) {
		$oportunidades[$res["oportunidad"]] = $res['presencia'];
	}
	
	
	return array("porcentajeAsistencia" => $porcentajeAsistencia,
				"examenesInscriptos" => $oportunidades);
}

function getCalificacionAsignatura ($cedulaSolicitante, $asignaturaSolicitud, AdapterInterface $sapientiaDbAdapter){
	
	$sql = "SELECT max(ca.calificacion) AS calificacion FROM calificaciones_por_alumno AS ca
					INNER JOIN cursos AS c ON ca.curso = c.curso
					INNER JOIN materias AS m ON c.materia = m.materia AND m.nombre = '".$asignaturaSolicitud."'
					AND ca.numero_de_documento = ".$cedulaSolicitante;
	
	$statement = $sapientiaDbAdapter->query($sql);
	$result = $statement->execute();
	
	foreach ($result as $res) {
		$calificacionSolicitante = $res['calificacion'];
	}
	return $calificacionSolicitante;
	
}

function verificarRequisitos($idSolicitud, $tipoSolicitud, AdapterInterface $dbAdapter, AdapterInterface $sapientiaDbAdapter){
	
	date_default_timezone_set('America/Asuncion'); // setea la zona horaria para algunas funciones date()
	$requisitosVerificados = array();
	
	$datosSolicitud = getDatosSolicitante($idSolicitud, $tipoSolicitud, $dbAdapter, $sapientiaDbAdapter);
		
	$cedulaSolicitante = $datosSolicitud['cedula'];
	$fechaSolicitud = $datosSolicitud['fecha_solicitada'];
	$asignaturaSolicitud = $datosSolicitud['asignatura'];
	$carreraSolicitante = $datosSolicitud['carrera'];
	$dptoSolicitante = $datosSolicitud['departamento'];
	
	$calificacionMinimaParaAprobar = 2; 
	
	switch ($tipoSolicitud){
		
		case 'solicitud_de_extraordinario':
		
			$requisitOportunidad = 3;
			$requisitoAusencia = FALSE;
			$requisitoLimiteDias = 5;
			
 			$sql = "SELECT h.fecha_de_examen, iexa.presencia FROM horarios_de_examen AS h
					INNER JOIN inscripcion_examen_por_alumno AS iexa ON h.curso = iexa.curso 
					AND iexa.oportunidad = ".$requisitOportunidad."
					AND iexa.numero_de_documento = ".$cedulaSolicitante."
					INNER JOIN cursos AS c ON c.curso = iexa.curso
					INNER JOIN materias AS m ON c.materia = m.materia AND m.nombre = '".$asignaturaSolicitud."'";
				
			$statement = $sapientiaDbAdapter->query($sql);
			$result = $statement->execute();
			
			foreach ($result as $res) {
				$fechaExamen = $res['fecha_de_examen'];
				$presenciaExamen = $res['presencia'];
				
			}
			
			
			
			if ($fechaExamen){ //Si la consulta no nos devuelve nada no hay examen en Tercera
				$requisitOportunidad = 'CUMPLE';
				if (!$presenciaExamen){
					$requisitoAusencia = 'CUMPLE';
					
					
					$segundos=strtotime($fechaSolicitud) - strtotime($fechaExamen);
					$diferenciaDias=intval($segundos/60/60/24);
						
					if ($diferenciaDias <= $requisitoLimiteDias){
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
			else
			{
				$requisitOportunidad = 'NO_CUMPLE';
				$requisitoAusencia = 'NO_CUMPLE';
				$requisitoLimiteDias = 'NO_CUMPLE';
			}
			
			$sql = sprintf("UPDATE solicitud_de_extraordinario SET cumple_fecha = '%s', ausente_tercera_op = '%s', inscripto_tercera_op = '%s'  WHERE solicitud = %d", $requisitoLimiteDias, $requisitoAusencia, $requisitOportunidad, $idSolicitud );
			
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			$requisitosVerificados = array ("Plazo de 5 días para la presentación de la solicitud: "=>$requisitoLimiteDias,
											"Inscripto en tercera oportunidad: " => $requisitOportunidad,
											"Ausente en tercera oportunidad: " => $requisitoAusencia);
			break;
			
		case 'solicitud_de_reduccion_de_asistencia':
						
			$requisitoAsistencia = 0.75; // requisito de la solicitud

			$datosReduccion = getDatosReduccionExoneracion($cedulaSolicitante, $asignaturaSolicitud, $sapientiaDbAdapter);
			$porcentajeAsistenciaSolicitante = $datosReduccion['porcentajeAsistencia'];
			 
			if ($porcentajeAsistenciaSolicitante >= $requisitoAsistencia){
				$requisitoAsistencia = "CUMPLE";
			}
			else 
			{
				$requisitoAsistencia = "NO_CUMPLE";
			}
			
			$sql = sprintf("UPDATE solicitud_de_reduccion_de_asistencia SET asistencia_minima = '%s'  WHERE solicitud = %d", $requisitoAsistencia, $idSolicitud );
			
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
				
			
			$requisitosVerificados = array("Asistencia Minima: " => $requisitoAsistencia,
			"Porcentaje de Semestre Anterior: "=> $porcentajeAsistenciaSolicitante); // segundo valor devuelve el porcentaje de asistencia
			break;
			
		case 'solicitud_de_titulo':
			
			$tesis = 'Tesis';
			$sql = "SELECT count(*) AS cantidad_materias FROM materias_por_carrera AS mxc
					INNER JOIN carreras AS c ON mxc.carrera = c.carrera AND c.nombre = '".$carreraSolicitante."'
					UNION
					SELECT count (*) AS cantidad_materias FROM materias_por_carrera AS mxc
					INNER JOIN cursos AS cr ON mxc.materia = cr.materia
					INNER JOIN calificaciones_por_alumno AS ca ON cr.curso = ca.curso 
					AND ca.calificacion >= ".$calificacionMinimaParaAprobar." AND numero_de_documento = ".$cedulaSolicitante."
					ORDER BY cantidad_materias DESC";
			

			
			$statement = $sapientiaDbAdapter->query($sql);
			$result = $statement->execute();
				
			$totalMaterias = array();
			$i = 0;
			foreach ($result as $res) {
				$totalMaterias[$i]= $res['total_materias'];
				$i = $i + 1;
			}
				
			$totalMateriasPorCarrera = $totalMaterias[0];
			$totalMateriasAprobadas = $totalMaterias[1];
			//$tesis = $totalMaterias[2];
			$razonDeAprobacion = $totalMateriasAprobadas/$totalMateriasPorCarrera;
			
			if ($razonDeAprobacion == 1){
				$requisitoAprobacionTotalMaterias = 'CUMPLE';
				$presentoTesis = 'CUMPLE';
			}
			else
			{
				$requisitoAprobacionTotalMaterias = 'NO_CUMPLE';
				$presentoTesis = 'NO_CUMPLE';
				//falta ver lo de los créditos
			}
			
			$requisitoCreditos = 'NO_CUMPLE'; // ver el tema de creditos
			
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
			
			$requisitoNotaMinima = 3;
			$primerSemestreUltimoAnho = 9;
			
			$calificacionSolicitante = getCalificacionAsignatura($cedulaSolicitante, $asignaturaSolicitud, $sapientiaDbAdapter);
		
			
			$sql = "SELECT count (*) AS cantidad_materias FROM materias_por_carrera AS mxc
					INNER JOIN cursos AS cr ON mxc.materia = cr.materia
					INNER JOIN materias AS m ON cr.materia = m.materia
					INNER JOIN calificaciones_por_alumno AS ca ON cr.curso = ca.curso
					AND m.semestre_carrera < ".$primerSemestreUltimoAnho." 
					AND ca.calificacion >= ".$calificacionMinimaParaAprobar." AND numero_de_documento = ".$cedulaSolicitante."
					INNER JOIN carreras AS c ON mxc.carrera = c.carrera AND c.nombre = '".$carreraSolicitante."'
					UNION
					SELECT count (*) AS cantidad_materias FROM materias AS m
					INNER JOIN materias_por_carrera AS mxc ON m.materia = mxc.materia
					INNER JOIN carreras AS c ON c.nombre = '".$carreraSolicitante."' AND m.semestre_carrera < ".$primerSemestreUltimoAnho."
					ORDER BY cantidad_materias DESC";
			
			
			// como verificar lo de la licenciatura
			$statement = $sapientiaDbAdapter->query($sql);
			$result = $statement->execute();
			
			$totalMaterias = array();
			$i = 0;
			foreach ($result as $res) {
				$totalMaterias[$i]= $res['total_materias'];
				$i = $i + 1;
			}
			
			$totalMateriasPorCarrera = $totalMaterias[0];
			$totalMateriasAprobadas = $totalMaterias[1];
			//$tesis = $totalMaterias[2];
			$razonDeAprobacion = $totalMateriasAprobadas/$totalMateriasPorCarrera;
			
			if ($razonDeAprobacion == 1){
				$requisitoUltimoAnho = 'CUMPLE';
			}
			else 
			{
				$requisitoUltimoAnho = 'NO_CUMPLE';
			}
			
			if ($calificacionSolicitante >= $calificacionMinimaParaAprobar){
				$requisitoCalificacionMinima = 'CUMPLE';
			}
			else 
			{
				$requisitoCalificacionMinima = 'NO_CUMPLE';
			}
			
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
		
			
			$requisitoCalificacionMinima = 3;
			$calificacionSolicitante = getCalificacionAsignatura($cedulaSolicitante, $asignaturaSolicitud, $sapientiaDbAdapter);
			
			if ($calificacionSolicitante >= $calificacionMinimaParaAprobar)
			{
				$requisitoCalificacionMinima = 'CUMPLE';	
			}
			else 
			{
				$requisitoCalificacionMinima = 'NO_CUMPLE';
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
					$sql = "SELECT count (*) AS cantidad_materias FROM materias_por_carrera AS mxc
						INNER JOIN cursos AS cr ON mxc.materia = cr.materia
						INNER JOIN calificaciones_por_alumno AS ca ON cr.curso = ca.curso
						INNER JOIN materias AS m ON cr.materia = m.materia
						AND m.semestre_carrera <= ".$semestreMinimoDEI."
						AND ca.calificacion >= ".$calificacionMinimaParaAprobar." AND numero_de_documento = ".$cedulaSolicitante."
						INNER JOIN carreras AS c ON c.carrera = mxc.carrera AND c.nombre = '".$carreraSolicitante."'
						UNION
						SELECT count (*) AS cantidad_materias FROM materias_por_carrera AS mxc
						INNER JOIN materias AS m ON mxc.materia = m.materia
						AND m.semestre_carrera <= ".$semestreMinimoDEI."
						INNER JOIN carreras AS c ON mxc.carrera = c.carrera AND c.nombre = '".$carreraSolicitante."'
						ORDER BY cantidad_materias DESC";
					
					$statement = $sapientiaDbAdapter->query($sql);
					$result = $statement->execute();
						
					$totalMaterias = array();
					$i = 0;
					foreach ($result as $res) {
						$totalMaterias[$i]= $res['cantidad_materias'];
						$i = $i + 1;
					}
					
					$totalMateriasPorCarrera = $totalMaterias[0];
					$totalMateriasAprobadas = $totalMaterias[1];
					//$tesis = $totalMaterias[2];
					$razonDeAprobacion = $totalMateriasAprobadas/$totalMateriasPorCarrera;
						
					if ($razonDeAprobacion == 1){
						$requisitoAprobadoCuartoSemestre = 'CUMPLE';
						
					}
					else
					{
						$requisitoAprobadoCuartoSemestre = 'NO_CUMPLE';
					}
					
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
					$sql ="SELECT avg (ca.calificacion) AS promedio FROM calificaciones_por_alumno AS ca
					   INNER JOIN cursos AS cr ON ca.curso = cr.curso AND ca.numero_de_documento = ".$cedulaSolicitante."
					   INNER JOIN materias AS m ON cr.materia = m.materia
					   INNER JOIN materias_por_carrera AS mxc ON mxc.materia = m.materia
					   INNER JOIN carreras AS c ON c.carrera = mxc.carrera AND c.nombre = '".$carreraSolicitud."'";
					
					$statement = $sapientiaDbAdapter->query($sql);
					$result = $statement->execute();
					
					foreach ($result as $res) {
						$promedioSolicitante = $res['promedio'];
					}
					
					if($promedioSolicitante >= $promedioMinimoDICIA){
						$requisitoPromedioDICIA = 'CUMPLE';
					}
					else
					{
						$requisitoPromedioDICIA = 'NO_CUMPLE';
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
			
			$requisitoAsistencia = 0.75; // requisito de la solicitud
			
			 $datosExoneracion = getDatosReduccionExoneracion($cedulaSolicitante, $asignaturaSolicitud, $sapientiaDbAdapter);
			 $porcentajeAsistenciaSolicitante = $datosExoneracion['porcentajeAsistencia'];
			 
			 $examenesInscriptosSemestrePasado = $datosExoneracion['examenesInscriptos'];
			 
			 if ($examenesInscriptosSemestrePasado == array()){
			 	$requisitoNoRendir = "CUMPLE";
			 }
			 else
			 {
			 	foreach ($examenesInscriptosSemestrePasado as $presencia){
			 		if ($presencia){
			 			$requisitoNoRendir = "NO_CUMPLE";
			 			break;
			 		}
			 	}
			 	$requisitoNoRendir = "CUMPLE";
			 }
			 
			 
			if ($porcentajeAsistenciaSolicitante >= $requisitoAsistencia){
				$requisitoAsistencia = "CUMPLE";
			}
			else
			{
				$requisitoAsistencia = "NO_CUMPLE";
			}
			
			$sql = sprintf("UPDATE solicitud_de_exoneracion
					SET cumple_porcentaje_asistencia = '%s', ausencia_finales = '%s'
					WHERE solicitud = %d",
					$requisitoAsistencia, $requisitoNoRendir, $idSolicitud );
				
			$statement = $dbAdapter->query($sql);
			$result = $statement->execute();
			
			$requisitosVerificados = array("Asistencia Minima" => $requisitoAsistencia,
											"Porcentaje de Asistencia" => $porcentajeAsistenciaSolicitante,
											"No rindio el semestre pasado" => $requisitoNoRendir);
			
			break;
			
		case 'solicitud_de_tesis':
			
					$sql = "SELECT count (*) AS cantidad_materias FROM materias_por_carrera AS mxc
						INNER JOIN cursos AS cr ON mxc.materia = cr.materia
						INNER JOIN calificaciones_por_alumno AS ca ON cr.curso = ca.curso
						INNER JOIN materias AS m ON cr.materia = m.materia
						AND ca.calificacion >= ".$calificacionMinimaParaAprobar." AND numero_de_documento = ".$cedulaSolicitante."
						INNER JOIN carreras AS c ON c.carrera = mxc.carrera AND c.nombre = '".$carreraSolicitante."'
						UNION
						SELECT count (*) AS cantidad_materias FROM materias_por_carrera AS mxc
						INNER JOIN materias AS m ON mxc.materia = m.materia
						INNER JOIN carreras AS c ON mxc.carrera = c.carrera AND c.nombre = '".$carreraSolicitante."'
						ORDER BY cantidad_materias DESC";
					
					$statement = $sapientiaDbAdapter->query($sql);
					$result = $statement->execute();
						
					$totalMaterias = array();
					$i = 0;
					foreach ($result as $res) {
						$totalMaterias[$i]= $res['cantidad_materias'];
						$i = $i + 1;
					}
					
					$totalMateriasPorCarrera = $totalMaterias[0];
					$totalMateriasAprobadas = $totalMaterias[1];
					//$tesis = $totalMaterias[2];
					$razonDeAprobacion = $totalMateriasAprobadas/$totalMateriasPorCarrera;
						
					if ($razonDeAprobacion == 1){
						$requisitoTotalMateriasAprobadas = 'CUMPLE';
						
					}
					else
					{
						$requisitoTotalMateriasAprobadas = 'NO_CUMPLE';
					}
					
					$sql = sprintf("UPDATE solicitud_de_tesis
					SET cumple_aprobacion_materias = '%s'
					WHERE solicitud = %d",
							$requisitoTotalMateriasAprobadas, $idSolicitud );
						
					$statement = $dbAdapter->query($sql);
					$result = $statement->execute();
					
					$requisitosVerificados = array("Aprobación total de las materias de la carrera: " => $requisitoTotalMateriasAprobadas);
			break;
			
		default:
			$requisitosVerificados = array();
			break;
	}
	
	return $requisitosVerificados;
}



