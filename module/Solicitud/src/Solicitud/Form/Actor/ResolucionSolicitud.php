<?php
namespace Solicitud\Form\Actor;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;


class ResolucionSolicitud extends Form
{

	protected $adapter;
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		$this->adapter = $dbadapter; //Asignación de nuestro adaptador de base de datos
		parent::__construct('solicitud');

		$this->setAttribute('method', 'post');


		//This is the submit button
		$this->add(array(
				'name' => 'Imprimir',
				'type' => 'Zend\Form\Element\Submit',
				'attributes' => array(
						'value' => 'Imprimir',
						'required' => 'false',

				),
		),
				array (
						'priority' => 490,
				)
		);
		$this->add(array(
				'name' => 'Salir',
				'type' => 'Zend\Form\Element\Submit',
				'attributes' => array(
						'value' => 'Salir',
						'required' => 'false',

				),
		),
				array (
						'priority' => 480,
				)
		);

		// This is the special code that protects our form beign submitted from automated scripts
		$this->add(array(
				'name' => 'csrf',
				'type' => 'Zend\Form\Element\Csrf',
		));



	}

// 	public function getInputFilter()
// 	{
// 		if (! $this->filter) {
// 			$inputFilter = new InputFilter();
// 			$factory = new InputFactory ();


// 			// @todo: posiblemente agregar filtros a los demas campos

// 			$this->filter = $inputFilter;
// 		}

// 		return $this->filter;
// 	}


	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}

}
