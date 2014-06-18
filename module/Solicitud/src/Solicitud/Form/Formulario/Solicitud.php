<?php
namespace Solicitud\Form\Formulario;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
use Solicitud\Sapientia\SapientiaClient as SapientiaClient;
use Solicitud\Model\FuncionesDB as FuncionesDB;
use Solicitud\Controller\FormularioController as CancelarAction;;

// adaptador de sapientia
use Solicitud\Service\Factory\SapientiaDatabase as SapientiaDBAdapter;

use Zend\ServiceManager\ServiceLocatorInterface;
//require_once 'funcionesDB.php';
//require_once 'SapientiaClient.php';

/*
 * La clase Solicitud es padre de casi todas las solicitudes específicas (la solicitud de 
 * convalidación de materias es la única que no hereda de Solicitud), es decir todas las
 * solicitudes heredan de esta clase, en la misma se encuentran datos comunes como nombres,
 * apellidos, teléfono, matricula, carrera.*/
class Solicitud extends Form
{
	protected $dbAdapter;          // Declaramos variables que contendrán adaptadores de las BD.
	protected $sapientiaDbAdapter; /* El adaptador de la BD de "sapientia" habíamos utilizado 
	para la extracción de datos que se necesitan a lo largo del proceso de elaboración de una 
	solicitud, pero posteriormente esta extracción directa la hemos cambiado a servicios, de
	manera que todos los datos que provee realmente sapientia lo simulemos a través de los 
	servicios.
	*/

	//parámetros del constructor: nombre de la solicitud, adaptador de la base de datos, identificador de usuario logueado, adaptador de sapientia 
	public function __construct( $name = 'solicitud', AdapterInterface $databaseAdapter, $idUsuario, AdapterInterface $sapientiaDbAdapter) {
		
		$this->dbAdapter = $databaseAdapter; //Asignación de nuestro adaptador de base de datos
		$this->sapientiaDbAdapter = $sapientiaDbAdapter; //Asignación del adaptador de Sapientia de base de datos
		
		parent::__construct($name);

		$this->setAttribute('method', 'post');
		
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////		
		
		$usuarioLogueado = $idUsuario;
		
		$funcionesDB = new FuncionesDB();
		$datos = $funcionesDB->getDatosUsuario ($databaseAdapter, $usuarioLogueado);
		
		$nombresUsuario = $datos['nombres'];
		$apellidosUsuario = $datos['apellidos'];
		$telefonoUsuario = $datos['telefono'];
		$numeroDocumentoUsuario = $datos['numero_de_documento'];
		$emailUsuario = $datos['email'];
		
		/*VERIFICACIÓN de si el usuario es un alumno o sólo un guest, esto se hace,
		 * para el caso de solicitudes varias, la cual puede ser realizada tanto por 
		 * un usuario alumno como un usuario guest*/
		
		$sqlGuest = "SELECT role_id FROM user_role_linker WHERE user_id =".$usuarioLogueado;
		$statement = $databaseAdapter->query($sqlGuest);
		$result    = $statement->execute(); // Extraemos el rol del usuario
		$guest = 2;				// numero identificador de usuario guest
		$user = null;
		foreach ($result as $res) {
			$user =$res['role_id'];   // Guardamos la información acerca del rol del usuario
		} 
		
		// Sapientia
		$sapientiaClient = new SapientiaClient();

		$resultMatCarr = $sapientiaClient->getMatriculaCarrera($numeroDocumentoUsuario);
		$selectDataMat = array();
		$selectDataCarr = array();
		
		if ($user == $guest){ //Aquí es donde preguntamos si el usuario loqueado es sólo un guest 
			$selectDataMat['00000'] = 00000;  			// El guest no tiene matrícula...
			$selectDataCarr['ninguna'] = 'ninguna' ;  	// Y por ende tampoco una carrera
				
		}else{  // Si no es un guest, debe ser un alumno
			foreach ($resultMatCarr as $res) {
				$selectDataMat[$res['matricula']] = $res['matricula'];
				$selectDataCarr[$res['n_carrera']] = $res['n_carrera'] ;
			
			}
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
						'value_options' => $selectDataCarr,
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
        				'id' => 'enviar',
        				'onclick' => 'return confirm("¿Está seguro de enviar la solicitud?");',		
        
        		),
        		
        )
        		, array (
        				'priority' => 0,
        		)
        		
        		);
        
        // rescatamos la url que necesitamos para redireccionar en caso de que se cancele la solicitud
        $baseUrl    =    sprintf("http://%s/user",$_SERVER['HTTP_HOST']);
        
        $this->add(array(
        		'name' => 'cancelar',
        		'type' => 'Zend\Form\Element\Button',
        		'options' => array (
        				'label' => 'Cancelar',
        			
        		),
        		'attributes' => array(
        				
        				'onclick' => 'window.alert("Ha decidido cancelar el envío de la solicitud");
        							  window.location.replace("'.$baseUrl.'");',
        				
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
	public function cancelarSolcitud(){
		$cancelar = new CancelarAction();
		$cancelar->cancelar();
	}

/* Filters y Validators para cada elemento añadido al formulario */
	public function getInputFilter() 	
	{
		if (! $this->filter) {
			$inputFilter = new InputFilter();
			$factory = new InputFactory ();

			/* Por ejemplo aquí se asignan los filters y validators para el elemento nombres */
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