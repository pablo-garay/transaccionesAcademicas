<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once 'funcionesDB.php';
class SolicitudRevisionEscolaridad extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudRevisionEscolaridad', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////
			//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su numero_de_documento
		$usuarioLogueado = $idUsuario;
		
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$numeroDocumento = $datos['numero_de_documento'];

		$datosAlumno = getMateriasYProfesoresUsuario($sapientiaDbadapter, $numeroDocumento, $actual=TRUE);
		$selectDataMat = $datosAlumno['materias'] ;
		
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => $selectDataMat,
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'asignatura',
				),	
		),
				array (
						'priority' => 290,
				)
		);
		
		
		$this->add(array(
				'name' => 'seccion',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Sección:',
						'empty_option' => 'Seleccione la sección..',
						'value_options' => array("A" => "A", "B" => "B", "C" => "C", "D" => "D"),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'seccion',
		
				),
		),
		
				array (
						'priority' => 290,
				)
		);
		
		$this->add(array(
				'name' => 'semestre_anho',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre año:',
						'empty_option' => 'Seleccione la semestre anho..',
						'value_options' => array("1" => "1", "2" => "2"),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'semestre_anho',
				),
		),
		
				array (
						'priority' => 290,
				)
		);
		
		$this->add(array(
				'name' => 'anho',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Año:',
						'empty_option' => 'Introduzca el año..',
						'value_options' => array("2005" => "2005", "2006" => "2006", "2007" => "2007",
												"2008" => "2008", "2009" => "2009", "2010" => "2010",
												"2011" => "2011", "2012" => "2012", "2013" => "2013", "2014" => "2014"),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'anho',
				),
		),
		
				array (
						'priority' => 290,
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
					'name' => 'seccion',
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
					'name' => 'semestre_anho',
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
					'name' => 'anho',
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
	
			$this->filter = $inputFilter;
		}
	
		return $this->filter;
	}
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}