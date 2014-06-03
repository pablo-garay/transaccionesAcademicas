<?php

namespace Solicitud\Controller;

use Solicitud\Form\Formulario as Form;
use Zend\Mvc\Controller\AbstractActionController;
use Solicitud\Service\Factory\Database as DatabaseAdapter;
use Solicitud\Service\Factory\SapientiaDatabase as SapientiaDatabaseAdapter;

require_once 'SapientiaClient.php';
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
            	

            	$this->flashmessenger()->addSuccessMessage('Solicitud Enviada');

				// redirect the user to its home page
				return $this->redirect()->toRoute('zfcuser', array (
						'controller' => 'zfcuser',
						'action'     => 'index',
				));
            } else {
            	// debug code -- borrar despues!
            	$this->flashmessenger()->addSuccessMessage(print_r($info, TRUE));
            	$messages = $form->getMessages();
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
		$form = new Form\SolicitudConvalidacionMaterias('solicitudConvalidacionMaterias', $this->dbAdapter); // instanciar formulario
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
	public function setMatriculaCarrera()
	{
		if(isset($_POST["matricula"]))
		{
		
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "SELECT carr.nombre as n_carrera 
					FROM matriculas_por_carrera AS c
					INNER JOIN carreras AS carr ON c.carrera = carr.carrera 
					AND c.matricula = ".$_POST["matricula"];
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			$opciones = '<option value="0"> Elija su carrera.. </option>';
		
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["n_carrera"].'">'.$res["n_carrera"].'</option>';
			}
			echo $opciones;
		}		
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
		
			// 			$selectCorrelativas = array();
		
			// 			foreach ($result as $res) {
			// 				$selectCorrelativas[$res['correlativa']] = $res['correlativa'];
			// 			}
			// 			$correlativas = implode("'\n'", $selectCorrelativas);
			// 			$correlativas = str_replace("  ", "", $correlativas);
			//$opciones = '<option value="0"> Elija la asignatura.. </option>';
		
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["semestre"].'">'.$res["semestre"].'</option>';
			}
			echo $opciones;
		}
		
	}
	
	public function getFechaOportunidad($asignatura)
	{
		date_default_timezone_set('America/Asuncion'); // setea la zona horaria para algunas funciones date()
		$anhoActual = date ('Y'); $mesActual = date ('n');
		
		if ( $mesActual > AGOSTO && $mesActual < MARZO ) {  $semestreActual = 2; }
		else
		{ $semestreActual = 1; }
		
		$dbAdapter = $this->getDbAdapterSapientia();
		$sql = "SELECT  h.fecha_de_examen, h.oportunidad  FROM materias AS m
						INNER JOIN cursos AS c ON m.materia = c.materia AND m.nombre = '".$asignatura."'
						AND c.anho = ".$anhoActual." AND c.semestre_anho =".$semestreActual."
						INNER JOIN Horarios_de_examen AS h ON h.curso = c.curso";
			
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();
		return $result;		
	}
	
	
	public function getAsignaturasCarrera($carrera, $matricula)
	{
		date_default_timezone_set('America/Asuncion'); // setea la zona horaria para algunas funciones date()
		$anhoActual = date ('Y');
		$mesActual = date ('n');
	
		if ( $mesActual > AGOSTO && $mesActual < MARZO ) {
			$semestreActual = 2;
		}
		else
		{
			$semestreActual = 1;
		}
		$dbAdapter = $this->getDbAdapterSapientia();
		$sql = "SELECT  DISTINCT ON (m.nombre, m.materia) m.materia AS cod_asignatura, m.nombre AS asignatura  
				FROM matriculas_por_alumno AS mxa 
				INNER JOIN alumnos_por_curso AS axc ON axc.numero_de_documento = mxa.numero_de_documento 
				AND mxa.matricula = ".$matricula." 
				INNER JOIN cursos AS c ON c.curso = axc.curso
				AND axc.curso_actual = TRUE
				INNER JOIN materias AS m ON c.materia = m.materia
				INNER JOIN materias_por_carrera AS mxc ON mxc.materia = m.materia
				INNER JOIN carreras AS carr ON mxc.carrera = carr.carrera AND carr.nombre = '".$carrera."'";
			
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();
		return $result;
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
		
	////////////////**********Extraer Datos del Usuario*********///////////////
				
		
		
		///////////*******Todas las solicitudes ****************//////////
		$this->setMatriculaCarrera();
		///////////*******FIN*******//////////////////
		
		
		////////////////**************** INICIO Solicitud de Extraordinario********************//////////
		
		if(isset($_POST["materia"]))
		{
			$opciones = $this->getAsignaturasPorProfesor($_POST["materia"]);
			echo $opciones;
		}
		
		////////////////**************** FIN de Solicitud de Extraordinario********************//////////
		
		
		
		
		////////////////**************** INICIO Solicitud de Ruptura********************//////////
		
		if(isset($_POST["carrera_ruptura"]))
		{
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "SELECT DISTINCT ON (m.nombre) m.nombre AS n_asignatura FROM materias AS m INNER JOIN materias_por_carrera AS mxc ON mxc.materia = m.materia
		    			INNER JOIN carreras AS c ON mxc.carrera = c.carrera AND c.nombre = '".$_POST['carrera_ruptura']."'";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			$opciones = '<option value="0"> Elija la asignatura.. </option>';
		
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["n_asignatura"].'">'.$res["n_asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		if(isset($_POST["asignatura_ruptura"]))
		{
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "SELECT nombre AS correlativa FROM materias WHERE materia IN (SELECT cxc.materia_correlativa AS id_correlativa FROM materias AS m 
					INNER JOIN correlativa_por_carrera AS cxc ON m.nombre = '".$_POST["asignatura_ruptura"]."' 
					AND cxc.materia = m.materia)";
		    			
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			
// 			$selectCorrelativas = array();
			
// 			foreach ($result as $res) {
// 				$selectCorrelativas[$res['correlativa']] = $res['correlativa'];
// 			}
// 			$correlativas = implode("'\n'", $selectCorrelativas);
// 			$correlativas = str_replace("  ", "", $correlativas);
			$opciones = '<option value="0"> Elija la asignatura correlativa.. </option>';
		
			foreach ($result as $res) {
				
				$opciones.='<option value="'.$res["correlativa"].'">'.$res["correlativa"].'</option>';
			}
			echo $opciones;
		}

		$this->setSemestreAsignatura("asignatura_semestre");
		$this->setSemestreAsignatura("prerrequisito_semestre");
	
		
		////////////////**************** FIN de Solicitud de Ruptura********************//////////
		
		
		
		
		
		////////////////**************** INICIO Solicitud de Inscripcion Tardia********************//////////

		define ("AGOSTO", 8); //hacer una funcion 
		define ("MARZO", 3);
		if(isset($_POST["asignatura_fecha_tardia"]))
		{	
			$result = getHorariosExamen($_POST["carrera_fecha_tardia"]);
			//$opciones = '<option value="0"> Elija la fecha de examen.. </option>';
		
			foreach ($result as $res) {
				if($_POST["asignatura_fecha_tardia"] == $res['asignatura']){
					$opciones.='<option value="'.$res["fecha_examen"].'">'.$res["fecha_examen"].'</option>';
				}
			}
			
			echo $opciones;
		}
		
		if(isset($_POST["asignatura_op_tardia"]))
		{
			$result = $this->getFechaOportunidad($_POST["asignatura_op_tardia"]);
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["oportunidad"].'">'.$res["oportunidad"].'</option>';
			}
			echo $opciones;
		}
		
		////////////////*************Asignaturas actualmente inscriptas
		if(isset($_POST["carrera_asignatura_inscriptas"]))
		{
			$opciones = '<option value="0"> Elija la asignatura .. </option>';
			$result = getAsignaturas($_POST["carrera_asignatura_inscriptas"], $_POST["mat"], "CURSANDO");
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		/////////////*************Seccion de la asignatura actualmente inscripta
		if(isset($_POST["asignatura_seccion"]))
		{
			$opciones = '<option value="0"> Elija la asignatura .. </option>';
			$result = getAsignaturas($_POST["carrera_seccion"], $_POST["mat_seccion"], "CURSANDO");
		
			foreach ($result as $res) {
				//if ($res['asignatura'] == $_POST["asignatura_seccion"]){
					$opciones.='<option value="'.$res["seccion"].'">'.$res["seccion"].'</option>';
				//}
			}
			echo $opciones;
		}	
			
		////////////////**************** FIN de Solicitud de Inscripcion Tardia********************//////////
		
		if(isset($_POST["cod_asignatura"]))
		{
			//$opciones = '<option value="0"> Seleccione el código .. </option>';
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
		if(isset($_POST["examen_carrera"]))
		{
			$opciones = '<option value="0"> Seleccione la asignatura .. </option>';
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "SELECT DISTINCT m.nombre AS asignatura FROM 
					matriculas_por_alumno AS mxa 
					INNER JOIN alumnos_por_curso AS axc ON mxa.numero_de_documento = axc.numero_de_documento 
					AND axc.curso_actual = TRUE AND  mxa.matricula = ".$_POST["matr"]."
					INNER JOIN inscripcion_examen_por_alumno AS iexa ON iexa.numero_de_documento = mxa.numero_de_documento
					INNER JOIN cursos AS c ON iexa.curso = c.curso
					INNER JOIN materias AS m ON m.materia = c.materia
					INNER JOIN matriculas_por_carrera AS mxcarr ON mxcarr.matricula = mxa.matricula 
					INNER JOIN carreras AS carr ON carr.carrera = mxcarr.carrera AND carr.nombre = '".$_POST["examen_carrera"]."'";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		if(isset($_POST["seccion_asignatura"]))
		{
			//$opciones = '<option value="0"> Seleccione el código .. </option>';
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		if(isset($_POST["opo_asignatura"]))
		{
			//$opciones = '<option value="0"> Seleccione el código .. </option>';
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		if(isset($_POST["fecha_opo_asignatura"]))
		{
			//$opciones = '<option value="0"> Seleccione el código .. </option>';
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		if(isset($_POST["opo_pagar_asignatura"]))
		{
			//$opciones = '<option value="0"> Seleccione el código .. </option>';
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		
		if(isset($_POST["fecha_opo_pagar_asignatura"]))
		{
			//$opciones = '<option value="0"> Seleccione el código .. </option>';
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		//////////FIN traspaso de pago
		
	
		///Colaborador Asignatura
		if(isset($_POST["colaborador_asignatura"]))
		{
			//$opciones = '<option value="0"> Seleccione el código .. </option>';
			$dbAdapter = $this->getDbAdapterSapientia();
			$sql = "";
		
			$statement = $dbAdapter->query($sql);
			$result    = $statement->execute();
			foreach ($result as $res) {
				$opciones.='<option value="'.$res["asignatura"].'">'.$res["asignatura"].'</option>';
			}
			echo $opciones;
		}
		///////FIN Colaborador	
	}
	
}
