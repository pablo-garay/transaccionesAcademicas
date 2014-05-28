<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once "funcionesDB.php";

class SolicitudCambioSeccion extends Solicitud
{

	public function __construct(AdapterInterface $dbadapter, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos

		parent::__construct($name = 'cambioSeccion', $dbadapter, $sapientiaDbadapter);

		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////
			//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su cedula
		$usuarioLogueado = 1;
		
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$cedulaUsuario = $datos['cedula'];

		$datosAlumno = getMateriasYProfesoresUsuario($sapientiaDbadapter, $cedulaUsuario, TRUE);
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

		),
				array (
						'priority' => 350,
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
								'Otro' => 'Otro'
						),
				),
				'attributes' => array(
						// Below: HTML5 way to specify that the input will be phone number
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
						'label' => 'Especificación de Motivo'
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
								'Certificado Médico' => 'Certificado Médico',
								'Certificado de Trabajo' => 'Certificado de Trabajo',
								'Otro' => 'Otro'
						),
				),
		
		),
				array (
						'priority' => 240,
				)
		);
		
		$this->add(array(
				'name' => 'Descripcion',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Especificación de documento adjunto'
				),
				'attributes' => array(
						'placeholder' => 'Agregue la descripción del documento adjunto aquí...',
						'required' => false,
						'disabled' => false //@todo: getCheckOption from adjunto, si se eligió otro, entonces habilitar especificación
				)
		),
				array (
						'priority' => 230,
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