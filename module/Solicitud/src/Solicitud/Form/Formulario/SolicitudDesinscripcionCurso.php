<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once 'funcionesDB.php';


class SolicitudDesinscripcionCurso extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter,  AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudDesinscripcionCurso', $dbadapter, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su cedula
		$usuarioLogueado = 1;
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$cedulaUsuario = $datos['cedula'];
		
		
		$sql       = "SELECT m.materia, m.nombre AS n_materia  FROM materias AS m 
						INNER JOIN cursos AS c ON m.materia = c.materia
						INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso 
						AND axc.numero_de_documento = ".$cedulaUsuario." AND axc.curso_actual = TRUE";
		
		//$usuarioLogueado
		$statement = $sapientiaDbadapter->query($sql);
		$result    = $statement->execute();
		
		$selectDataMat = array();
		
		foreach ($result as $res) {
			$selectDataMat[$res['n_materia']] = 'Asignatura: '.$res['n_materia'].' Código: '.$res['materia'];		
		}
		//////////////////////***********FIN Extracción de Datos**************/////////////////
	
		$this->add(array(
				'name' => 'curso_completo',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Tipo de Desinscripción ',
						'value_options' => array(
								'Curso completo' => 'Curso completo',
								'Por asignatura' => 'Por asignatura'
						),
						//'value_options' => 'Curso completo',
				),	
		),
				array (
						'priority' => 280,
				)
						);

		
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => $selectDataMat,//$this->getSubjectsOfCareer(),
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		
		$this->add(array(
				'name' => 'cod_asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Código Asignatura:',
						'empty_option' => 'Seleccione código de asignatura ',
						'value_options' => $this->getCodigoDeAsignatura(),//$this->getSubjectsOfCareer(),
				),		
		),
				array (
						'priority' => 260,
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
					'name' => 'curso_completo',
					'validators' => array (
							array (
									'name' => 'between',
									'options' => array(
											'min' => 0,
											'max' => 1,
											'inclusive' => true
									)
							),
					)
			) ) );
				
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'por_asignatura',
					'validators' => array (
							array (
									'name' => 'between',
									'options' => array(
											'min' => 0,
											'max' => 1,
											'inclusive' => true
									)
							),
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'cod_asignatura',
					'allow_empty' => true,
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
					'allow_empty' => true,
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

	
	public function getCodigoDeAsignatura() //@todo debe ser dinamico
	{
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// recatar su cedula
		$dbAdapter = $this->sapientiaDbAdapter;
		$sql       = 'SELECT m.materia FROM materias AS m INNER JOIN cursos AS c ON m.materia = c.materia
				INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso AND axc.numero_de_documento = 4490334 AND c.anho = 2014 AND c.semestre_anho = 1';
																									//$usuarioLogueado
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();

		$selectData = array();

		foreach ($result as $res) {
			$selectData[$res['materia']] = $res['materia'];
		}
		return $selectData;

	}
	
	public function getAsignaturas()
	{
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// recatar su cedula
		$dbAdapter = $this->sapientiaDbAdapter;
		$sql       = 'SELECT m.nombre FROM materias AS m INNER JOIN cursos AS c ON m.materia = c.materia
				INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso AND axc.numero_de_documento = 4490334 AND c.anho = 2014 AND c.semestre_anho = 1';
		//$usuarioLogueado
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();
	
		$selectData = array();
	
		foreach ($result as $res) {
			$selectData[$res['nombre']] = $res['nombre'];
		}
		return $selectData;
	
	}
	

	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}