<?php

namespace Solicitud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Solicitud\Service\Factory\Database as DatabaseAdapter;
use Solicitud\Service\Factory\SapientiaDatabase as SapientiaDatabaseAdapter;
use Zend\Db\Sql\Sql;
use Solicitud\Form\Actor as Form;
use Solicitud\Form\Actor\ResultadoRequisitos as ResultadoRequisitosForm;
require_once 'VerificacionRequisitos.php';

class ActorController extends AbstractActionController
{
	
	/**
	 * @var ViewModel
	 * @access protected
	 */
	protected $viewModel;
	
	public function __construct()
	{
	# Hacer que todos compartan el mismo View
		$this->viewModel = new ViewModel();
		$this->viewModel->setTemplate('solicitud/actor/visualizarSolicitud');
	}
	
	
	public function setDbAdapter()
	{
		//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
		$database = new DatabaseAdapter();
		//llamamos al metodo que nos devuelve el adaptador de bd
		$dbAdapter = $database->createService($this->getServiceLocator());
		
		//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
		$db = new SapientiaDatabaseAdapter();
		//llamamos al metodo que nos devuelve el adaptador de bd
		$sapientiaDbAdapter = $db->createService($this->getServiceLocator());
		 
		$this->dbAdapter = $dbAdapter;
		$this->sapientiaDbAdapter = $sapientiaDbAdapter;
	}
	
