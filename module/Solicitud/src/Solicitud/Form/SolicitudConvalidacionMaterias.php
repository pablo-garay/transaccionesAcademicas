<?php
namespace Solicitud\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudConvalidacionMaterias extends Form
{
	protected $dbAdapter;

	//parámetro del constructor: adaptador de la base de datos
	public function __construct( $name = 'solicitudConvalidacionMaterias', AdapterInterface $databaseAdapter) {
		$this->dbAdapter = $databaseAdapter; //Asignación de nuestro adaptador de base de datos
		parent::__construct($name);

		$this->setAttribute('method', 'post');

       // Asi es como definimos un elemento (en este caso tipo texto)
        $this->add(array(
        		'name' => 'nombres',// the unique name of the element in the form.
                                	//Ex: <input name="..."
        		'type' => 'Zend\Form\Element\Text',
        		// The above must be valid Zend Form element.
        		// You can also use short names as “Text” instead of “Zend\Form\Element\Text
        		'attributes' => array(
        		// These are the attributes that are passed directly to the HTML element
        				'placeholder' => 'Escriba su nombre...', // HTM5 placeholder attribute
        				'required' => 'required' // Ex: <input required="true"
        				
        		),
        		'options' => array(
        				// This is list of options that we can add to the element.
        				'label' => 'Nombres', // Label es la etiqueta que aparece antes del campo de formulario
        		),

        )
        , array (
        		'priority' => 700,
        ));

		$this->add ( array (
				'name' => 'apellidos',
				'type' => 'Zend\Form\Element\Text',
				'attributes' => array (
						'placeholder' => 'Escriba su apellido...',
						'required' => 'required'
						
				),
				'options' => array (
						'label' => 'Apellidos'
				)
		)
		, array (
				'priority' => 600,
        ) );

		$this->add(array(
				'name' => 'telefono',
				'options' => array(
						'label' => 'Teléfono'
				),
				'attributes' => array(
						// Below: HTML5 way to specify that the input will be phone number
						'type' => 'tel',
						'placeholder' => 'Escriba su teléfono...',
						'required' => 'required',
						// Below: HTML5 way to specify the allowed characters
						'pattern'  => '^[\d-/]+$'
				),
		), array (
				'priority' => 300,
		) );
        
        $this->add(array(
        		'name' => 'universidad_origen',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'placeholder' => 'Escriba el nombre la Universidad...', // HTM5 placeholder attribute
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Universidad de origen ',
        
        		),
        
        ));
        
        $this->add(array(
        		'name' => 'direccion_universidad_origen',
        		'type' => 'Zend\Form\Element\Text',
        		'attributes' => array(
        				'placeholder' => 'Escriba la dirección...', // HTM5 placeholder attribute
        				'required' => 'required',
        		),
        		'options' => array(
        				'label' => 'Dirección de la Universidad de origen ',
        
        		),
        
        ));
        
        $this->add(array(
        		'name' => 'telefono_universidad_origen',
        		'options' => array(
        				'label' => 'Teléfono de la Universidad de origen'
        		),
        		'attributes' => array(
        				// Below: HTML5 way to specify that the input will be phone number
        				'type' => 'tel',
        				'placeholder' => 'Escriba el teléfono de su universidad de origen',
        				'required' => 'required',
        				// Below: HTML5 way to specify the allowed characters
        				'pattern'  => '^[\d-/]+$'
        		),
        ));
        
        // This is how we define the "email" element
        $this->add(array(
        		'name' => 'email_universidad_origen', // the unique name of the element in the form.
        		//Ex: <input name="..."
        		'type' => 'Zend\Form\Element\Email',
        		// The above must be valid Zend Form element.
        // You can also use short names as “email” instead of “Zend\Form\Element\Email
        		'options' => array(
        				// This is list of options that we can add to the element.
        				'label' => 'Email de la Universidad de origen'
        				// Label is the text that should who before the form field
        		),
        		'attributes' => array(
        				// These are the attributes that are passed directly to the HTML element
        				'type' => 'email', // Ex: <input type="email"
        				// 'required' => true, // Ex: <input required="true"
        				'placeholder' => 'Escriba dirección de email de la universidad de origen...', // HTM5 placeholder attribute
        		)
        ));       
        
        $this->add ( array (
        		'name' => 'carrera_cursada_universidad_origen',
        		'type' => 'Zend\Form\Element\Text',
        		'options' => array (
        				'label' => 'Carrera',
        				
        		),
        		'attributes' => array (
        				// Below: HTML5 way to specify that the input will be phone number
        				'placeholder' => 'Escriba la carrera cursada en la universidad de origen...',
        				'required' => 'required'
        		)
        ));
        
