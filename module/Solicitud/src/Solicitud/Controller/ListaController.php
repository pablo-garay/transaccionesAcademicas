<?php

namespace Solicitud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\DbSelect as PaginatorDbAdapter;
use Zend\Paginator\Paginator;
use Solicitud\Model\Solicitud as SolicitudModel;
use Zend\View\Model\ViewModel;


class ListaController extends AbstractActionController
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
		$this->viewModel->setTemplate('solicitud/lista/listarSolicitudes');
	}
	
	public function listSolicitudes($estadoSolicitud = 'None', $filter = TRUE){
		
		$authorize = $this->getServiceLocator()->get('BjyAuthorize\Provider\Identity\ProviderInterface');
		$roles = $authorize->getIdentityRoles();
		$role = $roles[0];
		
		switch($role){
			case 'recepcion':
				$etapa = 'RCDA'; $actorAction = 'recepcion';
				break;
			case "secretaria_general":
				$etapa = 'DEL_SG'; $actorAction = 'secretariageneral';
				break;
			case "secretaria_academica":
				$etapa = 'DEL_SA'; $actorAction = 'secretariaacademica';
				break;
			case "secretaria_departamento":
				$etapa = 'DEL_SD'; $actorAction = 'secretariadepartamento';
				break;
			case "decano":
				$etapa = 'DEL_DE'; $actorAction = 'decano';
				break;
			case "director_academico":
				$etapa = 'DEL_DA'; $actorAction = 'directoracademico';
				break;
			case "director_departamento":
				$etapa = 'DEL_DD'; $actorAction = 'directordepartamento';
				break;
			
		}
		
		$model = new SolicitudModel();
		
		if ($filter){
			$result = $model->getSql()->select()
							->where(array('estado_solicitud' => $estadoSolicitud, 'etapa_actual' => $etapa));
		} else {
			$result = $model->getSql()->select()
							->where(array('etapa_actual' => $etapa));
		}
		
		$adapter = new PaginatorDbAdapter($result, $model->getAdapter());
		$paginator = new Paginator($adapter);
		$currentPage = $this->params('page', 1); /* default page 1 */
		$paginator->setCurrentPageNumber($currentPage); /* set current page */
		$paginator->setItemCountPerPage(10); /* cant items por pagina */
		
		/* Get current action */
		$listaAction = $this->getEvent()->getRouteMatch()->getParam('action');
		
		$this->viewModel->setVariables(array('solicitudes'=> $paginator,
				'page'=> $currentPage,
				'listaAction' => $listaAction,
				'actorAction' => $actorAction
		));
		
		return $this->viewModel;
	}
	
	public function todasAction(){
		return $this->listSolicitudes(null, FALSE);
	}
	
	public function pendientesAction(){
		return $this->listSolicitudes('PEND');
	}

	public function nuevasAction(){
		return $this->listSolicitudes('NUEVO');
	}	
	
	public function aprobadasAction(){
		return $this->listSolicitudes('APROB');
	}	
	
	public function rechazadasAction(){
		return $this->listSolicitudes('RECHAZ');
	}	
	
	public function anuladasAction(){
		return $this->listSolicitudes('ANUL');
	}
}	