	public function getTipoSolicitud($id_solicitud)
	{
		$sql = sprintf("SELECT tipo_solicitud
						FROM solicitudes
						WHERE solicitud = '%s'", $id_solicitud);
		
		$result = $this->dbAdapter->query($sql)->execute();
		
		foreach ($result as $row) {
			return $row['tipo_solicitud'];
		}
	}
	
	public function cambiarEstadoSolicitud($nueva_etapa, $nuevo_estado, $id_solicitud)
	{
		$sql = new Sql($this->dbAdapter);
		
		$update =  $sql->update('solicitudes')
						->set(array(
								'etapa_actual'	   => $nueva_etapa,
								'estado_solicitud' => $nuevo_estado,
						))
						->where(array('solicitud' => $id_solicitud));
		
		$statement = $sql->prepareStatementForSqlObject($update);
		$results = $statement->execute();
	}
	
	public function getSolicitudData($id_solicitud, $tipo_solicitud)
	{
		
// 		$this->flashmessenger()->addSuccessMessage(print_r($tipo_solicitud, TRUE));
		
		$sql = sprintf(
				"SELECT *
				FROM usuarios as u
				INNER JOIN solicitudes as s ON (u.usuario = s.usuario_solicitante)
				INNER JOIN %s as se ON (s.solicitud = se.solicitud)
				LEFT OUTER JOIN asignaturas_por_solicitud as aso ON (s.solicitud = aso.solicitud)
				LEFT OUTER  JOIN documentos_adjuntos as d ON (se.solicitud = d.solicitud)
				WHERE s.solicitud = %s
				LIMIT 1", $tipo_solicitud, $id_solicitud);
		
		
		$result = $this->dbAdapter->query($sql)->execute();
		$solicitudData = array();
		
		foreach ($result as $res) {
			$solicitudData = $res;// implode('<br>',$res);
		}
		
		return $solicitudData;
	}
	
	public function mapTituloTipoSolicitud($tipo_solicitud){
		
		$title = array (
			"solicitud_de_cambio_de_seccion" => 'SOLICITUD DE CAMBIO DE SECCION',
			"solicitud_de_certificado_de_estudios" => 'SOLICITUD DE CERTIFICADO DE ESTUDIOS',			
			"solicitud_de_colaborador_de_catedra" => 'SOLICITUD DE COLABORADOR DE CATEDRA',
			"solicitud_de_convalidacion_de_materias" => 'SOLICITUD DE CONVALIDACION DE MATERIAS',
			"solicitud_de_creditos_academicos" => 'SOLICITUD DE CREDITOS ACADEMICOS',
			"solicitud_de_desinscripcion_de_curso" => 'SOLICITUD DE DESINSCRIPCION DE CURSO',
			"solicitud_de_exoneracion" => 'SOLICITUD DE EXONERACION DE ASISTENCIA',
			"solicitud_de_extraordinario" => 'SOLICITUD DE EXAMEN EXTRAORDINARIO',
			"solicitud_de_homologacion_de_materias" => 'SOLICITUD DE HOMOLOGACION DE MATERIAS',
			"solicitud_de_inclusion_en_lista" => 'SOLICITUD DE INCLUSION EN LISTA',
			"solicitud_de_inscripcion_tardia_a_examen" => 'SOLICITUD DE INSCRIPCION TARDIA A EXAMEN',
			"solicitud_de_pasantia" => 'SOLICITUD DE PASANTIA',
			"solicitud_de_reduccion_de_asistencia" => 'SOLICITUD DE REDUCCION DE ASISTENCIA',
			"solicitud_de_revision_de_escolaridad" => 'SOLICITUD DE REVISION DE ESCOLARIDAD (ASISTENCIA)',
			"solicitud_de_revision_de_examen" => 'SOLICITUD DE REVISION DE EXAMEN',
			"solicitud_de_ruptura_de_correlatividad" => 'SOLICITUD DE RUPTURA DE CORRELATIVIDAD',
			"solicitud_de_tesis" => 'SOLICITUD DE TESIS',
			"solicitud_de_titulo" => 'SOLICITUD DE TITULO',
			"solicitud_de_traspaso_de_pago_de_examen" => 'SOLICITUD DE TRASPASO DE PAGO DE EXAMEN',
			"solicitud_de_tutoria_de_catedra" => 'SOLICITUD DE TUTORIA DE CATEDRA',
			"solicitud_para_tomar_materia_fuera_de_la_malla_curricular" => 'SOLICITUD DE ASIGNATURA FUERA DE MALLA CURRICULAR',
			"solicitudes_varias" => 'SOLICITUDES VARIAS',			
		);
		
		return $title[$tipo_solicitud];
	}
	
	public function mapSolicitudDataColumns($tipo_solicitud){
	
		$dataColumns = array (
				"solicitud_de_cambio_de_seccion" => array(
													'motivo' => 'Motivo', 
													'especificacion_motivo' => 'Especificacion Motivo'),
				
				"solicitud_de_certificado_de_estudios" => array(
													'carrera_cursada' => 'Carrera cursada', 
													'tipo_de_certificado' => 'Tipo de Certificado', 
													'tipo_de_titulo' => 'Tipo de Título', 
													'solicitud_anterior' => 'Solicitó Anteriormente', 
													'aclaraciones' => 'Aclaraciones'),
				
				"solicitud_de_colaborador_de_catedra" => array(
													'profesor' => 'Profesor', 
													'descripcion_actividades' => 'Descripción de Actividades', 
													'ayudante_colaborador' => 'Ayudante/Colaborador', 
													'carreras_profesor' => 'Profesor de carreras'),
				
				"solicitud_de_convalidacion_de_materias" => array(
													'universidad_origen' => 'Universidad de Origen', 
													'direccion_universidad_origen' => 'Dirección de Universidad Origen', 
													'telefono_universidad_origen' => 'Teléfono de Universidad de Origen', 
													'email_universidad_origen', 'Carrear cursada en la Universidad de Origen'),
				
				"solicitud_de_creditos_academicos" => array('descripcion_actividades' => 'Descripción de Actividades', 
													'fecha_inicio' => 'Fecha de inicio', 
													'fecha_fin' => 'Fecha de finalización'),
				
				"solicitud_de_desinscripcion_de_curso" => array(
													'motivo_desinscripcion' => 'Motivo de Desinscripción', 
													'curso_completo' => 'Curso completo', 
													'por_asignatura' => 'Por asignatura'),
				
				"solicitud_de_exoneracion" => array(
													'motivo' => 'Motivo', 
													'especificacion_motivo' => 'Especificación de motivo'),
				
				"solicitud_de_extraordinario" => array(
													'fecha_extraordinario' => 'Fecha de Extraordinario', 
													'profesor' => 'Profesor', 
													'motivo' => 'Motivo', 
													'especificacion_motivo' => 'Especificación de motivo'),
				
				"solicitud_de_homologacion_de_materias" => array(
													'plan_de_estudio_previo' => 'Plan de Estudio Anterior', 
													'plan_de_estudio_nuevo' => 'Plan de Estudio Actual', 
													'carrera_anterior' => 'Carrera Anterior'),
				"solicitud_de_inclusion_en_lista" => array(
													'motivo' => 'Motivo', 
													'especificacion_motivo' => 'Especificación de motivo'),
				
				"solicitud_de_inscripcion_tardia_a_examen" => array(
													'oportunidad' => 'Oportunidad', 
													'motivo' => 'Motivo', 
													'fecha_de_examen' => 'Fecha de Examen', 
													'especificacion_motivo' => 'Especificación de Motivo'),
				
				"solicitud_de_pasantia" => array(
													'lugar' => 'Lugar', 
													'direccion' => 'Dirección del Lugar', 
													'telefono' => 'Teléfono del Lugar', 
													'correo_electronico' => 'Correo electrónico del Lugar', 
													'motivo' => 'Motivo', 
													'especificacion_motivo' => 'Especificación de Motivo'),
				
				"solicitud_de_reduccion_de_asistencia" => array(
													'motivo' => 'Motivo', 
													'especificacion_motivo' => 'Especificación de Motivo'),
				
				"solicitud_de_revision_de_escolaridad" => array(),
				"solicitud_de_revision_de_examen" => array(
													'motivo' => 'Motivo', 
													'fecha_examen' => 'Fecha del examen', 
													'profesor' => 'Profesor', 
													'oportunidad' => 'Oportunidad', 
													'calificacion_previa' => 'Calificación anterior obtenida'),
				
				"solicitud_de_ruptura_de_correlatividad" => array(),
				"solicitud_de_tesis" => array(
													'tema_tesis' => 'Tema de tesis'),
				"solicitud_de_titulo" => array(
													'nombre_titulo' => 'Título de', 
													'fotocopia_cedula' => 'Adjuntó Fotocopia de cédula', 
													'fotocopia_certificado_nacimiento' => 'Adjuntó Fotocopia de certificado de nacimiento', 
													'fotocopia_certificado_matrimonio' => 'Adjuntó Fotocopia de certificado de Matrimonio',
											  		'fotocopia_de_titulo_de_grado' => 'Adjuntó Fotocopia de Título de Grado', 
													'fotocopia_simple_de_titulo' => 'Adjuntó Fotocopia Simple de Título', 
													'postgrado' => 'Postgrado', 
													'otros' => 'Otros', 
													'especificacion_otros' => 'Especificación otros'),
				
				"solicitud_de_traspaso_de_pago_de_examen" => array(
													'oportunidad_pagada' => 'Oportunidad Pagada', 
													'fecha_oportunidad_pagada' => 'Fecha de Oportunidad Pagada', 
													'oportunidad_a_pagar' => 'Oportunidad a Pagar', 
													'fecha_oportunidad_a_pagar' => 'Fecha Oportunidad a Pagar'),
				
				"solicitud_de_tutoria_de_catedra" => array(
													'profesor' => 'Profesor', 
													'motivo' => 'Motivo', 
													'especificacion_motivo' => 'Especificación de motivo'),
				
				"solicitud_para_tomar_materia_fuera_de_la_malla_curricular" => array(
													'motivo' => 'Motivo', 
													'especificacion_motivo' => 'Especificación de motivo'),
				
				"solicitudes_varias" => array(
													'especificacion_motivo' => 'Especificación de motivo'),
		);
	
		return $dataColumns[$tipo_solicitud];
	}
	
	public function mapEstadoMensajeSolicitud($estadoSolicitud){
		
		$resultado = 'RESULTADO DE LA SOLICITUD: ';
		$estado = 'ESTADO DE LA SOLICITUD: ';
		
		$message = array (
				"PEND" => $estado . 'PENDIENTE',
				"NUEVO" => $estado . 'EN CURSO',
				"CANCEL" => $estado . 'CANCELADA',
				"APROB" => $resultado . 'APROBADA',
				"RECHAZ" => $resultado . 'RECHAZADA',
				"ANUL" => $resultado . 'ANULADA',
		);
		
		return $message[trim($estadoSolicitud)];
	}
	
	function combine_values_of_array_intersect($array1, $array2) {
		$res = array();
		foreach ( $array1 as $key => $val ) {
			isset($array2[$key]) and $res[$val] = $array2[$key];
		}
		return $res;
	}
	
    public function sendNotificationEmailMessage($to, $content)
    {
    	// el template que se tiene que crear dentro de la carpeta view del modulo en un carpeta email
    	$viewTemplate = 'solicitud/notify/email/notificarSolicitud';
    	// The ViewModel variables to pass into the renderer
		$value = array('content' => $content);
    	$subject = 'Notificacion de solicitud - Transacciones Académicas UCA';
    	$mailService = $this->getServiceLocator()->get('goaliomailservice_message');
    	$message = $mailService->createTextMessage('transaccionesuca@gmail.com', $to, $subject, $viewTemplate, $value);
    	$mailService->send($message);
    }
		
	
	public function solicitudActorHandler($form, $actor, $actorDestino = 'Ninguno'){
		
		$id_solicitud = $this->params()->fromRoute('id', 0); # obtener id de solicitud de URL
		$tipo_solicitud = $this->getTipoSolicitud($id_solicitud); #obtener tipo de solicitud
		$solicitudData = $this->getSolicitudData($id_solicitud, $tipo_solicitud); #obtener datos de solicitud
		
		$requisitos = verificarRequisitos($id_solicitud, $tipo_solicitud, $this->dbAdapter, $this->sapientiaDbAdapter);
		
		
		if($this->getRequest()->isPost()) {
			$data = array_merge_recursive(
					$this->getRequest()->getPost()->toArray(),
					// Notice: make certain to merge the Files also to the post data
					$this->getRequest()->getFiles()->toArray()
			);
		
			$form->setData($data);

			if(isset($data['Aprobar'])) {
				$this->cambiarEstadoSolicitud('FINAL', 'APROB', $id_solicitud);
				$message = "La solicitud fue aprobada";
				//$this->sendNotificationEmailMessage($solicitudData['email'], $message);
			
			} else if(isset($data['Pendiente'])) {
				
				switch($actor) {
					case 'recepcion':
						$this->cambiarEstadoSolicitud('RCDA', 'PEND', $id_solicitud);
						break;
					case 'secretariageneral':
						$this->cambiarEstadoSolicitud('DEL_SG', 'PEND', $id_solicitud);
						break;
					case 'secretariadepartamento':
						$this->cambiarEstadoSolicitud('DEL_SD', 'PEND', $id_solicitud);
						break;
					case 'secretariaacademica':
						$this->cambiarEstadoSolicitud('DEL_SA', 'PEND', $id_solicitud);
						break;
					case 'decano':
						$this->cambiarEstadoSolicitud('DEL_DE', 'PEND', $id_solicitud);
						break;
					case 'directoracademico':
						$this->cambiarEstadoSolicitud('DEL_DA', 'PEND', $id_solicitud);
						break;
					case 'directordepartamento':
						$this->cambiarEstadoSolicitud('DEL_DD', 'PEND', $id_solicitud);
						break;
				}
				$message = "La solicitud fue marcada como pendiente";
			
			} else if (isset($data['VistoBueno'])) {
				
				switch($actor) {
					case 'recepcion':
						$this->cambiarEstadoSolicitud($actorDestino, 'NUEVO', $id_solicitud);
						break;
					case 'secretariageneral':
						$this->cambiarEstadoSolicitud($actorDestino, 'NUEVO', $id_solicitud);
						break;
					case 'secretariadepartamento':
						$this->cambiarEstadoSolicitud($actorDestino, 'NUEVO', $id_solicitud);
						break;
					case 'secretariaacademica':
						$this->cambiarEstadoSolicitud($actorDestino, 'NUEVO', $id_solicitud);
						break;
				}
				$message = "La solicitud fue derivada";		
			
			} else if (isset($data['Anular'])) {
				$this->cambiarEstadoSolicitud('FINAL', 'ANUL', $id_solicitud);
				$message = "La solicitud fue anulada";
				//$this->sendNotificationEmailMessage($solicitudData['email'], $message);
				
			} else if (isset($data['Rechazar'])) {
				$this->cambiarEstadoSolicitud('FINAL', 'RECHAZ', $id_solicitud);
				$message = "La solicitud fue rechazada";
				//$this->sendNotificationEmailMessage($solicitudData['email'], $message);

			} else if (isset($data['EnviarCorreo'])) {				
				
			} else if (isset($data['Imprimir'])) {
				return $this->forward()->dispatch('Visualize\Controller\Visualize', array(
						'action' => $this->mapSolicitudPdfAction($tipo_solicitud),
						'tipoSolicitud' => $tipo_solicitud,
						'solicitudData' => $solicitudData
				));
			} else if (isset($data['Salir'])) {
				$message = "Ha abandonado la solicitud";
			}
			
			

		
			$this->flashmessenger()->addSuccessMessage($message);
// 			$this->flashmessenger()->addSuccessMessage(print_r($id_solicitud, TRUE));
		
			// redirect the user to its home page
			return $this->redirect()->toRoute('zfcuser', array (
					'controller' => 'zfcuser',
					'action'     => 'index',
			));
		
		}
		
		$solicitudEspecificaDataColumns = $this->mapSolicitudDataColumns($tipo_solicitud);
		$solicitudEspecificaDataColumnsValues = $this->combine_values_of_array_intersect($solicitudEspecificaDataColumns, $solicitudData);
		
		// $this->flashmessenger()->addSuccessMessage(print_r($solicitudEspecificaDataColumnsValues, TRUE));
		
		$this->viewModel->setVariables(array('data' => $solicitudData, 'form1'=> $form, 
									'title' => $this->mapTituloTipoSolicitud($tipo_solicitud),
									'requisitos' => $requisitos,
									'mensajeEstado' => $this->mapEstadoMensajeSolicitud($solicitudData['estado_solicitud']),
									'datosSolicitudEspecifica' => $solicitudEspecificaDataColumnsValues,
									));
		return $this->viewModel;
	}
	
	public function recepcionAction()
	{	
		$this->setDbAdapter(); # init DB adapter
		$id_solicitud = $this->params()->fromRoute('id', 0); # obtener id de solicitud de URL
		$tipo_solicitud = $this->getTipoSolicitud($id_solicitud); #obtener tipo de solicitud
		
		switch($tipo_solicitud){
			case "solicitud_de_desinscripcion_de_curso":
				/* Puede aprobar */
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = TRUE, $vistoBuenoEnabled = FALSE);
				break;
			
			case "solicitud_de_ruptura_de_correlatividad":			
			case "solicitud_de_creditos_academicos":
			case "solicitud_de_tesis":
			case "solicitud_para_tomar_materia_fuera_de_la_malla_curricular":
			case "solicitud_de_convalidacion_de_materias":
			case "solicitud_de_pasantia":
			case "solicitud_de_homologacion_de_materias":
			case "solicitud_de_tutoria_de_catedra":
				/* Derivar Scta Dpto */
				$actorDestino = 'DEL_SD';
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = FALSE, $vistoBuenoEnabled = TRUE);				
				break;
			
			case "solicitud_de_traspaso_de_pago_de_examen":
			case "solicitud_de_revision_de_escolaridad":
			case "solicitud_de_reduccion_de_asistencia":
			case "solicitud_de_exoneracion":
			case "solicitud_de_revision_de_examen":
			case "solicitud_de_inscripcion_tardia_a_examen":
			case "solicitud_de_extraordinario":
			case "solicitud_de_cambio_de_seccion":
			case "solicitud_de_inclusion_en_lista":
				/* Derivar Scta Academica */
				$actorDestino = 'DEL_SA';
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = FALSE, $vistoBuenoEnabled = TRUE);
				break;
			
			case "solicitud_de_certificado_de_estudios":
			case "solicitud_de_titulo":
				/* Derivar Scta Gral */
				$actorDestino = 'DEL_SG';
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = FALSE, $vistoBuenoEnabled = TRUE);
				break;
			
