<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once "funcionesDB.php";
class SolicitudInscripcionTardia extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudInscripcionTardia', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su numero_de_documento
		$usuarioLogueado = $idUsuario;
		
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$numeroDocumento = $datos['numero_de_documento'];
		
		
		
		$sql       = "SELECT m.materia, m.nombre AS n_materia, h.fecha_de_examen  FROM materias AS m
						INNER JOIN cursos AS c ON m.materia = c.materia
						INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso
						AND axc.numero_de_documento = ".$numeroDocumento." AND axc.curso_actual = TRUE
						INNER JOIN inscripcion_examen_por_alumno AS ie ON axc.curso = ie.curso
						INNER JOIN Horarios_de_examen AS h ON h.curso = ie.curso";
		
		//$usuarioLogueado
		$statement = $sapientiaDbadapter->query($sql);
		$result    = $statement->execute();
		
		$selectDataMat = array();
		$selectDataFech = array();
		foreach ($result as $res) {
			$selectDataMat[$res['n_materia']] = $res['n_materia'];
			$selectDataFech[$res['fecha_de_examen']] = $res['fecha_de_examen'];
		}
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
		
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						//'value_options' => $selectDataMat
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
				'name' => 'fecha_de_examen',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Fecha de Examen',
						//'value_options' =>$selectDataFech,
				),
				'attributes' => array(
						'value' =>  'dd/mm/aaaa',
						'required' => 'required',
						'id' => 'fecha_de_examen',
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
						'empty_option' => 'Elija una Oportunidad..',
// 						'value_options' => array(
// 								'1' => '1',
// 								'2' => '2',
// 								'3' => '3',
// 								'E' => 'Extraordinario'
// 						),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'oportunidad'
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		$this->add(array(
				'type' => 'Zend\Form\Element\Radio',
				'name' => 'motivo',
				'options' => array(
						'label' => 'Motivo',
						'value_options' => array(
								'Enfermedad' => 'Enfermedad',
								'Duelo' => 'Duelo',
								'Trabajo' => 'Trabajo',
								'Repitente' => 'Repitente',
								'Otro' => 'Otro'
						),
				),
				'attributes' => array(
						'required' => 'required',
				),
		),
				array (
						'priority' => 260,
				)
		);
		
		$this->add(array(
				'name' => 'especificacion_motivo',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Especificación de Motivo'
				),
				'attributes' => array(
						'placeholder' => 'Agregue alguna información adicional aquí...',
						'required' => 'required',
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
									'name' => 'notEmpty',
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
					'name' => 'fecha_de_examen',
					'validators' => array (
							array (
									'name' => 'Date',
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
					'name' => 'motivo',
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
					'name' => 'especificacion_motivo',
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

			// @todo: validar fecha no pase dia actual
	
			$this->filter = $inputFilter;
		}
	
		return $this->filter;
	}
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}