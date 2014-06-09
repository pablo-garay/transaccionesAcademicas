<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once "funcionesDB.php";


class SolicitudRevisionExamen extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudRevisionExamen', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su cedula
 		$usuarioLogueado = $idUsuario;
		
 		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
 		$numeroDocumento = $datos['numero_de_documento'];
		
		
		
		$sql       = "SELECT m.materia, m.nombre AS n_materia, p.nombre AS n_profesor, h.fecha_de_examen  FROM materias AS m
						INNER JOIN cursos AS c ON m.materia = c.materia
						INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso
						AND axc.numero_de_documento = ".$numeroDocumento." AND axc.curso_actual = TRUE
						INNER JOIN Horarios_de_examen AS h ON h.curso = axc.curso
						INNER JOIN profesores_por_curso AS pxc ON pxc.curso = axc.curso
						INNER JOIN profesores AS p ON p.profesor = pxc.profesor";
		
		//$usuarioLogueado
		$statement = $sapientiaDbadapter->query($sql);
		$result    = $statement->execute();
		
		$selectDataMat = array();
		$selectDataFech = array();
		$selectDataProf = array();
		
		foreach ($result as $res) {
			$selectDataMat[$res['n_materia']] = $res['n_materia'];
			$selectDataFech[$res['fecha_de_examen']] = $res['fecha_de_examen'];
			$selectDataProf[$res['n_profesor']] = $res['n_profesor'];
		}
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Elija una asignatura..',
						
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'asignatura',
				),
		),
				array (
						'priority' => 290,
				)
		);
		
		$this->add(array(
				'name' => 'seccion',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Sección:',
						'empty_option' => 'Seleccione la sección..',
						//'value_options' => array("A" => "A", "B" => "B", "C" => "C", "D" => "D"),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'seccion',
		
				),
		),
		
				array (
						'priority' => 290,
				)
		);
		
		$this->add(array(
				'name' => 'semestre_anho',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre año:',
						'empty_option' => 'Seleccione la semestre anho..',
						'value_options' => array("1" => "1", "2" => "2"),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'semestre_anho',
				),
		),
		
				array (
						'priority' => 290,
				)
		);
		
		$this->add(array(
				'name' => 'anho',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Año:',
						'empty_option' => 'Seleccione el año..',
						'value_options' => array("2005" => "2005", "2006" => "2006", "2007" => "2007",
								"2008" => "2008", "2009" => "2009", "2010" => "2010",
								"2011" => "2011", "2012" => "2012", "2013" => "2013", "2014" => "2014"),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'anho',
				),
		),
		
				array (
						'priority' => 290,
				)
		);

	
		$this->add(array(
				'name' => 'fecha_examen',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'empty_option' => 'Ingrese la fecha de examen',
						'label' => 'Fecha de Examen:',
						
				),
				
				'attributes' => array(
					'id' => 'fecha_examen',
					'required' => 'required',
						
					
				),
	
		),
				array (
						'priority' => 280,
				)
		);
		$this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'oportunidad',
				'options' => array(
						'label' => 'Oportunidad ',
						'empty_option' => 'Seleccione la oportunidad...',
						'value_options' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'E' => 'Extraordinario'
						),
				),
				'attributes' => array(
						'required' => 'required',
						'id'=>'oportunidad',
				),
		),
				array (
						'priority' => 275,
				)
		);
		$this->add(array(
				'name' => 'profesor',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Profesor:',
						'empty_option' => 'Elija el Profesor..',
						//'value_options' => $selectDataProf,
				),
				'attributes' => array(
					'required' => 'required',
					'id' => 'profesor',
				),
		),
				array (
						'priority' => 270,
				)
		);
	

		
		$this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'calificacion_previa',
				'options' => array(
						'label' => 'Calificación obtenida ',
						'value_options' => array(
								'0' => '1',
								'1' => '2',
								'2' => '3',
								'3' => '4',
								'4' => '5'
						),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'calificacion_previa',
				),
		),
				array (
						'priority' => 260,
				)
		);
	
		$this->add(array(
				'name' => 'motivo',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Motivo '
				),
				'attributes' => array(
						'placeholder' => 'Escriba el motivo de la solicitud aquí...',
						'required' => false,
						
				)
		),
				array (
						'priority' => 250,
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
					'name' => 'seccion',
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
					'name' => 'semestre_anho',
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
									'name' => 'Digits',
							)
					)
			) ) );
				
				
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'anho',
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
									'name' => 'Digits',
							)
					)
			
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'fecha_examen',
					'validators' => array (
							array (
									'name' => 'Date',
							),
					)
			) ) );
			
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
					'name' => 'oportunidad',
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
					'name' => 'calificacion_previa',
					'validators' => array (
							array (
									'name' => 'between',
									'options' => array(
											'min' => 0,
											'max' => 5,
											'inclusive' => true
									)
							),
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'motivo',
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

	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}