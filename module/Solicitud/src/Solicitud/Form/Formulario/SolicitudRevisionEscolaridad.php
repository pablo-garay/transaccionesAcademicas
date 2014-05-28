<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once 'funcionesDB.php';
class SolicitudRevisionEscolaridad extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudRevisionEscolaridad', $dbadapter, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////
			//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su cedula
		$usuarioLogueado = 1;
		
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$cedulaUsuario = $datos['cedula'];

		$datosAlumno = getMateriasYProfesoresUsuario($sapientiaDbadapter, $cedulaUsuario, $actual=TRUE);
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
			
	
			$this->filter = $inputFilter;
		}
	
		return $this->filter;
	}
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}