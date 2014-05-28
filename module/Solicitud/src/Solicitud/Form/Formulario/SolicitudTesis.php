<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
use User\Controller\AccountController;

class SolicitudTesis extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudTesis', $dbadapter, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
	
		
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su cedula
		$usuarioLogueado = 1;
		
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$cedulaUsuario = $datos['cedula'];
		
		//BD sapientia
		
		$sql       = "SELECT m.materia, m.nombre AS n_materia, p.profesor , p.nombre AS n_profesor FROM materias AS m INNER JOIN cursos AS c ON m.materia = c.materia
				INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso AND axc.numero_de_documento = ".$cedulaUsuario." 
				INNER JOIN profesores_por_curso AS pxc ON  pxc.curso = c.curso  INNER JOIN profesores AS p ON pxc.profesor = p.profesor";


		$statement = $sapientiaDbadapter->query($sql);
		$result    = $statement->execute();
		
		
		$selectDataProf = array();
		foreach ($result as $res) {
			$selectDataProf[$res['n_profesor']] = $res['n_profesor'];
				
		}
		
		$sql = "SELECT a.cedula, u.nombres, u.apellidos
				FROM usuarios AS u 
				INNER JOIN alumnos AS a ON a.usuario = u.usuario";
		
		$statement = $dbadapter->query($sql);
		$result    = $statement->execute();

		
		$selectDataAlumnos = array();
		
		foreach ($result as $res) {
			$selectDataAlumnos[$res['cedula']] = $res['nombres']." ".$res['apellidos'];
				
		}
		//////////////////////***********FIN Extracción de Datos**************/////////////////
				
		
		$this->add(array(
				'name' => 'tema_tesis',
				'type' => 'Zend\Form\Element\Text',
				'options' => array(
						'label' => 'Tema de Tesis ',			
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
				'name' => 'cedula1',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Integrante1:',
						'empty_option' => 'Elija Integrante',
						'value_options' => $selectDataAlumnos,
				),
		
		),
				array (
						'priority' => 270,
				)
		);
		
		$this->add(array(
				'name' => 'cedula2',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Integrante 2:',
						'empty_option' => 'Elija Integrante',
						'value_options' => $selectDataAlumnos,
				),
		
		),
				array (
						'priority' => 270,
				)
		);
		
		$this->add(array(
				'name' => 'cedula3',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Integrante 3:',
						'empty_option' => 'Elija Integrante',
						'value_options' => $selectDataAlumnos,
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
				),	
		),
				array (
						'priority' => 270,
				)
		);
	

	
		$this->add(array(
				'name' => 'documento_adjunto',
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
				'name' => 'especificacion_adjunto',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Especificación de documento adjunto'
				),
				'attributes' => array(
						'placeholder' => 'Agregue la descripción del documento adjunto aquí...',
						'required' => false,
						'disabled' => false //@todo: getCheckOption from adjunto, si se eligió otro, entonces habilitar especificación
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
					'name' => 'integrante',
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
					'name' => 'documento_adjunto',
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
					'name' => 'especificacion_adjunto',
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