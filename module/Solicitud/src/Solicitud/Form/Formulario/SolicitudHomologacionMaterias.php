<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
use Solicitud\Model\FuncionesDB as FuncionesDB;
use Solicitud\Sapientia\SapientiaClient as SapientiaClient;


/* Solicitud de Homologación de Materias, que hereda de la clase Solicitud */
class SolicitudHomologacionMaterias extends Solicitud
{
	//parámetros del constructor: adaptadores de la base de datos, y el identificador del usuario logueado
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		// Le pasamos los respectivos parámetros al constructor del padre
		parent::__construct($name = 'solicitudHomologacionMaterias', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		//////////////////////***********INICIO Extracción de Datos**************/////////////////

		$usuarioLogueado = $idUsuario;
		$funcionesDB = new FuncionesDB();
		$datos = $funcionesDB->getDatosUsuario($dbadapter, $usuarioLogueado);
		$numeroDocumento = $datos['numero_de_documento'];
		
		// Bd Sapientia
		
		$sql       = "SELECT  c.plan_de_estudio, c.nombre AS n_carrera  FROM carreras AS c";
						
		
		//$usuarioLogueado
		$statement = $sapientiaDbadapter->query($sql);
		$result    = $statement->execute();
		
	
		$selectDataCarr = array();
		$selectDataPlan = array();
		
		foreach ($result as $res) {
			$selectDataCarr[$res['n_carrera']] = $res['n_carrera'];
			$selectDataPlan[$res['plan_de_estudio']] = $res['plan_de_estudio'];
		}
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
		
		$this->setAttribute('method', 'post');
		
		/* A partir de aquí agregamos los elementos particulares a esta solicitud */
		$this->add(array(
				'name' => 'plan_de_estudio_previo',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Plan de estudio actual ',
						'value_options' => $selectDataPlan,
							
				),
				'attributes' => array(
						'required' => 'required',
				),
		),
				array (
						'priority' => 295,
				)
		);
		
		
		$this->add(array(
				'name' => 'carrera_anterior',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Carrera a homologar ',
						'empty_option' => 'Seleccione una carrera..',
						'value_options' => $selectDataCarr//$this->getSubjectsOfCareer(),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'carrera_anterior',
				),	
		),
				array (
						'priority' => 290,
				)
				);
	

		
		$this->add(array(
				'name' => 'plan_de_estudio_nuevo',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Plan de estudio de carrera a homologar ',
						'value_options' => $selectDataPlan,
							
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
				'name' => 'tipo',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Documento Adjunto',
						'value_options' => array(
								'Certificado de Estudios' => 'Certificado de Estudios',
								'Otros' => 'Otros'
						),
				'attributes' => array(
						'placeholder' => 'Agregue la descripción del documento adjunto aquí...',
						'id' => 'tipo',
				)
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
						//'label' => 'Especificación de documento adjunto'
				),
				'attributes' => array(
						'placeholder' => 'Agregue la descripción del documento adjunto aquí...',
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
					'name' => 'carrera_anterior',
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
					'name' => 'plan_de_estudio_previo',
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
					'name' => 'plan_de_estudio_nuevo',
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