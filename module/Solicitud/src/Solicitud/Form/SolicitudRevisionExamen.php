<?php
namespace Solicitud\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudRevisionExamen extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudRevisionExamen', $dbadapter);
	
		$this->setAttribute('method', 'post');

		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => array('A1'=>'A1')//$this->getSubjectsOfCareer(),
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
				'name' => 'fecha_examen',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Fecha de Examen:',
						'value_options' => array(
								'2014-05-21' => '2014-05-21',
						)					
				),
				'attributes' => array(
					'value' =>  'dd/mm/aaaa',
					'required' => 'required',
				),
	
		),
				array (
						'priority' => 280,
				)
		);
	
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
						'priority' => 270,
				)
		);
	
		$this->add(array(
				'type' => 'Zend\Form\Element\Select',
				'name' => 'oportunidad',
				'options' => array(
						'label' => 'Oportunidad ',
						'value_options' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'E' => 'Extraordinario'
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
				'type' => 'Zend\Form\Element\Select',
				'name' => 'calificacion_previa',
				'options' => array(
						'label' => 'Calificación obtenida ',
						'value_options' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
								'5' => '5'
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
				'name' => 'motivo',
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
					'name' => 'fecha_examen',
					'validators' => array (
							array (
									'name' => 'Date',
							),
					)
			) ) );
			
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
					'name' => 'oportunidad',
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
					'name' => 'calificacion_previa',
					'validators' => array (
							array (
									'name' => 'between',
									'options' => array(
											'min' => 0,
											'max' => 5,
											'inclusive' => true
									)
							),
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'motivo',
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