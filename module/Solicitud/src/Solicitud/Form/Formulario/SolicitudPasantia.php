<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudPasantia extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudPasantia', $dbadapter, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');

		$this->add(array(
				'name' => 'lugar',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Lugar de Pasantía',
						
				),
				'attributes' => array(
						'required' => 'required',
				),
	
		),
				array (
						'priority' => 290,
				)
				);
	
		$this->add(array(
				'name' => 'direccion',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Dirección',
						
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
        		'name' => 'correo_electronico',
        		'type' => 'Zend\Form\Element\Email',
        		'options' => array(
        				'label' => 'Email de empresa',
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
        		'name' => 'telefono',
        		'type' => 'Zend\Form\Element\Text',
        		'options' => array(
        				'label' => 'Teléfono del lugar',
        
        		),
        		'attributes' => array (
        				'required' => 'required',
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
						'label' => 'Especificación de Motivo'
				),
				'attributes' => array(
						'placeholder' => 'Agregue alguna información adicional aquí...',
						'required' => false,
						'disabled' => false //@todo: getCheckOption from motivo, si se eligió otros, entonces habilitar especificación
				)
		),
				array (
						'priority' => 250,
				)
				);
	
		$this->add(array(
				'name' => 'documento_adjunto',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Documento Adjunto',
						'value_options' => array(
								'Datos Adicionales de la Empresa' => 'Datos Adicionales de la Empresa',
								'Otro' => 'Otro'
						),
				),
				'attributes' => array(
						'required' => 'required',
				),	
		),
				array (
						'priority' => 240,
				)
						);
	
		$this->add(array(
				'name' => 'especificacion_adjunto',
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
					'name' => 'direccion',
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
					'name' => 'telefono',
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
					'name' => 'especificacion_adjunto',
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
