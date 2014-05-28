<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
use Solicitud\Form\FuncionesDatabase;
require_once "funcionesDB.php";

class SolicitudExtraordinario extends Solicitud
{

	public function __construct(AdapterInterface $dbadapter, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos

		parent::__construct($name = 'extraordinario', $dbadapter, $sapientiaDbadapter);

		$this->setAttribute('method', 'post');

		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////
			//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su cedula
		$usuarioLogueado = 1;
		
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$cedulaUsuario = $datos['cedula'];

		$datosAlumno = getMateriasYProfesoresUsuario($sapientiaDbadapter, $cedulaUsuario, TRUE);
		$selectDataMat = $datosAlumno['materias'] ;
		$selectDataProf = $datosAlumno['profesores'];
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
	
	
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => $selectDataMat,//$this->getSubjectsOfCareer(),
				),
				'attributes' => array(
						'required' => 'required',
				),
		),
				array (
						'priority' => 280,
				)
		);		

		$this->add(array(
				'name' => 'fecha_extraordinario',
				'type' => 'Zend\Form\Element\Date',
				'options' => array(
						'label' => 'Fecha de Examen:',
				),
				'attributes' => array(
						'required' => 'required',
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		$this->add(array(
				'name' => 'profesor',
				'id' => 'profe',
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
								'Trabajo' => 'Trabajo',
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
						'disabled' => false //@todo: getCheckOption from motivo, si se eligió otros, entonces habilitar especificación
				)
		)
				, array (
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
			// DEBEMOS inicializar filter del padre
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
					'name' => 'fecha_extraordinario',
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
					'name' => 'especificacion_motivo',
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



			// @todo: posiblemente agregar filtros a los demas campos

			$this->filter = $inputFilter;
		}


		return $this->filter;
	}




	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}


}