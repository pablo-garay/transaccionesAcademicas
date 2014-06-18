<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
use User\Controller\AccountController;
use Solicitud\Model\FuncionesDB as FuncionesDB;

/* Solicitud de Solicitud de Tesis, que hereda de la clase Solicitud */
class SolicitudTesis extends Solicitud
{
	//parámetros del constructor: adaptadores de la base de datos, y el identificador del usuario logueado
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		// Le pasamos los respectivos parámetros al constructor del padre
		parent::__construct($name = 'solicitudTesis', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
	
		
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////

		$usuarioLogueado = $idUsuario;
		$funcionesDB = new FuncionesDB();
		$datos = $funcionesDB->getDatosUsuario($dbadapter, $usuarioLogueado);
		$numeroDocumento = $datos['numero_de_documento'];
		
		//BD sapientia
		
		$sql = "SELECT m.materia, m.nombre AS n_materia, p.profesor , p.nombre AS n_profesor FROM materias AS m INNER JOIN cursos AS c ON m.materia = c.materia
		INNER JOIN materias_por_carrera AS mxc ON mxc.materia = m.materia INNER JOIN carreras AS carr ON mxc.carrera = carr.carrera
		AND carr.nombre = 'Análisis de Sistemas' INNER JOIN profesores_por_curso AS pxc ON  pxc.curso = c.curso  INNER JOIN profesores AS p ON pxc.profesor = p.profesor";


		$statement = $sapientiaDbadapter->query($sql);
		$result    = $statement->execute();
		
		
		$selectDataProf = array();
		foreach ($result as $res) {
			$selectDataProf[$res['n_profesor']] = $res['n_profesor'];
				
		}
		
		$sql = "SELECT u.numero_de_documento, u.nombres, u.apellidos
				FROM usuarios AS u";
		
		$statement = $dbadapter->query($sql);
		$result    = $statement->execute();

		
		$selectDataAlumnos = array();
		
		foreach ($result as $res) {
			$selectDataAlumnos[$res['numero_de_documento']] = $res['nombres']." ".$res['apellidos'];
				
		}
		//////////////////////***********FIN Extracción de Datos**************/////////////////
				
		/* A partir de aquí agregamos los elementos particulares a esta solicitud */
		
		$this->add(array(
				'name' => 'tema_tesis',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Tema de Tesis ',			
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'tema_tesis',
						'placeholder' => 'Escriba el tema propuesto...',
				),
		),
				array (
						'priority' => 290,
				)
				);
		
		
		$this->add(array(
				'name' => 'integrante1',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Integrante 1:',
				),
				'attributes' => array(
						'placeholder' => 'Escriba el integrante 1...',
					
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		$this->add(array(
				'name' => 'integrante2',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Integrante 2:',
				),
				'attributes' => array(
						'placeholder' => 'Escriba el integrante 2...',
				),
		),
				array (
						'priority' => 270,
				)
		);
		//'placeholder' => 'Agregue la descripción del documento adjunto aquí...',
		$this->add(array(
				'name' => 'integrante3',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Integrante 3:',
				),		
				'attributes' => array(
						'placeholder' => 'Escriba el integrante 3...',
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		$this->add(array(
				'name' => 'profesor',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Profesor:',
						'empty_option' => 'Elija Tutor..',
						'value_options' => $selectDataProf,
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'profesor',
				),	
		),
				array (
						'priority' => 270,
				)
		);
	

	
		$this->add(array(
				'name' => 'tipo',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Documento Adjunto',
						'value_options' => array(
								'Descripción de Tema de Tesis' => 'Descripción de Tema de Tesis',
								'Otro' => 'Otro'
						),
				),
	
		),
				array (
						'priority' => 240,
				)
						);
	
		$this->add(array(
				'name' => 'descripcion',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						//'label' => 'Especificación de documento adjunto'
				),
				'attributes' => array(
						'placeholder' => 'Agregue la descripción del documento adjunto aquí...',
						'required' => false,
						'id' => 'descripcion',
				)
		),
				array (
						'priority' => 230,
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
					'name' => 'tema_tesis',
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
					'name' => 'integrante1',
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
					'name' => 'integrante2',
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
					'name' => 'integrante3',
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
									'options' => array (
											'messages' => array (
													'isEmpty' => 'El Profesor es requerido'
											),
											'allowWhiteSpace' => true,
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
					'name' => 'tipo',
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
					'name' => 'descripcion',
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