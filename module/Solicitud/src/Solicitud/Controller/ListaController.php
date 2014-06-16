<?php

namespace Solicitud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\DbSelect as PaginatorDbAdapter;
use Zend\Paginator\Paginator;
use Solicitud\Model\Solicitud as SolicitudModel;
use Zend\View\Model\ViewModel;
use Zend\Db\Sql\Predicate;
use Solicitud\Form\Lista\FiltrarSolicitud as FiltrarForm;


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
	
	public function listSolicitudes($estadoSolicitud = null, $filter = TRUE){
		
		/* Get user role */
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
			case "alumno":
				$actorAction = 'alumno';
				break;
			
		}
		
		$model = new SolicitudModel();	
		
		if($role != 'alumno') { /* Funcionarios */
			$result = $model->getSql()->select();
			
			if (in_array ($role , array('secretaria_general', 'secretaria_departamento', 'secretaria_academica')))
				$result->where(array('etapa_actual' => array($etapa, 'DEL_SS'))); /* Secretarias */
			else 
				$result->where(array('etapa_actual' => $etapa)); /* Superiores */
		
		} else { /* Alumno */
			$result = $model->getSql()->select()
							->where(array('usuario_solicitante' => $this->zfcUserAuthentication()->getIdentity()->getId()));
		}
		
		if ($filter){ /* Filtrar por Estado de la Solicitud */
			$result->where(array('estado_solicitud' => $estadoSolicitud));
		}

		/* Si se especificó filtro de búsqueda, filtrar la búsqueda por el string dado */
		$searchstring = $this->getRequest()->getQuery()->offsetGet('filter'); // GET method value
		if (!empty($searchstring)){
			$result->where(array(
					new Predicate\PredicateSet(
							array(
									new Predicate\Like('tipo_solicitud', '%'.str_replace(' ', '_', $searchstring).'%'),
	 								new Predicate\Expression('fecha_solicitada::text LIKE ?', '%'.$searchstring.'%'),
									new Predicate\Like('estado_solicitud', '%'.strtoupper($searchstring).'%'),
							),
							Predicate\PredicateSet::COMBINED_BY_OR
					),
			));
		}
		
		/* Obtener criterio de orden de lista. El orden se quita de route */
		$order_by = $this->params()->fromRoute('order_by') ?
		$this->params()->fromRoute('order_by') : 'fecha_solicitada';
		$order = $this->params()->fromRoute('order') ?
		$this->params()->fromRoute('order') : 'DESC';
		
		$result->order(array($order_by . ' ' . $order));  /* ordenar resultados - si no se especifica, se ordena por fecha */
		
		
		$adapter = new PaginatorDbAdapter($result, $model->getAdapter());
		$paginator = new Paginator($adapter);
		$currentPage = $this->params('page', 1); /* default page 1 */
		$paginator->setCurrentPageNumber($currentPage); /* set current page */
		$paginator->setItemCountPerPage(10); /* cant items por pagina */
		
		/* Get current action */
		$listaAction = $this->getEvent()->getRouteMatch()->getParam('action');
		
		$this->viewModel->setVariables(array('solicitudes'=> $paginator,
				'listaAction' => $listaAction,
				'actorAction' => $actorAction,
				'page'=> $currentPage,
				'order_by' => $order_by,
				'order' => $order,
				'form1' => new FiltrarForm()
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