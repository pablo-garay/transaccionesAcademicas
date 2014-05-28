<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudesVarias extends Solicitud
{

	public function __construct(AdapterInterface $dbadapter, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos

		parent::__construct($name = 'solicitudesVarias', $dbadapter, $sapientiaDbadapter);

		$this->setAttribute('method', 'post');



		$this->add(array(
				'name' => 'asunto',
				'type' => 'Zend\Form\Element\Text',
				'attributes' => array(
						'placeholder' => 'Describa el asunto de la solicitud...', // HTM5 placeholder attribute
						'required' => 'required'
							),
				'options' => array(
						'label' => 'Asunto ',
						
				),

		), 
			array (
        		'priority' => 200,
        	)
				);

		$this->add(array(
				'name' => 'especificacion_motivo',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Solicito'
				),
				'attributes' => array(
						'placeholder' => 'Agregue alguna información adicional aquí...',
						'required' => false,
						'disabled' => false //@todo: getCheckOption from motivo, si se eligió otros, entonces habilitar especificación
				)
		), 
			array (
        		'priority' => 100,
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
			// DEBEMOS inicializar filter del padre
			$inputFilter = parent::getInputFilter();
			$factory = new InputFactory ();
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'asunto',
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
									'name' => 'notEmpty',
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