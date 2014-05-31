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
		$this->viewModel->setTemplate('solicitud/lista/list');
	}
	
	public function listSolicitudes($estadoSolicitud = 'None', $filter = TRUE){
		
		$model = new SolicitudModel();
		
		if ($filter){
			$result = $model->getSql()->select()
							->where(array('estado_solicitud' => $estadoSolicitud));
		} else {
			$result = $model->getSql()->select();
		}
		
		$adapter = new PaginatorDbAdapter($result, $model->getAdapter());
		$paginator = new Paginator($adapter);
		$currentPage = $this->params('page', 1); /* default page 1 */
		$paginator->setCurrentPageNumber($currentPage); /* set current page */
		$paginator->setItemCountPerPage(10); /* cant items por pagina */
		
		/* Get current action */
		$action = $this->getEvent()->getRouteMatch()->getParam('action');
		
		$this->viewModel->setVariables(array('solicitudes'=> $paginator,
				'page'=> $currentPage,
				'action' => $action 
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

	public function listAction(){
		return $this->listSolicitudes(null, FALSE);
	}
}	