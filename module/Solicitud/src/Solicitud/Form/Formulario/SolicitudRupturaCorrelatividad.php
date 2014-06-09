<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudRupturaCorrelatividad extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, $idUsuario, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudRupturaCorrelatividad', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
		
		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		
		//BD sapientia
		
// 		$sql       = "Select m.nombre AS n_materia FROM materias AS m";
// 		//$usuarioLogueado
// 		$statement = $sapientiaDbadapter->query($sql);
// 		$result    = $statement->execute();
		
// 		$selectDataMat = array();
		
// 		foreach ($result as $res) {
// 			$selectDataMat[$res['n_materia']] = $res['n_materia'];		
// 		}
		//////////////////////***********FIN Extracción de Datos**************/////////////////
	
// 		$this->add(array(
// 				'name' => 'semestre',
// 				'type' => 'Zend\Form\Element\Select',
// 				'options' => array(
// 						'label' => 'Semestre ',
// 						'empty_option' => 'Seleccione su semestre carrera..',
// 						'value_options' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4',
// 									'5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
// 				),
// 				'attributes' => array(
// 						'required' => 'required',
// 				),
// 		),
// 				array (
// 						'priority' => 290,
// 				)
// 		);
		
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						//'value_options' => $selectDataMat,
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'asignatura',
				),
		),
				array (
						'priority' => 280,
				)
				);
	
		$this->add(array(
				'name' => 'semestre_asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre de Asignatura ',
						'empty_option' => 'Seleccione el semestre..',
						'value_options' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4',
									'5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'semestre_asignatura',
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		$this->add(array(
				'name' => 'prerrequisito1',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura Prerrequisito ',
 						'empty_option' => 'Seleccione el prerrequisito..',
						//'value_options' => $selectDataMat,
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'prerrequisito1',
				),
		),
				array (
						'priority' => 260,
				)
		);
		
		$this->add(array(
				'name' => 'semestre_prerrequisito1',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre de Asignatura Prerrequisito ',
						'empty_option' => 'Seleccione el semestre..',
						'value_options' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4',
									'5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
				),
				'attributes' => array(
						'required' => 'required',
						'id' => 'semestre_prerrequisito1',
				),
		),
				array (
						'priority' => 255,
				)
		);
	
		
		$this->add(array(
				'name' => 'prerrequisito2',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura Prerrequisito ',
						// 						'empty_option' => 'Seleccione el prerrequisito..',
						//'value_options' => $selectDataMat,
				),
				'attributes' => array(
						'id' => 'prerrequisito2',
				),
		),
				array (
						'priority' => 250,
				)
		);
		
		$this->add(array(
				'name' => 'semestre_prerrequisito2',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre de Asignatura Prerrequisito ',
						'empty_option' => 'Seleccione el semestre..',
						'value_options' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4',
								'5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
				),
				'attributes' => array(
						'id' => 'semestre_prerrequisito2',
				),
		),
				array (
						'priority' => 245,
				)
		);
		
		$this->add(array(
				'name' => 'prerrequisito3',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura Prerrequisito ',
						// 						'empty_option' => 'Seleccione el prerrequisito..',
						//'value_options' => $selectDataMat,
				),
				'attributes' => array(
						'id' => 'prerrequisito3',
				),
		),
				array (
						'priority' => 240,
				)
		);
		
		$this->add(array(
				'name' => 'semestre_prerrequisito3',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Semestre de Asignatura Prerrequisito ',
						'empty_option' => 'Seleccione el semestre..',
						'value_options' => array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4',
								'5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
				),
				'attributes' => array(
						'id' => 'semestre_prerrequisito3',
				),
		),
				array (
						'priority' => 235,
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
	
// 			$inputFilter->add ( $factory->createInput ( array (
//                     'name' => 'semestre',
//                     'filters' => array(
//                             array ( 'name' => 'digits' ),
    
//                     ),
//                     'validators' => array (
//                             array (
//                                     'name' => 'digits',
//                                     'options' => array (
//                                             'messages' => array(
//                                     						'notDigits' => 'Solo especifique en números',	
//                                     		),
//                                     )
//                             ),
//                     )
//             )));
			
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
									'name' => 'notEmpty',
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
					'name' => 'semestre_asignatura',
					'filters' => array(
							array ( 'name' => 'digits' ),
			
					),
					'validators' => array (
							array (
									'name' => 'digits',
									'options' => array (
											'messages' => array(
													'notDigits' => 'Solo especifique en números',
											),
									)
							),
					)
			)));
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'prerrequisito1',
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
					'name' => 'semestre_prerrequisito1',
					'filters' => array(
							array ( 'name' => 'digits' ),
								
					),
					'validators' => array (
							array (
									'name' => 'digits',
									'options' => array (
											'messages' => array(
													'notDigits' => 'Solo especifique en números',
											),
									)
							),
					)
			)));
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'prerrequisito2',
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
					'name' => 'semestre_prerrequisito2',
					'allow_empty' => true,
					'filters' => array(
							array ( 'name' => 'digits' ),
			
					),
					'validators' => array (
							array (
									'name' => 'digits',
									'options' => array (
											'messages' => array(
													'notDigits' => 'Solo especifique en números',
											),
									)
							),
					)
			)));
			
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'prerrequisito3',
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
					'name' => 'semestre_prerrequisito3',
					'allow_empty' => true,
					'filters' => array(
							array ( 'name' => 'digits' ),
			
					),
					'validators' => array (
							array (
									'name' => 'digits',
									'options' => array (
											'messages' => array(
													'notDigits' => 'Solo especifique en números',
											),
									)
							),
					)
			)));
			$this->filter = $inputFilter;
		}
	
		return $this->filter;
	}
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}