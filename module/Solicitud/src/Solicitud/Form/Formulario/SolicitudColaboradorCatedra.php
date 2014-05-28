<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudColaboradorCatedra extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter,  AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudColaboradorCatedra', $dbadapter, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		
		$sql       = "SELECT p.nombre AS n_profesor, m.nombre AS n_materia, carr.nombre AS n_carrera 
				FROM profesores AS p 
				INNER JOIN profesores_por_curso AS pxc ON p.profesor = pxc.profesor
				INNER JOIN cursos AS c ON pxc.curso = c.curso 
				INNER JOIN materias AS m ON c.materia = m.materia
				INNER JOIN materias_por_carrera AS mxc ON m.materia = mxc.materia
				INNER JOIN carreras AS carr ON carr.carrera = mxc.carrera";
		//$usuarioLogueado
		$statement = $sapientiaDbadapter->query($sql);
		$result    = $statement->execute();
		
		$selectDataMat = array();
		$selectDataProf = array();
		$selectDataCarr = array();
		foreach ($result as $res) {
			$selectDataMat[$res['n_materia']] = $res['n_materia'];
			$selectDataProf[$res['n_profesor']] = $res['n_profesor'];
			$selectDataCarr[$res['n_carrera']] = $res['n_carrera'];
		}
		$carreras = implode("'\n'", $selectDataCarr);
		$carreras = str_replace("  ", "", $carreras);
		//////////////////////***********FIN Extracción de Datos**************/////////////////
	
		$this->add(array(
				'name' => 'profesor',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Profesor:',
						'empty_option' => 'Elija un Profesor..',
						'value_options' => $selectDataProf,
				),
				'attributes' => array(
						'required' => 'required',
				),	
		),
				array (
						'priority' => 850,
				)
						);
		
	
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => $selectDataMat//asignar dinámicamente
				),
				'attributes' => array(
						'required' => 'required',
				),
		),
				array (
						'priority' => 840,
				)
		);
		$this->add(array(
				'name' => 'carreras_profesor',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Carreras',
		
							
				),
				'attributes' => array(
						'value' =>  $carreras,
						'required' => 'required',
// 						'disabled' => 'disabled'
				),
		
		),
				array (
						'priority' => 830,
				)
		);
		
	
		$this->add(array(
				'name' => 'descripcion_actividades',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Descripción de actividades',

				),
				'attributes' => array(
						'required' => 'required',
				),
		),
				array (
						'priority' => 240,
				)
						);
	
	
		// This is the special code that protects our form beign submitted from automated scripts
		$this->add(array(
				'name' => 'csrf',
				'type' => 'Zend\Form\Element\Csrf',
		));
	

	
	}
	
	public function getInputFilter()
	{
		if (! $this->filter) {
			$inputFilter = parent::getInputFilter();
			$factory = new InputFactory ();
			
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'profesor',
					'filters' => array (
							array (
									'name' => 'StripTags'
							),
							array (
									'name' => 'StringTrim'
							)
					),
					'validators' => array (
							array (
									'name' => 'NotEmpty',
							),
							array (
									'name' => 'alnum',
									'options' => array (
											'messages' => array (
													'notAlnum' => 'Se requieren sólo números y letras'
											),
											'allowWhiteSpace' => true,
									)
							),
								
					)
			
			) ) );
	
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'asignatura',
					'filters' => array (
							array (
									'name' => 'StripTags'
							),
							array (
									'name' => 'StringTrim'
							)
					),
					'validators' => array (
							array (
									'name' => 'NotEmpty',
							),
							array (
									'name' => 'alnum',
									'options' => array (
											'messages' => array (
													'notAlnum' => 'Se requieren sólo números y letras'
											),
											'allowWhiteSpace' => true,
									)
							),
							
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'carreras_profesor',
					'filters' => array (
							array (
									'name' => 'StripTags'
							),
							array (
									'name' => 'StringTrim'
							)
					),
					'validators' => array (
							array (
									'name' => 'NotEmpty',
							),
							array (
									'name' => 'alnum',
									'options' => array (
											'messages' => array (
													'notAlnum' => 'Se requieren sólo números y letras'
											),
											'allowWhiteSpace' => true,
									)
							),
							
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'descripcion_actividades',
					'filters' => array (
							array (
									'name' => 'StripTags'
							),
							array (
									'name' => 'StringTrim'
							)
					),
					'validators' => array (
							array (
									'name' => 'NotEmpty',
							),
							array (
									'name' => 'alnum',
									'options' => array (
											'messages' => array (
													'notAlnum' => 'Se requieren sólo números y letras'
											),
											'allowWhiteSpace' => true,
									)
							),
			
					)
						
			) ) );
			
			
			

	
			$this->filter = $inputFilter;
		}
	
		return $this->filter;
	}

	
	public function getAsignaturasDeCarrera()
	{
		//@todo: Rescatar los asignaturas según la carrera elegida en el combo
		$carreraElegida = $this->get('carrera')->getAttribute('value');
	
	}
	
	public function getProfesores()	
	{
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// recatar su cedula
		$sql = 'SELECT nombre FROM Profesores'; // $usuarioLogueado
		
		
		$statement = $this->sapientiaDbAdapter->query($sql);
		$result    = $statement->execute();
	
		$selectData = array();
	
		foreach ($result as $res) {
			$selectData[$res['nombre']] = $res['nombre'];
		}
			return $selectData;
	}
	
	
	
	public function getAsignaturaDeProfesor() // debe ser dinámico
	{
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// recatar su cedula
		$sql = 'SELECT m.nombre FROM materias AS m INNER JOIN cursos AS c ON m.materia = c.materia
				INNER JOIN profesores_por_curso AS pxc ON c.curso = pxc.curso'; // $usuarioLogueado
	
	
		$statement = $this->sapientiaDbAdapter->query($sql);
		$result    = $statement->execute();
	
		$selectData = array();
	
		foreach ($result as $res) {
			$selectData[$res['nombre']] = $res['nombre'];
		}
		return $selectData;
	}
	
	public function getCarrerasDeProfesor()
	{
	
		$sql = 'SELECT c.nombre FROM carreras AS c INNER JOIN carrera_por_materias AS cm ON c.carrera = cm.carrera
				INNER JOIN cursos AS cr ON cr.materia = cm.materia'; // $usuarioLogueado
	
	
		$statement = $this->sapientiaDbAdapter->query($sql);
		$result    = $statement->execute();
	
		$selectData = array();
	
		foreach ($result as $res) {
			$selectData[$res['nombre']] = $res['nombre'];
		}
		$string = implode ("'\n'", $selectData);
		
		$string = str_replace("  ", "", $string);
		
		return $string;
	}
	

	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}