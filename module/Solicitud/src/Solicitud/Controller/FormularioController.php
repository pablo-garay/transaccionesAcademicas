<?php

namespace Solicitud\Controller;

use Solicitud\Form as Form;
use Zend\Mvc\Controller\AbstractActionController;
use Solicitud\Service\Factory\Database as DatabaseAdapter;
use Solicitud\Model\Solicitud as SolicitudModel;
use Zend\Paginator\Adapter\DbSelect as PaginatorDbAdapter;
use Zend\Paginator\Paginator;



class FormularioController extends AbstractActionController
{
    public function indexAction()
    {
    	//@todo Solicitudes Index page    	   
        return array();
    }
    
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
    
    public function setDbAdapter()
    {
    	//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
    	$database = new DatabaseAdapter();
    	//llamamos al metodo que nos devuelve el adaptador de bd
    	$dbAdapter = $database->createService($this->getServiceLocator());
    	
    	$this->dbAdapter = $dbAdapter;
    }

    public function solicitudFormHandler($form, $tableName)
    {

        if($this->getRequest()->isPost()) {
            $data = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                // Notice: make certain to merge the Files also to the post data
                $this->getRequest()->getFiles()->toArray()
            );
            $form->setData($data);
            if($form->isValid()) {
            	// You can use the standard way of instantiating a table gateway
            	//$model = new UserModel();
            	// Or if you have many db tables that do need special treatment of the incoming data
            	// you can use the table gateway service

            	$info = $form->getData(); //The form's getData returns an array of key/value pairs

            	$solicitudesModel = $this->serviceLocator->get('table-gateway')->get('solicitudes');
            	$id = $solicitudesModel->insert($info); // @todo valor id: posible problema de concurrencia
            	$info['solicitud'] = $id; // id de solicitud insertada
            	
            	# obtener campos de la tabla de la Solicitud Especifica
            	$metadata = new \Zend\Db\Metadata\Metadata($this->dbAdapter);
            	$columns = $metadata->getColumnNames($tableName);

				# filtrar solo los campos que correspondan a la tabla de la Solicitud Especifica
				# para insertarlos en ella - interseccion entre campos de form y campos de Solicitud Especifica
            	$filtered = array_intersect_key($info, array_flip($columns));
            	
            	$solEspecificaModel = $this->serviceLocator->get('table-gateway')->get($tableName);
            	$res = $solEspecificaModel->insert($filtered);

            	$this->flashmessenger()->addSuccessMessage(print_r($filtered, TRUE));

            	// redirect the user to its account home page
            	return $this->redirect()->toRoute('user/default', array (
	            	    'controller' => 'account',
	            	    'action'     => 'me',
            	));
            } else {
            	// debug code -- borrar despues!
            	$this->flashmessenger()->addSuccessMessage(print_r($form->getData(), TRUE));
            	$messages = $form->getMessages();
            }
        }

        // pass the data to the view for visualization
        return array('form1'=> $form);
    }
    
    public function extraordinarioAction(){    	
    	$this->setDbAdapter(); # init DB adapter    	
    	$form = new Form\SolicitudExtraordinario($this->dbAdapter); // instanciar formulario   	
    	return $this->solicitudFormHandler($form, 'solicitud_de_extraordinario'); # llamar a manejador de formulario
    }

	public function rupturaAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudRupturaCorrelatividad($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_ruptura_de_correlatividad'); # llamar a manejador de formulario
	}

	public function certificadoAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudCertificadoEstudios($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_certificado_de_estudios'); # llamar a manejador de formulario
	}

	public function inscripciontardiaAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudInscripcionTardia($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_inscripcion_tardia_a_examen'); # llamar a manejador de formulario		
	}

	public function creditosAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudCreditos($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_creditos_academicos'); # llamar a manejador de formulario
	}

	public function reduccionAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudReduccionAsistencia($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_reduccion_de_asistencia'); # llamar a manejador de formulario		
	}

	public function revisionexamenAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudRevisionExamen($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_revision_de_examen'); # llamar a manejador de formulario
	}

	public function desinscripcionAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudDesinscripcionCurso($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_desinscripcion_de_curso'); # llamar a manejador de formulario
	}

	public function traspasopagoAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudTraspasoPago($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_traspaso_de_pago_de_examen'); # llamar a manejador de formulario		
	}

	public function revisionescolaridadAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudRevisionEscolaridad($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_revision_de_escolaridad'); # llamar a manejador de formulario
	}

	public function colaboradorcatedraAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudColaboradorCatedra($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_colaborador_de_catedra'); # llamar a manejador de formulario
	}

	public function tituloAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudTitulo($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_titulo'); # llamar a manejador de formulario
	}

	public function convalidacionmateriasAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudConvalidacionMaterias('solicitudConvalidacionMaterias', $this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_convalidacion_de_materias'); # llamar a manejador de formulario
	}

	public function homologacionmateriasAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudHomologacionMaterias($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_homologacion_de_materias'); # llamar a manejador de formulario
	}

	public function tesisAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudTesis($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_tesis'); # llamar a manejador de formulario
	}

	public function pasantiaAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudPasantia($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_pasantia'); # llamar a manejador de formulario
	}

	public function tutoriacatedraAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudTutoriaCatedra($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_tutoria_de_catedra'); # llamar a manejador de formulario
	}

	public function exoneracionAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudExoneracion($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_exoneracion'); # llamar a manejador de formulario
	}

	public function materiafueramallacurricularAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudMateriaFueraMallaCurricular($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_para_tomar_materia_fuera_de_la_malla_curricular'); # llamar a manejador de formulario
	}
	
	public function cambioseccionAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudCambioSeccion($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_cambio_de_seccion'); # llamar a manejador de formulario
	}

	public function inclusionlistaAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudInclusionLista($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_inclusion_en_lista'); # llamar a manejador de formulario
	}
	
	public function solicitudesvariasAction()
	{
		$this->setDbAdapter(); # init DB adapter  
		$form = new Form\SolicitudesVarias($this->dbAdapter); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitudes_varias'); # llamar a manejador de formulario
	}	
	
}
