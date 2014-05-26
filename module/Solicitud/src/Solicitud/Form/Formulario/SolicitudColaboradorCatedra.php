<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudColaboradorCatedra extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudColaboradorCatedra', $dbadapter);
	
		$this->setAttribute('method', 'post');


	
		$this->add(array(
				'name' => 'profesor',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Profesor:',
						'empty_option' => 'Elija un Profesor..',
						'value_options' => array(
								'Profesor1' => 'Profesor1',
								'Profesor2' => 'Profesor2'
						),
				),
				'attributes' => array(
						'required' => 'required',
				),	
		),
				array (
						'priority' => 850,
				)
						);
		
	
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => array('Asignatura1'=>'Asignatura1')//$this->getSubjectsOfCareer(),
				),
				'attributes' => array(
						'required' => 'required',
				),
		),
				array (
						'priority' => 840,
				)
		);
		$this->add(array(
				'name' => 'carreras_profesor',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Carreras',
		
							
				),
				'attributes' => array(
						'value' =>  'Ingeniería Informática y Electrónica',
						'required' => 'required',
// 						'disabled' => 'disabled'
				),
		
		),
				array (
						'priority' => 830,
				)
		);
		
	
		$this->add(array(
				'name' => 'descripcion_actividades',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Descripción de actividades',

				),
				'attributes' => array(
						'required' => 'required',
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
			$inputFilter = parent::getInputFilter();
			$factory = new InputFactory ();
			
			
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
					'name' => 'carreras_profesor',
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
					'name' => 'descripcion_actividades',
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