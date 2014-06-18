<?php

namespace Solicitud\Controller;

use Solicitud\Form\Formulario as Form;
use Zend\Mvc\Controller\AbstractActionController;
use Solicitud\Service\Factory\Database as DatabaseAdapter;
use Solicitud\Service\Factory\SapientiaDatabase as SapientiaDatabaseAdapter;
use Solicitud\Form\Formulario\getDatosUsuario;

use Solicitud\Sapientia\SapientiaClient as SapientiaClient;
use Solicitud\Model\FuncionesDB as FuncionesDB;



class FormularioController extends AbstractActionController
{
	private $dbAdapter = null;
    public function indexAction()
    {
    	//@todo Solicitudes Index page    	   
        return array();
    }
    
    
    public function setIdUsuario()
    {
     
    	$this->idUsuario = $this->zfcUserAuthentication()->getIdentity()->getId();
    }
    
    public function setDbAdapter()
    {
    	//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
    	$database = new DatabaseAdapter();
    	//llamamos al metodo que nos devuelve el adaptador de bd
    	$dbAdapter = $database->createService($this->getServiceLocator());
    	
    	$this->dbAdapter = $dbAdapter;
    }
    
    /*******************     ADAPTADOR DE BD DE SAPIENTIA ***************/
    public function getDbAdapterSapientia()
    {
    	//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
    	$database = new SapientiaDatabaseAdapter();
    	//llamamos al metodo que nos devuelve el adaptador de bd
    	$dbAdapter = $database->createService($this->getServiceLocator());
    
    	return $dbAdapter;
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
             	
             	//unset($form->get('enviar'));
            	// You can use the standard way of instantiating a table gateway
            	//$model = new UserModel();
            	// Or if you have many db tables that do need special treatment of the incoming data
            	// you can use the table gateway service

            	$info = $form->getData(); //The form's getData returns an array of key/value pairs
				
            	$solicitudesModel = $this->serviceLocator->get('table-gateway')->get('solicitudes');
            	$info['usuario'] = $this->idUsuario; // tipo de solicitud insertada
            	$info['tipo_solicitud'] = $tableName; // tipo de solicitud insertada
            	$id = $solicitudesModel->insert($info); // @todo valor id: posible problema de concurrencia
            	
            	$info['solicitud'] = $id; // id de solicitud insertada
            	//echo print_r($info);
            	# obtener campos de la tabla de la Solicitud Especifica
            	$metadata = new \Zend\Db\Metadata\Metadata($this->dbAdapter);
            	$columns = $metadata->getColumnNames($tableName);

				# filtrar solo los campos que correspondan a la tabla de la Solicitud Especifica
				# para insertarlos en ella - interseccion entre campos de form y campos de Solicitud Especifica
            	$filtered = array_intersect_key($info, array_flip($columns));
            	
            	$solEspecificaModel = $this->serviceLocator->get('table-gateway')->get($tableName);
            	$res = $solEspecificaModel->insert($filtered);
            	
            	if (array_key_exists ( 'asignatura' , $info )){ #caso en que solicitud involucra materia            		            		
            		# obtener campos de la tabla Asignaturas por Solicitud
            		$columns = $metadata->getColumnNames('asignaturas_por_solicitud');
             		# interseccion entre campos de form y campos de Asignaturas por Solicitud
             		$filtered = array_intersect_key($info, array_flip($columns));
 
             		$asignaturasSolicitudModel = $this->serviceLocator->get('table-gateway')->get('asignaturas_por_solicitud');
             		$asignaturasSolicitudModel->insert($filtered);
            	}
				
				
            	$this->flashmessenger()->addInfoMessage('Solicitud Enviada');

				// redirect the user to its home page
				
				return $this->redirect()->toRoute('zfcuser', array (
						'controller' => 'zfcuser',
						'action'     => 'index',
				));
            } else {
      
            	// debug code -- borrar despues!
            	// $this->flashmessenger()->addSuccessMessage(print_r($info, TRUE));
            	$messages = $form->getMessages();
            	//return $this->redirect()->refresh();
            }
        }

        // pass the data to the view for visualization
        return array('form1'=> $form);
    }
    
    public function extraordinarioAction(){
    	
    	$this->setDbAdapter(); # init DB adapter
    	$this->setIdUsuario(); # identificacion usuario logueado
    	$form = new Form\SolicitudExtraordinario($this->dbAdapter, $this->idUsuario, $this->getDbAdapterSapientia()); // instanciar formulario
    	return $this->solicitudFormHandler($form, 'solicitud_de_extraordinario'); # llamar a manejador de formulario 
    }

	public function rupturaAction()
	{
		$this->setDbAdapter(); # init DB adapter 
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudRupturaCorrelatividad($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_ruptura_de_correlatividad'); # llamar a manejador de formulario
	}

	public function certificadoAction()
	{
		$this->setDbAdapter(); # init DB adapter 
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudCertificadoEstudios($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_certificado_de_estudios'); # llamar a manejador de formulario
	}

	public function inscripciontardiaAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudInscripcionTardia($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_inscripcion_tardia_a_examen'); # llamar a manejador de formulario		
	}

	public function creditosAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudCreditos($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_creditos_academicos'); # llamar a manejador de formulario
	}

	public function reduccionAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudReduccionAsistencia($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_reduccion_de_asistencia'); # llamar a manejador de formulario		
	}

	public function revisionexamenAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudRevisionExamen($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_revision_de_examen'); # llamar a manejador de formulario
	}

	public function desinscripcionAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudDesinscripcionCurso($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_desinscripcion_de_curso'); # llamar a manejador de formulario
	}

	public function traspasopagoAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudTraspasoPago($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_traspaso_de_pago_de_examen'); # llamar a manejador de formulario		
	}

	public function revisionescolaridadAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudRevisionEscolaridad($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_revision_de_escolaridad'); # llamar a manejador de formulario
	}

	public function colaboradorcatedraAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudColaboradorCatedra($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_colaborador_de_catedra'); # llamar a manejador de formulario
	}

	public function tituloAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudTitulo($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_titulo'); # llamar a manejador de formulario
	}

	public function convalidacionmateriasAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudConvalidacionMaterias('solicitudConvalidacionMaterias', $this->dbAdapter, $this->idUsuario); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_convalidacion_de_materias'); # llamar a manejador de formulario
	}

	public function homologacionmateriasAction()
	{
		$this->setDbAdapter(); # init DB adapter 
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudHomologacionMaterias($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_homologacion_de_materias'); # llamar a manejador de formulario
	}

	public function tesisAction()
	{
		$this->setDbAdapter(); # init DB adapter 
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudTesis($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_tesis'); # llamar a manejador de formulario
	}

	public function pasantiaAction()
	{
		$this->setDbAdapter(); # init DB adapter 
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudPasantia($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_pasantia'); # llamar a manejador de formulario
	}

	public function tutoriacatedraAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudTutoriaCatedra($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_tutoria_de_catedra'); # llamar a manejador de formulario
	}

	public function exoneracionAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudExoneracion($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_exoneracion'); # llamar a manejador de formulario
	}

	public function materiafueramallacurricularAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudMateriaFueraMallaCurricular($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_para_tomar_materia_fuera_de_la_malla_curricular'); # llamar a manejador de formulario
	}
	
	public function cambioseccionAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudCambioSeccion($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_cambio_de_seccion'); # llamar a manejador de formulario
	}

	public function inclusionlistaAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudInclusionLista($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitud_de_inclusion_en_lista'); # llamar a manejador de formulario
	}
	
	public function solicitudesvariasAction()
	{
		$this->setDbAdapter(); # init DB adapter
		$this->setIdUsuario(); # identificacion usuario logueado
		$form = new Form\SolicitudesVarias($this->dbAdapter, $this->idUsuario,  $this->getDbAdapterSapientia()); // instanciar formulario
		return $this->solicitudFormHandler($form, 'solicitudes_varias'); # llamar a manejador de formulario
	}	
	
	
	
	////////////*************Parte Datos Dinámicos ******************///////////////////
	public function setMatriculaCarrera($numeroDocumentoUsuario, $sapientiaClient)
	{
		if(isset($_POST["matricula"]))
		{
			$result = $sapientiaClient->getMatriculaCarrera($numeroDocumentoUsuario);
			$opciones = '<option value="0"> Elija su carrera.. </option>';
		
			foreach ($result as $res) {
				if ($res['matricula'] == $_POST["matricula"]){
					$opciones.='<option value="'.$res["n_carrera"].'">'.$res["n_carrera"].'</option>';
				}
			}
			echo $opciones;
		}
		return $this->response;		
	}
	
	public function setSemestreAsignatura ($asignatura)
	{
		if(isset($_POST[$asignatura]))
		{
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "SELECT semestre_carrera AS semestre 
					FROM materias WHERE nombre = '".$_POST[$asignatura]."'";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
	
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["semestre"].'">'.$res["semestre"].'</option>';
			}
			echo $opciones;
		}
		return $this->response;
	}
	
	public function getAsignaturasPorProfesor (){
		$dbAdapter = $this->getDbAdapterSapientia();
		$sql = "SELECT DISTINCT ON (p.nombre) p.nombre AS n_profesor FROM profesores_por_curso AS pxc INNER JOIN profesores AS p ON pxc.profesor = p.profesor
		    			INNER JOIN cursos AS c ON pxc.curso = c.curso INNER JOIN materias AS m ON c.materia = m.materia AND m.nombre = '".$_POST['materia']."'";
		
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();
		$opciones = '<option value="0"> Elija un Profesor.. </option>';
		
		foreach ($result as $res) {
			$opciones.='<option value="'.$res["n_profesor"].'">'.$res["n_profesor"].'</option>';
		}
		return $opciones;
	}
	
	///////////**************Procesador Dinámico ***********//////////////////////
	
	public function procesardatosAction(){
		$sapientiaClient = new SapientiaClient();
		$funcionesDB = new FuncionesDB();
		////////////////**********Extraer Datos del Usuario*********///////////////
		///////////*******Todas las solicitudes ****************//////////
		$this->setDbAdapter();
		$this->setIdUsuario();
		$datos = $funcionesDB->getDatosUsuario($this->dbAdapter, $this->idUsuario);
		$numeroDocumento = $datos['numero_de_documento'];
		
		$this->setMatriculaCarrera($numeroDocumento, $sapientiaClient);
		///////////*******FIN*******//////////////////
		
		
		////////////////**************** INICIO Solicitud de Extraordinario********************//////////
		
		if(isset($_POST["anho_profesores"]) || isset($_POST["seccion_profesores"]) || isset($_POST["semestre_anho_profesores"]))
		{
			$result    = $sapientiaClient->getProfesoresPorCurso($_POST["materia_profesores"], $_POST["seccion_profesores"],
						 $_POST["semestre_anho_profesores"], $_POST["anho_profesores"]);
			
			$opciones = '<option value="0"> Elija un Profesor.. </option>';
			if ($result == null){
				$opciones = '<option value="0"> Ha elegido un curso inexistente.. </option>';
			}
			
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["n_profesor"].'">'.$res["n_profesor"].'</option>';
			}
			
			echo $opciones;
		}
		
		////////////////**************** FIN de Solicitud de Extraordinario********************//////////
		
		
		
		
		////////////////**************** INICIO Solicitud de Ruptura********************//////////
		
		
		if(isset($_POST["asignatura_ruptura"]))
		{
			$result = $sapientiaClient->getCorrelatividad($_POST["carrera_ruptura"], $_POST["asignatura_ruptura"]);
			$opciones = '<option value="0"> Elija la asignatura correlativa.. </option>';
		
			foreach ($result as $res) {
				
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}

		$this->setSemestreAsignatura("asignatura_semestre");
		$this->setSemestreAsignatura("prerrequisito_semestre");
	
		
		////////////////**************** FIN de Solicitud de Ruptura********************//////////
		
		
		
		
		
		////////////////**************** INICIO Solicitud de Inscripcion Tardia********************//////////

		if(isset($_POST["anho_inscripcion_tardia"])||isset($_POST["seccion_inscripcion_tardia"])||isset($_POST["semestre_anho_inscripcion_tardia"])) // para rescatar la fecha de examen
		{	
			$result = $sapientiaClient->getHorariosExamen($_POST["carrera_inscripcion_tardia"]);
			
			$inscriptoBand = FALSE;
			$opciones = '<option value="0"> Elija la fecha de examen.. </option>';
			foreach ($result as $res) {
				if($_POST["asignatura_inscripcion_tardia"] == $res['asignatura'] && $_POST["seccion_inscripcion_tardia"] == $res['seccion']
        			&& $_POST["semestre_anho_inscripcion_tardia"] == $res['semestre'] && $_POST["anho_inscripcion_tardia"] == $res['anho']){
						$opciones.='<option value="'.$res["fecha_examen"].'">'.$res["fecha_examen"].'</option>';
						$inscriptoBand = TRUE;
				}
			}
			if(!$inscriptoBand){
				$opciones = '<option value="0"> Curso no válido.. </option>';
			}
				echo $opciones;
		}
		

		
		////////////////*************Asignaturas actualmente inscriptas
		if(isset($_POST["carrera_asignaturas_inscriptas"]) || $_POST["asignatura_seccion_inscripta"])
		{
			$opciones = '<option> Elija la asignatura .. </option>';
			//$result = $this->$sapientiaClient->getAsignaturasCarrera($_POST["carrera_asignatura_inscriptas"], $_POST["mat"]);
			$result = $sapientiaClient->getAsignaturas($_POST["carrera_asignaturas_inscriptas"], $_POST["matricula_asignaturas_inscriptas"], "CURSANDO");
			foreach ($result as $res) {
				
				if(isset($_POST["asignatura_seccion_inscripta"]) && $res['asignatura'] == $_POST["asignatura_seccion_inscripta"]){
					$opciones = '<option value="0"> Elija la seccion .. </option>';
					$opciones.='<option value="'.$res["seccion"].'">'.$res["seccion"].'</option>';
					break;
				}else{
					$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
				}
				
			}
			echo $opciones;
		}
		
		//////////////////////////***************************
		if(isset($_POST["carrera_asignaturas_todas"]))
		{
			$opciones = '<option value="0"> Elija la asignatura .. </option>';
			$result = $sapientiaClient->getAsignaturas($_POST["carrera_asignaturas_todas"], $_POST["matricula_asignaturas_todas"], "TODAS");
			$opciones = '<option value="0"> Elija la asignatura .. </option>';
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		/////////////////////////****************************
		if(isset($_POST["carrera_asignaturas_cursadas"]) || isset($_POST["asignatura_seccion_cursada"]))
		{	
			
			$opciones = '<option value="0"> Elija la asignatura .. </option>';
			$resultAsignatura = $sapientiaClient->getAsignaturas($_POST["carrera_asignaturas_cursadas"], $_POST["matricula_asignaturas_cursadas"], "CURSADAS");
			$resultCalificaciones = $sapientiaClient->getCalificaciones($numeroDocumento, $_POST["matricula_asignaturas_cursadas"]);
			
			//$rendidasNoAprobadas = array_filter($resultCalificaciones, function($el) { $calificacionMinima = 2; return ($el['calificacion'] <  $calificacionMinima); });
			$rendidasAprobadas = array_filter($resultCalificaciones, function($el) { $calificacionMinima = 2; return ($el['calificacion'] >= $calificacionMinima ); });
			
			$asignaturasCursadasNoAprobadas = array();
			
			foreach( $resultAsignatura as $resCursadas ) {
			   $aprobadoBandera = false;
			   foreach ( $rendidasAprobadas as $resAprobadas ){
			   			if ($resCursadas['asignatura'] == $resAprobadas['asignatura']){
			   				$aprobadoBandera = true;
			   				break;
			   			}
			   }
			   if (!$aprobadoBandera){ // Solo agregamos si rindio y no paso, o no cursó y no rindió
			   		array_push($asignaturasCursadasNoAprobadas, $resCursadas);
			   }
			}

	
			
			foreach ($asignaturasCursadasNoAprobadas as $res) {
				if(isset($_POST["asignatura_seccion_cursada"]) && $res['asignatura'] == $_POST["asignatura_seccion_cursada"]){
					$opciones = '<option value="0"> Elija la seccion .. </option>';
					$opciones.='<option value="'.$res["seccion"].'">'.$res["seccion"].'</option>';
					break;
				}else{
					$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
				}
			}
			//$opciones = array("asignaturas" => $opciones1, "secciones" => $opciones2);
			echo $opciones;
			
		}
		
		////////////////////////***************************
		
		if(isset($_POST["carrera_asignaturas_no_cursadas"]) )
		{
				
			$opciones = '<option value="0"> Elija la asignatura .. </option>';
			$resultAsignatura = $sapientiaClient->getAsignaturas($_POST["carrera_asignaturas_no_cursadas"], $_POST["matricula_asignaturas_no_cursadas"], "TODAS");
			$resultCalificaciones = $sapientiaClient->getCalificaciones($numeroDocumento, $_POST["matricula_asignaturas_no_cursadas"]);
				
			//$rendidasNoAprobadas = array_filter($resultCalificaciones, function($el) { $calificacionMinima = 2; return ($el['calificacion'] <  $calificacionMinima); });
			$rendidasAprobadas = array_filter($resultCalificaciones, function($el) { $calificacionMinima = 2; return ($el['calificacion'] >=  $calificacionMinima); });
				
			$asignaturasNoAprobadas = array();
				
			foreach( $resultAsignatura as $resCursadas ) {
				$aprobadoBandera = FALSE;
				foreach ( $rendidasAprobadas as $resAprobadas ){
					if ($resCursadas['asignatura'] == $resAprobadas['asignatura']){
						$aprobadoBandera = TRUE;
						break;
					}
				}
				if (!$aprobadoBandera){  // Solo agregamos si no aprobó todavía la asignatura
					array_push($asignaturasNoAprobadas, $resCursadas);
				}
			}
		
		
				
			foreach ($asignaturasNoAprobadas as $res) {
// 				if(isset($_POST["asignatura_seccion_cursada"]) && $res['asignatura'] == $_POST["asignatura_seccion_cursada"]){
// 					$opciones = '<option value="0"> Elija la seccion .. </option>';
// 					$opciones.='<option value="'.$res["seccion"].'">'.$res["seccion"].'</option>';
// 					break;
// 				}else{
					$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
				//}
			}
			//$opciones = array("asignaturas" => $opciones1, "secciones" => $opciones2);
			echo $opciones;
				
		}
		
		///////////////////////*****************************

		
		////////////////////////Revision examen
		if(isset($_POST["carrera_fecha_revision_examen"]))
		{
			//$opciones = '<option value="0"> Elija la asignatura .. </option>';
			$result = getHorarios("Ingeniería Informática");//$_POST["carrera_fecha_revision_examen"]
			
			$result = $this->getFechaOportunidad($_POST["asignatura_op_tardia"]);
		
			
			foreach ($result as $res) {	
					$opciones.='<option value="'.$res["fecha_examen"].'">'.$res["fecha_examen"].'</option>';
			}
			echo $opciones;
		}
		
		
		
		/////////////*************Seccion de la asignatura actualmente inscripta
		
		if(isset($_POST["asignatura_seccion"]))
		{
			$opciones = '<option value="0"> Elija la sección .. </option>';
			$result = $sapientiaClient->getAsignaturas($_POST["carrera_seccion"], $_POST["mat_seccion"], "TODAS");
		
			foreach ($result as $res) {
				if ($res['asignatura'] == $_POST["asignatura_seccion"]){
					$opciones.='<option value="'.$res["seccion"].'">'.$res["seccion"].'</option>';
				}
			}
			echo $opciones;
		}
			
		////////////////**************** FIN de Solicitud de Inscripcion Tardia********************//////////
		
		
		////////////////*****************Solicitud de desinscripción
		
		if(isset($_POST["cod_asignatura"]))
		{
			$opciones = '<option value="0"> Seleccione el código .. </option>';
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "SELECT materia AS cod_asignatura FROM materias WHERE nombre = '".$_POST["cod_asignatura"]."'";
				
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["cod_asignatura"].'">'.$res["cod_asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		////////////////************Traspaso de pago de examen******************////////////
		
		if(isset($_POST["carrera_examen_inscripto"]) || isset($_POST["asignatura_examen_inscripto"]))
		{
			$opciones = '<option value="0"> Seleccione la asignatura .. </option>';


			$resultInscriptos = $sapientiaClient->getInscripcionesExamen($numeroDocumento, $_POST["matricula_examen_inscripto"]);
			$resultActuales = $sapientiaClient->getAsignaturas($_POST["carrera_examen_inscripto"], $_POST["matricula_examen_inscripto"], "CURSANDO");
			
			foreach ($resultInscriptos as $resI) {
// 				if (isset($_POST["carrera_examen_inscripto"])){
				foreach ($resultActuales as $resA) {
					if ($resI['asignatura'] == $resA['asignatura']){
						$opciones.='<option value="'.$resI["asignatura"].'">'.$resI["asignatura"].'</option>';
					}
				}
// 				}else if (isset($_POST["asignatura_examen_inscripto"])){
// 					$opciones.='<option value="'.$res["seccion"].'">'.$res["seccion"].'</option>';
					
// 				}else if (isset($_POST["seccion_examen_inscripto"])){
// 					$opciones.='<option value="'.$res["oportunidad"].'">'.$res["oportunidad"].'</option>';
				
// 				}else if (isset($_POST["seccion_examen_inscripto"])){
// 					$opciones.='<option value="'.$res["oportunidad"].'">'.$res["oportunidad"].'</option>';
// 				}
				
			}
			echo $opciones;
		}
		return $this->response;
	}
	
}