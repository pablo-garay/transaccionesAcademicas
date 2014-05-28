<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once "funcionesDB.php";


class SolicitudCertificadoEstudios extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudExtraordinario', $dbadapter, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		$usuarioLogueado = 1;
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
	
		$emailUsuario = $datos['email'];
		$cedulaUsuario = $datos['cedula'];
	
		
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
		
		$this->add(array(
				'name' => 'cedula',// the unique name of the element in the form.
				//Ex: <input name="..."
				'type' => 'Zend\Form\Element\Text',
				// The above must be valid Zend Form element.
				// You can also use short names as “Text” instead of “Zend\Form\Element\Text
				'attributes' => array(
						// These are the attributes that are passed directly to the HTML element
						'required' => 'required', // Ex: <input required="true"
						'value' => $cedulaUsuario,
						//'disabled' => 'disabled'
				),
				'options' => array(
						// This is list of options that we can add to the element.
						'label' => 'Cédula ', // Label es la etiqueta que aparece antes del campo de formulario
				),
		
		)
				, array (
						'priority' => 550,
				));
		
		$this->add(array(
				'name' => 'email',// the unique name of the element in the form.
				//Ex: <input name="..."
				'type' => 'Zend\Form\Element\Email',
				// The above must be valid Zend Form element.
				// You can also use short names as “Text” instead of “Zend\Form\Element\Text
				'attributes' => array(
						// These are the attributes that are passed directly to the HTML element
						'required' => 'required', // Ex: <input required="true"
						'value' => $emailUsuario,
						//'disabled' => 'disabled'
				),
				'options' => array(
						// This is list of options that we can add to the element.
						'label' => 'Email ', // Label es la etiqueta que aparece antes del campo de formulario
				),
		
		)
				, array (
						'priority' => 550,
				));
		
		
		// este campo de la base de datos debe ser llenado tambien con el campo carrera de la solicitud
		$this->add ( array (
				'name' => 'carrera_cursada',
				'type' => 'Zend\Form\Element\Hidden',
				'options' => array (
						
						
				),
				'attributes' => array (
						'placeholder' => 'Elija su carrera...',
						'value' => 'Carrera1',
						'required' => 'required'
				)
		), array (
				'priority' => 280,
		) );
	
		$this->add(array(
				'name' => 'tipo_de_certificado',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Tipo de certificado',
						'value_options' => array(
								'S' => 'Simple',
								'L' => 'Para Legalizar',

						),
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
				'name' => 'tipo_de_titulo',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Tipo de título',
						'value_options' => array(
								'Arquitecto' => 'Arquitecto',
								'Ingeniero' => 'Ingeniero',
								'Master' => 'Master',
								'Licenciado' => 'Licenciado',
								'Programador' => 'Programador',
								'Técnico' => 'Técnico',
								'Especialización' => 'Especialización',
								'Completo' => 'Completo',
								'Incompleto' => 'Incompleto',
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
				'type' => 'Zend\Form\Element\Radio',
				'name' => 'solicitud_anterior',
				'options' => array(
						'label' => 'Especifique',
						'value_options' => array(
								'0' => 'Si',
								'1' => 'No',
						),
				),
				'attributes' => array(
						'required' => 'required',
				),
	
		),
				array (
						'priority' => 250,
				)
		);
	
	
		$this->add(array(
				'name' => 'aclaraciones',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Observaciones'
				),
				'attributes' => array(
						'placeholder' => 'Agregue alguna aclaración aquí...',
						'required' => false,
				)
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
					'name' => 'cedula',
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
													'isEmpty' => 'Carrera requerida'
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
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'email',
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
													'emailAddressInvalidFormat' => 'Formato de email inválido'
											)
									)
							),
							array (
									'name' => 'NotEmpty',
									'options' => array (
											'messages' => array (
													'isEmpty' => 'El email es requerido'
											)
									)
							)
					)
			) ) );
				
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'carrera_cursada',
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
												'isEmpty' => 'Carrera requerida'
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
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'tipo_de_certificado',
					'filters' => array(
							array ( 'name' => 'stringtrim' ),
					),
					'validators' => array (
							array (
									'name' => 'regex',
									'options' => array (
											'pattern' => '/^L|S$/',
									)
							),
					)
			)));

			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'tipo_de_titulo',
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
					'name' => 'solicitud_anterior',
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
					'name' => 'aclaraciones',
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