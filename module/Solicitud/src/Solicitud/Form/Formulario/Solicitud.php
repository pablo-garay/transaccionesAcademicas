<?php
namespace Solicitud\Form\Formulario;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

// adaptador de sapientia
use Solicitud\Service\Factory\SapientiaDatabase as SapientiaDBAdapter;

use Zend\ServiceManager\ServiceLocatorInterface;
require_once 'funcionesDB.php';
require_once 'SapientiaClient.php';
class Solicitud extends Form
{
	protected $dbAdapter;
	protected $sapientiaDbAdapter;

	//parámetro del constructor: adaptador de la base de datos
	public function __construct( $name = 'solicitud', AdapterInterface $databaseAdapter, $idUsuario, AdapterInterface $sapientiaDbAdapter) {
		$this->dbAdapter = $databaseAdapter; //Asignación de nuestro adaptador de base de datos
		
		$this->sapientiaDbAdapter = $sapientiaDbAdapter; //Asignación de nuestro adaptador de base de datos
		
		parent::__construct($name);

		$this->setAttribute('method', 'post');
		
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////		
		
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		$usuarioLogueado = $idUsuario;
		$datos = getDatosUsuario ($databaseAdapter, $usuarioLogueado);
		
		$nombresUsuario = $datos['nombres'];
		$apellidosUsuario = $datos['apellidos'];
		$telefonoUsuario = $datos['telefono'];
		$numeroDocumentoUsuario = $datos['numero_de_documento'];
		$emailUsuario = $datos['email'];
		 	
		
		// Sapientia

		$resultMatCarr = getMatriculaCarrera($numeroDocumentoUsuario);
		$selectDataMat = array();
		$selectDataCarr = array();
		
		foreach ($resultMatCarr as $res) {
			// retornar nombre del usuario
			$selectDataMat[$res['matricula']] = $res['matricula'];
			$selectDataCarr[$res['n_carrera']] = $res['n_carrera'] ;
		}
		
		
		//////////////////////***********FIN Extracción de Datos**************/////////////////
       
       
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
        				'required' => 'required', // Ex: <input required="true"
        				'value' => $nombresUsuario,
        				'readonly' => 'true',
        				//'disabled' => 'disabled'
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
						'required' => 'required',
						'value' => $apellidosUsuario,
						'readonly' => 'true',
						//'disabled' => 'disabled'
				),
				'options' => array (
						'label' => 'Apellidos',
						
				)
		)
		, array (
				'priority' => 600,
        ) );

		$this->add(array(
				'name' => 'telefono',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Teléfono',
		
				),
				'attributes' => array (
						'value' => $telefonoUsuario, 
						'readonly' => 'true',
						//'disabled' => 'disabled'
				),
		
		), array (
				'priority' => 550,
		) );
		
        $this->add(array(
        		'name' => 'matricula',
        		'type' => 'Zend\Form\Element\Select',
        		'options' => array(
        				'label' => 'Matrícula',
        				'empty_option' => 'Elija su matricula',
        				'value_options' => $selectDataMat,
        		),
        		'attributes' => array(
        		        'placeholder' => 'Elija su matrícula...',
        				'required' => 'required',
        				'id' => 'matricula',
        				
        		),
        )
        , array (
        		'priority' => 500,
        ) );

		$this->add ( array (
				'name' => 'carrera',
				'type' => 'Zend\Form\Element\Select',
				'options' => array (
						'label' => 'Carrera',
						'empty_option' => 'Elija su carrera',
						//'value_options' => $selectDataCarr,
				),
				'attributes' => array (
						// Below: HTML5 way to specify that the input will be phone number
						'placeholder' => 'Elija su carrera...',
						'required' => 'required',
						'id' => 'carrera',
				)
		), array (
				'priority' => 400,
		) );

		
// 		$this->add(array(
// 				'name' => 'descripcion',
// 				'type' => 'Zend\Form\Element\Textarea',
// 				'options' => array(
// 						'label' => 'Especificación de documento adjunto'
// 				),
// 				'attributes' => array(
// 						'placeholder' => 'Agregue la descripción del documento adjunto aquí...',
// 						'required' => false,
// 						'id' => 'descripcion',
// 				)
// 		),
// 				array (
// 						'priority' => 230,
// 				)
// 		);
		
		


        //This is the submit button
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
        				'id' => 'cancelar'
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
			$inputFilter = new InputFilter();
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
					'name' => 'matricula',
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
									'name' => 'Digits',
							)
					)
			) ) );

			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'carrera',
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
			

			
// 			$inputFilter->add ( $factory->createInput ( array (
// 					'name' => 'descripcion',
// 					'allow_empty' => true,
// 					'filters' => array (
// 							array (
// 									'name' => 'StripTags'
// 							),
// 							array (
// 									'name' => 'StringTrim'
// 							)
// 					),
// 					'validators' => array (
// 							array (
// 									'name' => 'alnum',
// 									'options' => array (
// 											'messages' => array (
// 													'notAlnum' => 'Se requieren sólo números y letras'
// 											),
// 											'allowWhiteSpace' => true,
// 									)
// 							),
			
// 					)
						
// 			) ) );
				

			// @todo: posiblemente agregar filtros a los demas campos

			$this->filter = $inputFilter;
		}

		return $this->filter;
	}

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
	
	public function getDbAdapterSapientia()
	{
		//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
		$database = new SapientiaDBAdapter();
		//llamamos al metodo que nos devuelve el adaptador de bd
		$dbAdapter = $database->createService();
	
		return $dbAdapter;
	}

}