<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudHomologacionMaterias extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudHomologacionMaterias', $dbadapter);
	
		$this->setAttribute('method', 'post');

		$this->add(array(
				'name' => 'carrera_anterior',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Carrera a homologar ',
						'empty_option' => 'Seleccione una carrera..',
						'value_options' => array('Carrera3'=>'Carrera3')//$this->getSubjectsOfCareer(),
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
				'name' => 'plan_de_estudio_previo',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Plan de estudio de carrera a homologar ',
						'value_options' => array('1970'=>'1970'),
					
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
				'name' => 'documento_adjunto',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Documento Adjunto',
						'value_options' => array(
								'Certificado de Estudios' => 'Certificado de Estudios',
								'Otro' => 'Otro'
						),
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
					'name' => 'carrera_anterior',
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
					'name' => 'plan_de_estudio_previo',
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
					'name' => 'documento_adjunto',
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
	
	
	public function getAsignaturasDeCarrera()
	{
		//@todo: Rescatar los asignaturas según la carrera elegida en el combo
		$carreraElegida = $this->get('carrera')->getAttribute('value');
	
	}
	
	public function getProfesoresDeAsignatura()
	{
		//@todo: Rescatar profesores titulares según la asignatura elegida
	}
	
	public function getFechaDeExtraordinario()
	{
		//@todo: Rescatar los datos de usuario según la asignatura elegida
	}
	

	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}