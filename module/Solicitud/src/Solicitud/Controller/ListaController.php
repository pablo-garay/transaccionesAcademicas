<?php

namespace Solicitud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\DbSelect as PaginatorDbAdapter;
use Zend\Paginator\Paginator;
use Solicitud\Model\Solicitud as SolicitudModel;


class ListaController extends AbstractActionController
{

	public function listAction(){
		$model = new SolicitudModel();
		$result = $model->getSql()->select();
	
		$adapter = new PaginatorDbAdapter($result, $model->getAdapter());
		$paginator = new Paginator($adapter);
		$currentPage = $this->params('page', 1);
		$paginator->setCurrentPageNumber($currentPage);
		$paginator->setItemCountPerPage(10);
	
		return array('solicitudes'=> $paginator,
				'page'=> $currentPage
		);
	
	}
}	