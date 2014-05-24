<?php
namespace Solicitud\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudTraspasoPago extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudTraspasoPagoExamen', $dbadapter);
	
		$this->setAttribute('method', 'post');

		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => array('asign1'=>'asign1')//$this->getSubjectsOfCareer(),
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
				'name' => 'seccion',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Sección',
						
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
				'name' => 'oportunidad_pagada',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Oportunidad pagada',
						'value_options' => array(
								'1' => '1',
								'2' => '2',				
				),
				'attributes' => array(
						'required' => 'required',
				),
			),
		),
				array (
						'priority' => 270,
				)
		);
		
		
		$this->add(array(
				'name' => 'fecha_oportunidad_pagada',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Fecha de Oportunidad pagada',
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
						'priority' => 260,
				)
		);
	
		$this->add(array(
				'name' => 'oportunidad_a_pagar',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Oportunidad a pagar',
						'value_options' => array(
								'2' => '2',
								'3' => '3',
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
				'name' => 'fecha_oportunidad_a_pagar',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Fecha de Oportunidad a pagar',
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
					'name' => 'seccion',
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
					'name' => 'oportunidad_pagada',
					'validators' => array (
							array (
								'name' => 'between',
								'options' => array(
										'min' => 0,
										'max' => 3,
										'inclusive' => true
								)
							),
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'fecha_oportunidad_pagada',
					'validators' => array (
							array (
									'name' => 'Date',
							),						
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'oportunidad_a_pagar',
					'validators' => array (
							array (
									'name' => 'between',
									'options' => array(
											'min' => 1,
											'max' => 3,
											'inclusive' => true
									)
							),
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'fecha_oportunidad_a_pagar',
					'validators' => array (
							array (
									'name' => 'Date',
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