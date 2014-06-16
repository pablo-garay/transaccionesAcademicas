<?php
namespace Solicitud\Form\Lista;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;


class FiltrarSolicitud extends Form
{

	public function __construct() {
		
		parent::__construct('filtro');
		$this->setAttribute('method', 'get');

       // Asi es como definimos un elemento (en este caso tipo texto)
        $this->add(array(
        		'name' => 'filter',// the unique name of the element in the form.
                                	//Ex: <input name="..."
        		'type' => 'Zend\Form\Element\Text',
        		// The above must be valid Zend Form element.
        		// You can also use short names as “Text” instead of “Zend\Form\Element\Text
        		'attributes' => array(
        			'placeholder' => 'Ingrese término de búsqueda...', // HTM5 placeholder attribute
        		),
        ));
        
		$this->add(array(
				'name' => 'buscar',
				'type' => 'Zend\Form\Element\Submit',
				'attributes' => array(
						'value' => 'Buscar',
						'required' => 'false',
				),
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
