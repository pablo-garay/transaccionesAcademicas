<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;


/* Solicitud de Cambio de Sección, que hereda de la clase Solicitud */
class SolicitudCambioSeccion extends Solicitud
{
	//parámetros del constructor: adaptadores de la base de datos, y el identificador del usuario logueado
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { 
		
		// Le pasamos los respectivos parámetros al constructor del padre
		parent::__construct($name = 'cambioSeccion', $dbadapter, $idUsuario, $sapientiaDbadapter);

		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		$usuarioLogueado = $idUsuario;
		
		
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
		/* A partir de aquí agregamos los elementos particulares a esta solicitud */
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						//'value_options' => $selectDataMat,
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
						'id' => 'motivo',
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
						//'label' => 'Descripción de Motivo'
				),
				'attributes' => array(
						'placeholder' => 'Agregue alguna descripción del motivo...',
						'required' => false,
						'id' => 'especificacion_motivo',
				)
		),
				array (
						'priority' => 330,
				)
				);
		
		$this->add(array(
				'name' => 'tipo',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Documento Adjunto',
						'value_options' => array(
								'Certificado de Trabajo' => 'Certificado de Trabajo',
								'Otro' => 'Otro'
						),
				),
				'attributes' => array(
						'id' => 'tipo',
				),
		
		),
				array (
						'priority' => 240,
				)
		);
		
		$this->add(array(
				'name' => 'descripcion',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						//'label' => 'Especificación de documento adjunto'
				),
				'attributes' => array(
						'placeholder' => 'Agregue la descripción sobre el documento adjunto aquí...',
						//'required' => false,
						//'disabled' => false, //@todo: getCheckOption from adjunto, si se eligió otro, entonces habilitar especificación
						'id' => 'descripcion',
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
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'descripcion',
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
// 							array (
// 									'name' => 'alnum',
// 									'options' => array (
// 											'messages' => array (
// 													'notAlnum' => 'Se requieren sólo números y letras'
// 											),
// 											'allowWhiteSpace' => true,
// 									)
// 							),
								
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