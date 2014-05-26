<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudCreditos extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudCreditos', $dbadapter);
	
		$this->setAttribute('method', 'post');
	
		$this->add(array(
				'name' => 'tipo_actividad',
				'type' => 'Zend\Form\Element\Select',
				'attributes' => array(
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Tipo de actividad',
						'empty_option' => 'Seleccione una actividad ',
						'value_options' => array('Materias'=>'Materias',
								'Cursos' => 'Cursos',
								' ' => ' ')//$this->getSubjectsOfCareer(),
				),
		
		),
				array (
						'priority' => 290,
				)
		);
		
		
		$this->add(array(
				'name' => 'fecha_inicio',
				'type' => 'Zend\Form\Element\Date',
				'attributes' => array(
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Fecha de Inicio de la Actividad',
				),
		),
				array (
						'priority' => 280,
				)
		);
		
		
		$this->add(array(
				'name' => 'fecha_fin',
				'type' => 'Zend\Form\Element\Date',
				'attributes' => array(
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Fecha de Fin de la Actividad',
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		
		$this->add ( array (
				'name' => 'descripcion_actividades',
				'type' => 'Zend\Form\Element\Textarea',
				'attributes' => array (
						'placeholder' => 'Describa la actividad realizada...',
						'required' => 'required',
				),
				'options' => array (
						'label' => 'Descripción de la Actividad'
				)
		),
				array (
						'priority' => 260,
		) );	

	
	
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
					'name' => 'tipo_actividad',
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
					'name' => 'fecha_inicio',
					'validators' => array (
							array (
									'name' => 'Date',
							),
					)
			) ) );
			
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'fecha_fin',
					'validators' => array (
							array (
									'name' => 'Date',
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
			
			
			
			//@todo verificar, validar fechas no sean futuro
			
	
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
	
	public function getFechaDeExamen()
	{
		//@todo: Rescatar fecha de examen
	}
	
	

	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}