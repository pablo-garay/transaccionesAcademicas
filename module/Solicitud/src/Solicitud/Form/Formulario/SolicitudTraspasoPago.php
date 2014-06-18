<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;


/* Solicitud de Traspaso de Pago de Examen, que hereda de la clase Solicitud */
class SolicitudTraspasoPago extends Solicitud
{
	//parámetros del constructor: adaptadores de la base de datos, y el identificador del usuario logueado
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		// Le pasamos los respectivos parámetros al constructor del padre
		parent::__construct($name = 'solicitudTraspasoPagoExamen', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////

		$usuarioLogueado = $idUsuario;
		

		//////////////////////***********FIN Extracción de Datos**************/////////////////		
		
		/* A partir de aquí agregamos los elementos particulares a esta solicitud */
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura',
						'empty_option' => 'Seleccione una asignatura..',
						//'value_options' => $selectDataMat,
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'asignatura',
				),	
		),
				array (
						'priority' => 290,
				)
		);
	

	
		$this->add(array(
				'name' => 'seccion',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Sección: ',
						'empty_option' => 'Seleccione su sección..',
						'value_options' => array("A" => "A", "B" => "B", "C" => "C", "D"=>"D"),
						
						),
				'attributes' => array(
						'required' => 'required',
						'id' => 'seccion',
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
						'empty_option' => 'Seleccione la oportunidad..',
						'value_options' => array(
								'1' => '1',
								'2' => '2',				
 				),
				),
				'attributes' => array(
						'id' => 'oportunidad_pagada',
						'required' => 'required',
						
				),
			
		),
				array (
						'priority' => 270,
				)
		);
		
		
		$this->add(array(
				'name' => 'fecha_oportunidad_pagada',
				'type' => 'Zend\Form\Element\Date',
				'options' => array(
						'label' => 'Fecha de Oportunidad pagada',
						
						//'value_options' => $selectDataFech,							
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'fecha_oportunidad_pagada',
						'value' => 'aaaa/mm/dd',
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
						'empty_option' => 'Seleccione la oportunidad..',
						'value_options' => array(
								'2' => '2',
								'3' => '3',
						),		
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'oportunidad_a_pagar',
				),
			),
			array (
					'priority' => 250,
			)
		);
		
		
		$this->add(array(
				'name' => 'fecha_oportunidad_a_pagar',
				'type' => 'Zend\Form\Element\Date',
				'options' => array(
						'label' => 'Fecha de Oportunidad a pagar',
						//'value_options' => $selectDataFech,									
				),
				'attributes' => array(
						//'value' =>  'dd/mm/aaaa',
						'required' => 'required',
						'id' => 'fecha_oportunidad_a_pagar',
						'value' => 'aaaa/mm/dd',
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
	
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}