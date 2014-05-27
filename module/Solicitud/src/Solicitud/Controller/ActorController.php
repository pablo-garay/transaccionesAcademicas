<?php

namespace Solicitud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Solicitud\Service\Factory\Database as DatabaseAdapter;
use Zend\Db\Sql\Sql;
use Solicitud\Form\Actor as Form;
use Solicitud\Form\Actor\ResultadoRequisitos as ResultadoRequisitosForm;


class ActorController extends AbstractActionController
{
	
	public function setDbAdapter()
	{
		//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
		$database = new DatabaseAdapter();
		//llamamos al metodo que nos devuelve el adaptador de bd
		$dbAdapter = $database->createService($this->getServiceLocator());
		 
		$this->dbAdapter = $dbAdapter;
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
	
	public function getSolicitudData($id_solicitud)
	{
		$tipo_solicitud = $this->getTipoSolicitud($id_solicitud);
		
		$this->flashmessenger()->addSuccessMessage(print_r($tipo_solicitud, TRUE));
		
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
			$solicitudData[$res['solicitud']] = $res;// implode('<br>',$res);
		}
		
		return $solicitudData;
	}
	
	public function solicitudActorHandler($form, $actor){
		
		$id_solicitud = $this->params()->fromRoute('id', 0); # obtener id de solicitud de URL
		$solicitudData = $this->getSolicitudData($id_solicitud);
		
		
		if($this->getRequest()->isPost()) {
			$data = array_merge_recursive(
					$this->getRequest()->getPost()->toArray(),
					// Notice: make certain to merge the Files also to the post data
					$this->getRequest()->getFiles()->toArray()
			);
		
			$form->setData($data);
		
		
			if ($actor == 'recepcion'){
				if (isset($data['Anular'])) {
					$this->cambiarEstadoSolicitud('FINAL', 'ANUL', $id_solicitud);
					$message = "La solicitud fue anulada";
				} else if (isset($data['Rechazar'])) {
					$this->cambiarEstadoSolicitud('FINAL', 'RECHAZ', $id_solicitud);
					$message = "La solicitud fue rechazada";
				} else if (isset($data['VistoBueno'])) {
					$this->cambiarEstadoSolicitud('DEL_SG', 'NUEVO', $id_solicitud);
					$message = "La solicitud fue derivada";
				}
			} else if ($actor == 'secretaria'){
				if(isset($data['Pendiente'])) {
					$this->cambiarEstadoSolicitud('DEL_SG', 'PEND', $id_solicitud);
					$message = "La solicitud fue marcada como pendiente";
				
				} else if (isset($data['Anular'])) {
					$this->cambiarEstadoSolicitud('FINAL', 'ANUL', $id_solicitud);
					$message = "La solicitud fue anulada";
				
				} else if (isset($data['Rechazar'])) {
					$this->cambiarEstadoSolicitud('FINAL', 'RECHAZ', $id_solicitud);
					$message = "La solicitud fue rechazada";
				
				} else if (isset($data['VistoBueno'])) {
					$this->cambiarEstadoSolicitud('DEL_DE', 'NUEVO', $id_solicitud);
					$message = "La solicitud fue derivada";
				
				} else if (isset($data['EnviarCorreo'])) {
				
				} else if (isset($data['Imprimir'])) {
				
				}
			} else if ($actor == 'decano'){
				if(isset($data['Aprobar'])) {
					$this->cambiarEstadoSolicitud('FINAL', 'APROB', $id_solicitud);
					$message = "La solicitud fue aprobada";
				
				} else if(isset($data['Pendiente'])) {
					$this->cambiarEstadoSolicitud('DEL_DE', 'PEND', $id_solicitud);
					$message = "La solicitud fue derivada";
				
				} else if (isset($data['Anular'])) {
					$this->cambiarEstadoSolicitud('FINAL', 'ANUL', $id_solicitud);
					$message = "La solicitud fue anulada";
				
				} else if (isset($data['Rechazar'])) {
					$this->cambiarEstadoSolicitud('FINAL', 'RECHAZ', $id_solicitud);
					$message = "La solicitud fue rechazada";
				
				} else if (isset($data['EnviarCorreo'])) {
				
				} else if (isset($data['Imprimir'])) {
				
				}
			}

		
			$this->flashmessenger()->addSuccessMessage($message);
			$this->flashmessenger()->addSuccessMessage(print_r($id_solicitud, TRUE));
		
			// redirect the user to the view user action
			return $this->redirect()->toRoute('user/default', array (
					'controller' => 'account',
					'action'     => 'me',
			));
		
		}
		
		return array('data' => $solicitudData, 'form1'=> $form);
	}
	
	public function recepcionAction()
	{	
		$this->setDbAdapter(); # init DB adapter
		$form = new Form\RecepcionSolicitud($this->dbAdapter);		
		return $this->solicitudActorHandler($form, 'recepcion');
	}


	public function secretariaAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$form = new Form\SecretariaSolicitud($this->dbAdapter);
		return $this->solicitudActorHandler($form, 'secretaria');
	}

	public function decanoAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$form = new Form\DecanoSolicitud($this->dbAdapter);
		return $this->solicitudActorHandler($form, 'decano');
	}

	public function alumnoAction()
	{
		$this->setDbAdapter(); # init DB adapter


		$form = new Form\AlumnoSolicitud($this->dbAdapter);
		
// 		$sql = 'SELECT *
// 				FROM usuarios as u
// 				INNER JOIN solicitudes as s ON (u.usuario = s.usuario_solicitante)
// 				INNER JOIN solicitud_de_extraordinario as se ON (s.solicitud = se.solicitud)
// 				LEFT OUTER JOIN asignaturas_por_solicitud as aso ON (s.solicitud = aso.solicitud)
// 				LEFT OUTER  JOIN documentos_adjuntos as d ON (se.solicitud = d.solicitud)
// 				WHERE s.solicitud = 42
// 				LIMIT 1';

		$sql = 	'SELECT s.solicitud as solicitud, mesa_entrada, fecha_solicitada, resultado_requisitos, nombres, apellidos, carrera, telefono, email,
		asignatura, fecha_extraordinario, motivo, archivo, cumple_fecha, inscripto_tercera_op, ausente_tercera_op
		FROM usuarios as u INNER JOIN solicitudes as s ON (u.usuario = s.usuario_solicitante)
		INNER JOIN solicitud_de_extraordinario as se ON (s.solicitud = se.solicitud)
		INNER JOIN asignaturas_por_solicitud as aso ON (s.solicitud = aso.solicitud)
		LEFT OUTER  JOIN documentos_adjuntos as d ON (se.solicitud = d.solicitud)
		ORDER BY mesa_entrada DESC
		LIMIT 1';


		$statement = $this->dbAdapter->query($sql);

		$result = $statement->execute();


		$selectData = array();


		foreach ($result as $res) {

			$selectData[$res['solicitud']] = $res;
		}


		return array('data' => $selectData, 'form1'=> $form);
	}
}
