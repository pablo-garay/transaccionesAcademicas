<?php

namespace Solicitud\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Paginator\Adapter\DbSelect as PaginatorDbAdapter;
use Solicitud\Service\Factory\Database as DatabaseAdapter;
use Solicitud\Service\Factory\SapientiaDatabase as SapientiaDatabaseAdapter;
use Zend\Paginator\Paginator;
use Zend\View\Model\ViewModel;
use Solicitud\Model\Solicitud as SolicitudModel;
use Zend\Db\Sql\Sql;



class SituacionAcademicaController extends AbstractActionController
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
		$this->viewModel->setTemplate('solicitud/situacionacademica/list');
	}
	
	public function indexAction()
	{
		//@todo Situacion Academica Index page
		return array();
	}
	
	public function consultSapientiaDatabase($sql, $field1, $field2){
		
		/*****             SAPIENTIA DATA              ************/
		$database = new SapientiaDatabaseAdapter();
		$sapientiaDbadapter = $database->createService($this->getServiceLocator());
		
		$statement = $sapientiaDbadapter->query($sql);
		$result    = $statement->execute();
		
		$dataItems = array();
		
		$i = 0;
		foreach ($result as $row) {
			$dataItems[$i++] = array(
					$field1 => $row[$field1],
					$field2 => $row[$field2]
			);
		}
		
		return $dataItems;
		/***** FIN       SAPIENTIA          DATA      ************/
	}
	
	public function situacionAcademicaHandler($dataItems, $paginatorName, $headTitle, $header, 
			$tableFieldTitle1, $tableFieldTitle2, $tableField1, $tableField2){
		
		$paginator = new \Zend\Paginator\Paginator(new
				\Zend\Paginator\Adapter\ArrayAdapter($dataItems)
		);		
		
		$currentPage = $this->params('page', 1); /* default page 1 */
		$paginator->setCurrentPageNumber($currentPage); /* set current page */
		$paginator->setItemCountPerPage(10); /* cant items por pagina */
		
		/* Get current action */
		$action = $this->getEvent()->getRouteMatch()->getParam('action');
		
		$this->viewModel->setVariables(
				array('paginator' => $paginator,
						'page'=> $currentPage,
						'headTitle' => $headTitle,
						'header' => $header,
						'tableFieldTitle1' => $tableFieldTitle1,
						'tableFieldTitle2' => $tableFieldTitle2,
						'tableField1' => $tableField1,
						'tableField2' => $tableField2,
						'action' => $action
				)
		);
		
		return $this->viewModel;
	}
	
	public function calificacionesAction(){
	
		$sql  = 'SELECT calificacion, ma.nombre as materia
				FROM calificaciones_por_alumno ca
				INNER JOIN cursos cu ON ca.curso = cu.curso
				INNER JOIN materias ma ON cu.materia = ma.materia';
	
		$dataItems = $this->consultSapientiaDatabase($sql, 'calificacion', 'materia');
		return $this->situacionAcademicaHandler($dataItems, 
				$paginatorName = 'calificaciones', $headTitle = 'Lista de calificaciones', 
				$header = 'Visualizar Calificaciones',
				$tableFieldTitle1 = 'Materia', $tableFieldTitle2 = 'Calificación', 
				$tableField1 = 'materia', $tableField2 = 'calificacion');
	}
	
	public function asistenciaAction(){
	
		$sql  = 'SELECT fecha, presencia
				FROM asistencias_por_alumno';
	
		$dataItems = $this->consultSapientiaDatabase($sql, 'fecha', 'presencia');
		return $this->situacionAcademicaHandler($dataItems,
				$paginatorName = 'asistencia', $headTitle = 'Asistencia', 
				$header = 'Asistencia a Clases',
				$tableFieldTitle1 = 'Fecha', $tableFieldTitle2 = 'Presencia', 
				$tableField1 = 'fecha', $tableField2 = 'presencia');
	}
	
	

// 	public function calificacionesAction(){
		
// 		//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
// 		$database = new DatabaseAdapter();
// 		//llamamos al metodo que nos devuelve el adaptador de bd
// 		$dbAdapter = $database->createService($this->getServiceLocator());
		
// 		//////////////////////***********INICIO Extracción de Datos**************/////////////////
// 		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
// 		// rescatar su cedula
// 		$usuarioLogueado = 1;
		
// 		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
// 		$cedulaUsuario = $datos['cedula'];
		
		
		
// 		$sql       = "SELECT m.materia, m.nombre AS n_materia, p.nombre AS n_profesor, h.fecha_de_examen  FROM materias AS m
// 						INNER JOIN cursos AS c ON m.materia = c.materia
// 						INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso
// 						AND axc.numero_de_documento = ".$cedulaUsuario." AND axc.curso_actual = TRUE
// 						INNER JOIN Horarios_de_examen AS h ON h.curso = axc.curso
// 						INNER JOIN profesores_por_curso AS pxc ON pxc.curso = axc.curso
// 						INNER JOIN profesores AS p ON p.profesor = pxc.profesor";
		
// 		/***** SAPIENTIA DATA ************/
// 		//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
// 		$database = new SapientiaDatabaseAdapter();
// 		//llamamos al metodo que nos devuelve el adaptador de bd
// 		$sapientiaDbadapter = $database->createService($this->getServiceLocator());
		
// 		//$usuarioLogueado
// 		$statement = $sapientiaDbadapter->query($sql);
// 		$result    = $statement->execute();
		
// 		$selectDataMat = array();
// 		$selectDataFech = array();
// 		$selectDataProf = array();
		
// 		foreach ($result as $res) {
// 			$selectDataMat[$res['n_materia']] = $res['n_materia'];
// 			$selectDataFech[$res['fecha_de_examen']] = $res['fecha_de_examen'];
// 			$selectDataProf[$res['n_profesor']] = $res['n_profesor'];
// 		}
// 		//////////////////////***********FIN Extracción de Datos**************/////////////////

		
// 		$adapter = new PaginatorDbAdapter($result, $model->getAdapter());
// 		$paginator = new Paginator($adapter);
// 		$currentPage = $this->params('page', 1);
// 		$paginator->setCurrentPageNumber($currentPage);
// 		$paginator->setItemCountPerPage(10);

// 		$this->viewModel->setVariables(array('solicitudes'=> $paginator,
// 				'page'=> $currentPage
// 		));

// 		return $this->viewModel;
// 	}
}