        $this->add(array(
        		'name' => 'enviar',
        		'type' => 'Zend\Form\Element\Submit',
        		'attributes' => array(
        				'value' => 'Enviar',
        				'required' => 'false',
        
        		),
        
        )
        		, array (
        				'priority' => 0,
        		)
        
        );
        
        $this->add(array(
        		'name' => 'cancelar',
        		'type' => 'Zend\Form\Element\Submit',
        		'attributes' => array(
        				'value' => 'Cancelar',
        				'required' => 'false',
        
        		),
        
        )
        		, array (
        				'priority' => 0,
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
					'name' => 'nombres',
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
													'isEmpty' => 'Nombre requerido'
											)
									)
							)
					)
			) ) );

			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'apellidos',
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
													'isEmpty' => 'Apellido requerido'
											)
									)
							)
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'telefono',
					'filters' => array(
							array ( 'name' => 'digits' ),
							array ( 'name' => 'stringtrim' ),
					),
					'validators' => array (
							array (
									'name' => 'regex',
									'options' => array (
											'pattern' => '/^[\d-\/]+$/',
									)
							),
					)
			)));
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'universidad_origen',
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
													'isEmpty' => 'Universidad de origen requerida'
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
					'name' => 'direccion_universidad_origen',
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
													'isEmpty' => 'Direccion de universidad de origen requerida'
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
					'name' => 'telefono_universidad_origen',
					'filters' => array(
							array ( 'name' => 'digits' ),
							array ( 'name' => 'stringtrim' ),
					),
					'validators' => array (
							array (
									'name' => 'regex',
									'options' => array (
											'pattern' => '/^[\d-\/]+$/',
									)
							),
					)
			)));
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'email_universidad_origen',
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
									'name' => 'EmailAddress',
									'options' => array (
											'messages' => array (
													'emailAddressInvalidFormat' => 'Dirección de email no válida'
											)
									)
							),
							array (
									'name' => 'NotEmpty',
									'options' => array (
											'messages' => array (
													'isEmpty' => 'Se requiere email'
											)
									)
							)
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'carrera_cursada_universidad_origen',
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

	public function getNombres()
	{
		//@todo: Rescatar los datos de usuario según el usuario de la sesión actual

		$sql       = 'SELECT usuario, nombres FROM usuarios LIMIT 1';

		$statement = $this->dbAdapter->query($sql);
		$result    = $statement->execute();

		$selectData = array();

		foreach ($result as $res) {
			// retornar nombre del usuario
			return $res['nombres'];
		}

		return FALSE; // no se encontraron resultados
	}

	public function getApellidos()
	{
		//@todo: Rescatar los datos de usuario según el usuario de la sesión actual

		$sql       = 'SELECT usuario, apellidos FROM usuarios ORDER BY usuario DESC LIMIT 1';

		$statement = $this->dbAdapter->query($sql);
		$result    = $statement->execute();

		$selectData = array();

		foreach ($result as $res) {
			// retornar nombre del usuario
			return $res['apellidos'];
		}

		return FALSE; // no se encontraron resultados
	}

	public function getMatricula()
	{
		//@todo: Rescatar los datos de usuario según el usuario de la sesión actual

		$sql       = 'SELECT usuario, telefono FROM usuarios';

		$statement = $this->dbAdapter->query($sql);
		$result    = $statement->execute();

		$selectData = array();

		foreach ($result as $res) {
			$selectData[$res['telefono']] = $res['telefono'];
		}
			return array("061039" => "061039");
	}

	public function getTelefono()
	{
		//@todo: Rescatar los datos de usuario según el usuario de la sesión actual

		$sql       = 'SELECT usuario, telefono FROM usuarios';

		$statement = $this->dbAdapter->query($sql);
		$result    = $statement->execute();

		$selectData = array();

		foreach ($result as $res) {
			return $res['telefono'];
		}
		return FALSE;
	}

	public function getCarrera()
	{
		//@todo: Rescatar los datos de usuario según el usuario de la sesión actual

		$sql       = 'SELECT usuario, telefono FROM usuarios';

		$statement = $this->dbAdapter->query($sql);
		$result    = $statement->execute();

		$selectData = array();

		foreach ($result as $res) {
			$selectData[$res['telefono']] = $res['telefono'];
		}
		return array("Ingeniería Informática" => "Ingeniería Informática");;
	}


}
