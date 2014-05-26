<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudCertificadoEstudios extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudExtraordinario', $dbadapter);
	
		$this->setAttribute('method', 'post');
		
		
		$this->add ( array (
				'name' => 'carrera_cursada',
				'type' => 'Zend\Form\Element\Select',
				'options' => array (
						'label' => 'Carrera',
						'empty_option' => 'Elija su carrera',
						'value_options' => array(
								'Carrera1' => 'Carrera1',
								'Carrera2' => 'Carrera2',
								'Carrera3' => 'Carrera3',
								'Carrera4' => 'Carrera4',
						),
				),
				'attributes' => array (
						'placeholder' => 'Elija su carrera...',
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
	
	public function getOptionsForSelect()
	{
		$dbAdapter = $this->adapter;
		$sql       = 'SELECT usuario,nombres FROM usuarios';
	
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();
	
		$selectData = array();
	
		foreach ($result as $res) {
			$selectData[$res['usuario']] = $res['nombres'];
		}
		return $selectData;
	}
	
	
	public function getEmailDeUsuario()
	{
		//@todo: Rescatar email del usuario
	}
	
	
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}