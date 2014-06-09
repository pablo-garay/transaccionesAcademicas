<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once "funcionesDB.php";

class SolicitudCambioSeccion extends Solicitud
{

	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos

		parent::__construct($name = 'cambioSeccion', $dbadapter, $idUsuario, $sapientiaDbadapter);

		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////
			//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su numero_de_documento
		$usuarioLogueado = $idUsuario;
		
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$numeroDocumento = $datos['numero_de_documento'];

		$datosAlumno = getMateriasYProfesoresUsuario($sapientiaDbadapter, $numeroDocumento, TRUE);
		$selectDataMat = $datosAlumno['materias'] ;
		
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => $selectDataMat,
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'asignatura',
				),
		),
				array (
						'priority' => 350,
				)
				);
		
		$this->add(array(
				'name' => 'nueva_seccion_elegida',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Sección nueva: ',
						'empty_option' => 'Seleccione una sección..',
						'value_options' => array("A"=> "A", "B" => "B", "C" => "C", "D"=> "D"),
		
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'seccion',
				),
		),
				array (
						'priority' => 345,
				)
		);
		
// 		$this->add(array(
// 				'name' => 'materia_seccion_validas',
// 				'type' => 'Zend\Form\Element\Select',
// 				'options' => array(
// 						'label' => 'Asignatura:',
// 						'empty_option' => 'Seleccione una asignatura..',
// 						'value_options' => $this->getSecciones(),
// 				),
		
// 		),
// 				array (
// 						'priority' => 350,
// 				)
// 		);

		$this->add(array(
				'type' => 'Zend\Form\Element\Radio',
				'name' => 'motivo',
				'options' => array(
						'label' => 'Motivo',
						'value_options' => array(
								'Trabajo' => 'Trabajo',
								'Solapamiento de Horario' => 'Solapamiento de Horario',
								'Otro' => 'Otro'
						),
				),
				'attributes' => array(
						'required' => 'required',
				),
		
		),
				array (
						'priority' => 340,
				)
		);

		$this->add(array(
				'name' => 'especificacion_motivo',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Descripción de Motivo'
				),
				'attributes' => array(
						'placeholder' => 'Agregue alguna información adicional aquí...',
						'required' => false,
						'disabled' => false //@todo: getCheckOption from motivo, si se eligió otros, entonces habilitar especificación
				)
		),
				array (
						'priority' => 330,
				)
				);
		
		$this->add(array(
				'name' => 'Tipo',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Documento Adjunto',
						'value_options' => array(
								'Certificado de Trabajo' => 'Certificado de Trabajo',
								'Otro' => 'Otro'
						),
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

			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'nueva_seccion_elegida',
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