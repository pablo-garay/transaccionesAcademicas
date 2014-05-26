<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudRupturaCorrelatividad extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudRupturaCorrelatividad', $dbadapter);
	
		$this->setAttribute('method', 'post');
	
		$this->add(array(
				'name' => 'semestre',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre ',
						'empty_option' => 'Seleccione su semestre..',
						'value_options' => array('1'=>'1')//$this->getSubjectsOfCareer(),
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
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => array('2'=>'2')//$this->getSubjectsOfCareer(),
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
				'name' => 'semestre_asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre de Asignatura ',
						'empty_option' => 'Seleccione su semestre..',
						'value_options' => array('7'=>'7')//$this->getSubjectsOfCareer(),
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
				'name' => 'prerrequisito',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura Prerrequisito ',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => array('7'=>'7')//$this->getSubjectsOfCareer(),
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
				'name' => 'semestre_prerrequisito',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre de Asignatura Prerrequisito ',
						'empty_option' => 'Seleccione su semestre..',
						'value_options' => array('7'=>'7')//$this->getSubjectsOfCareer(),
				),
				'attributes' => array(
						'required' => 'required',
				),
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
                    'name' => 'semestre',
                    'filters' => array(
                            array ( 'name' => 'digits' ),
    
                    ),
                    'validators' => array (
                            array (
                                    'name' => 'digits',
                                    'options' => array (
                                            'messages' => array(
                                    						'notDigits' => 'Solo especifique en números',	
                                    		),
                                    )
                            ),
                    )
            )));
			
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
									'name' => 'notEmpty',
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
					'name' => 'semestre_asignatura',
					'filters' => array(
							array ( 'name' => 'digits' ),
			
					),
					'validators' => array (
							array (
									'name' => 'digits',
									'options' => array (
											'messages' => array(
													'notDigits' => 'Solo especifique en números',
											),
									)
							),
					)
			)));
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'prerrequisito',
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
					'name' => 'semestre_prerrequisito',
					'filters' => array(
							array ( 'name' => 'digits' ),
								
					),
					'validators' => array (
							array (
									'name' => 'digits',
									'options' => array (
											'messages' => array(
													'notDigits' => 'Solo especifique en números',
											),
									)
							),
					)
			)));
			

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
	
	public function getPrerrequisitoDeMateria()
	{
		//@todo: Rescatar los asignaturas según la carrera elegida en el combo
		$carreraElegida = $this->get('carrera')->getAttribute('value');
	
	}
	

	

	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}