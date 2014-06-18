<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

/* Solicitud de Pasantía, que hereda de la clase Solicitud */
class SolicitudPasantia extends Solicitud
{
	//parámetros del constructor: adaptadores de la base de datos, y el identificador del usuario logueado
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		// Le pasamos los respectivos parámetros al constructor del padre
		parent::__construct($name = 'solicitudPasantia', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
		
		/* A partir de aquí agregamos los elementos particulares a esta solicitud */
		$this->add(array(
				'name' => 'lugar',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Lugar de Pasantía',
						
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'lugar',
						'placeholder' => 'Ingrese el nombre del lugar..',
				),
	
		),
				array (
						'priority' => 290,
				)
				);
	
		$this->add(array(
				'name' => 'direccion_lugar',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Dirección',
						
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'direccion',
						'placeholder' => 'Ingrese la dirección del lugar..',
				),	
		),
				array (
						'priority' => 280,
				)
				);
	
        $this->add(array(
        		'name' => 'correo_electronico',
        		'type' => 'Zend\Form\Element\Email',
        		'options' => array(
        				'label' => 'Email de empresa',
        		),
        		'attributes' => array(
        				'required' => 'required',
        				'id' => 'correo_electronico',
        				'placeholder' => 'Ingrese el email del lugar..',
        		),
        ),
        		array (
        				'priority' => 270,
        		)
        );
        
        $this->add(array(
        		'name' => 'telefono_lugar',
        		'type' => 'Zend\Form\Element\Text',
        		'options' => array(
        				'label' => 'Teléfono del lugar',
        
        		),
        		'attributes' => array (
        				'required' => 'required',
        				'id' => 'telefono',
        				'placeholder' => 'Ingrese el teléfono del lugar..',
        				//'value' => '0981334566', // @todo getphone
        		),
        
        ),
        		array (
        				'priority' => 265,
        		)
        );
	
		$this->add(array(
				'type' => 'Zend\Form\Element\Radio',
				'name' => 'motivo',
				'options' => array(
						'label' => 'Motivo',
						'value_options' => array(
								'Créditos' => 'Créditos',
								'Experiencia' => 'Experiencia',
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
						//'label' => 'Especificación de Motivo'
				),
				'attributes' => array(
						'placeholder' => 'Agregue alguna información adicional aquí...',
						'required' => false,
						'id' => 'especificacion_motivo',
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
					'name' => 'lugar',
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
									'options' => array (
											'messages' => array (
													'isEmpty' => 'Nombre de lugar requerido'
											)
									)
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
					'name' => 'direccion_lugar',
					'filters' => array(
							array ( 'name' => 'StripTags' ),
							array ( 'name' => 'StringTrim' ),
					),
					'validators' => array (
							array (
									'name' => 'NotEmpty',
							),
							array (
									// @validate que sea Alphanum
									'name' => 'alnum',
									'options' => array (
											'messages' => array (
													'notAlnum' => 'Se requieren sólo números y letras'
											),
											'allowWhiteSpace' => true,
									)
							),
					)
			)));
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'correo_electronico',
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
									'name' => 'EmailAddress',
									'options' => array (
											'messages' => array (
													'emailAddressInvalidFormat' => 'Dirección de email no válida'
											)
									)
							),
							array (
									'name' => 'NotEmpty',
									'options' => array (
											'messages' => array (
													'isEmpty' => 'Se requiere email'
											)
									)
							)
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'telefono_lugar',
					'filters' => array(
							array ( 'name' => 'digits' ),
							array ( 'name' => 'stringtrim' ),
					),
					'validators' => array (
							array (
									'name' => 'regex',
									'options' => array (
											'pattern' => '/^[\d-\/]+$/',
									)
							),
					)
			)));		
			
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
