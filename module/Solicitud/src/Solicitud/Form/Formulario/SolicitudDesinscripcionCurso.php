<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;


/* Solicitud de Desinscripción de Curso, que hereda de la clase Solicitud */
class SolicitudDesinscripcionCurso extends Solicitud
{
	//parámetros del constructor: adaptadores de la base de datos, y el identificador del usuario logueado
	public function __construct(AdapterInterface $dbadapter, $idUsuario,  AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		// Le pasamos los respectivos parámetros al constructor del padre
		parent::__construct($name = 'solicitudDesinscripcionCurso', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////

		$usuarioLogueado = $idUsuario;
		
		$selectDataMat = array();
		
		//////////////////////***********FIN Extracción de Datos**************/////////////////
	
		/* A partir de aquí agregamos los elementos particulares a esta solicitud */
		$this->add(array(
				'name' => 'curso_completo',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Tipo de Desinscripción ',
						'value_options' => array(
								'Curso completo' => 'Curso completo',
								'Por asignatura' => 'Por asignatura'
						),
				),
				'attributes' => array(
								'id' => 'curso_completo',
					),
		),
				array (
						'priority' => 280,
				)
						);

		
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						//'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						//'value_options' => $selectDataMat,//$this->getSubjectsOfCareer(),
				),
				'attributes' => array(
							'id' => 'asignatura',
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		
		$this->add(array(
				'name' => 'cod_asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						//'label' => 'Código Asignatura:',
						'empty_option' => 'Elija el código de asignatura ',
						//'value_options' => $this->getCodigoDeAsignatura(),//$this->getSubjectsOfCareer(),
				),	
				'attributes' => array(
						'id' => 'cod_asignatura',
				),
		),
				array (
						'priority' => 260,
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
					'name' => 'curso_completo',
					'validators' => array (
							array (
									'name' => 'between',
									'options' => array(
											'min' => 0,
											'max' => 1,
											'inclusive' => true
									)
							),
					)
			) ) );
				
// 			$inputFilter->add ( $factory->createInput ( array (
// 					'name' => 'por_asignatura',
// 					'validators' => array (
// 							array (
// 									'name' => 'between',
// 									'options' => array(
// 											'min' => 0,
// 											'max' => 1,
// 											'inclusive' => true
// 									)
// 							),
// 					)
// 			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'cod_asignatura',
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
	
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'asignatura',
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
			

			$this->filter = $inputFilter;
		}
	
		return $this->filter;
	}

	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}