			default:
				/* Derivar a todas sctas */
				$actorDestino = 'DEL_SS';
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = FALSE, $vistoBuenoEnabled = TRUE);
				break;
		}
					
		return $this->solicitudActorHandler($form, 'recepcion', $actorDestino);
	}


	public function secretariageneralAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$id_solicitud = $this->params()->fromRoute('id', 0); # obtener id de solicitud de URL
		$tipo_solicitud = $this->getTipoSolicitud($id_solicitud); #obtener tipo de solicitud
		
		switch($tipo_solicitud){
			case "solicitud_de_certificado_de_estudios":
				/* Puede aprobar */
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = TRUE, $vistoBuenoEnabled = FALSE);
				break;
			case "solicitud_de_titulo":
				/* Delega */
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = FALSE, $vistoBuenoEnabled = TRUE);
				break;
			default:
				/* Puede aprobar o delegar segun la info de solicitud */
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = TRUE, $vistoBuenoEnabled = TRUE);
				break;
		}
				
		return $this->solicitudActorHandler($form, 'secretariageneral', $actorDestino = 'DEL_DE');
	}
	
	public function secretariadepartamentoAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$id_solicitud = $this->params()->fromRoute('id', 0); # obtener id de solicitud de URL
		$tipo_solicitud = $this->getTipoSolicitud($id_solicitud); #obtener tipo de solicitud
		
		/* Siempre deriva a Direct Dpto */
		$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = FALSE, $vistoBuenoEnabled = TRUE);
		return $this->solicitudActorHandler($form, 'secretariadepartamento', $actorDestino = 'DEL_DD');
	}
	
	public function secretariaacademicaAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$id_solicitud = $this->params()->fromRoute('id', 0); # obtener id de solicitud de URL
		$tipo_solicitud = $this->getTipoSolicitud($id_solicitud); #obtener tipo de solicitud
		
		switch($tipo_solicitud){
			case "solicitud_de_traspaso_de_pago_de_examen":
			case "solicitud_de_revision_de_escolaridad":
			case "solicitud_de_inclusion_en_lista":
				/* Puede aprobar */
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = TRUE, $vistoBuenoEnabled = FALSE);
				break;
				
			case "solicitud_de_reduccion_de_asistencia":
			case "solicitud_de_exoneracion":
			case "solicitud_de_revision_de_examen":
			case "solicitud_de_inscripcion_tardia_a_examen":
			case "solicitud_de_extraordinario":
			case "solicitud_de_cambio_de_seccion":
				/* Deriva a Dir Academico */
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = FALSE, $vistoBuenoEnabled = TRUE);
				break;
				
			default:
				/* Puede aprobar o delegar segun la info de solicitud */
				$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = TRUE, $vistoBuenoEnabled = TRUE);
				break;
		}
				
		return $this->solicitudActorHandler($form, 'secretariaacademica', $actorDestino = 'DEL_DA');
	}

	public function decanoAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = TRUE, $vistoBuenoEnabled = FALSE);
		return $this->solicitudActorHandler($form, 'decano');
	}
	
	public function directoracademicoAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = TRUE, $vistoBuenoEnabled = FALSE);
		return $this->solicitudActorHandler($form, 'directoracademico');
	}
	
	public function directordepartamentoAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$form = new Form\VisualizarSolicitud($this->dbAdapter, $aprobarEnabled = TRUE, $vistoBuenoEnabled = FALSE);
		return $this->solicitudActorHandler($form, 'directordepartamento');
	}

	public function alumnoAction()
	{
		# Set View Template: visualizarResolucionSolicitud
		$this->viewModel->setTemplate('solicitud/actor/visualizarResolucionSolicitud');
		
		$this->setDbAdapter(); # init DB adapter
		$form = new Form\VisualizarSolicitud($this->dbAdapter,
					$aprobarEnabled = FALSE, $vistoBuenoEnabled = FALSE,
					$pendienteEnabled = FALSE, $anularEnabled = FALSE, $rechazarEnabled = FALSE,
					$enviarCorreoEnabled = FALSE, $observacionesEnabled = FALSE);
					return $this->solicitudActorHandler($form, 'alumno');
		

					
		return $this->solicitudActorHandler($form, 'alumno');
		
	}
	
	public function mapSolicitudPdfAction($tipo_solicitud){
	
		$title = array (
				"solicitud_de_cambio_de_seccion" => 'seccion',
				"solicitud_de_certificado_de_estudios" => 'certificado',
				"solicitud_de_colaborador_de_catedra" => 'colaborador',
				"solicitud_de_convalidacion_de_materias" => 'convalidacion',
				"solicitud_de_creditos_academicos" => 'creditos',
				"solicitud_de_desinscripcion_de_curso" => 'desinscripcion',
				"solicitud_de_exoneracion" => 'exoneracion',
				"solicitud_de_extraordinario" => 'extraordinario',
				"solicitud_de_homologacion_de_materias" => 'homologacion',
				"solicitud_de_inclusion_en_lista" => 'inclusion',
				"solicitud_de_inscripcion_tardia_a_examen" => 'tardia',
				"solicitud_de_pasantia" => 'pasantia',
				"solicitud_de_reduccion_de_asistencia" => 'reduccion',
				"solicitud_de_revision_de_escolaridad" => 'revisionescolaridad',
				"solicitud_de_revision_de_examen" => 'revisionexamen',
				"solicitud_de_ruptura_de_correlatividad" => 'ruptura',
				"solicitud_de_tesis" => 'tesis',
				"solicitud_de_titulo" => 'titulo',
				"solicitud_de_traspaso_de_pago_de_examen" => 'traspaso',
				"solicitud_de_tutoria_de_catedra" => 'tutoria',
				"solicitud_para_tomar_materia_fuera_de_la_malla_curricular" => 'fuera',
				"solicitudes_varias" => 'varias',
		);
	
		return $title[$tipo_solicitud];
	}
}
