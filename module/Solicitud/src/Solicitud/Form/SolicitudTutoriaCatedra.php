<?php
namespace Solicitud\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

class SolicitudTutoriaCatedra extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudTutoriaCatedra', $dbadapter);
	
		$this->setAttribute('method', 'post');

		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => array(
												'Asignatura0'=>'Asignatura0'
											)
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
				'name' => 'profesor',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Profesor:',
						'empty_option' => 'Elija un Profesor..',
						'value_options' => array(
								'Profesor1' => 'Profesor1',
								'Profesor2' => 'Profesor2'
						),
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
				'type' => 'Zend\Form\Element\Radio',
				'name' => 'motivo',
				'options' => array(
						'label' => 'Motivo',
						'value_options' => array(
								'Créditos' => 'Créditos',
								'Experiencia' => 'Experiencia',
								'Trabajo' => 'Trabajo',
								'Otro' => 'Otro'
						),
				),
				'attributes' => array(
						'required' => 'required',
				),	
		),
				array (
						'priority' => 260,
				)
						);
	
		$this->add(array(
				'name' => 'especificacion_motivo',
				'type' => 'Zend\Form\Element\Textarea',
				'options' => array(
						'label' => 'Especificación de motivo'
				),
				'attributes' => array(
						'placeholder' => 'Agregue alguna información adicional aquí...',
						'required' => false,
						'disabled' => false //@todo: getCheckOption from motivo, si se eligió otros, entonces habilitar especificación
				)
		),
				array (
						'priority' => 250,
				)
				);
	
		$this->add(array(
				'name' => 'tipo', // de la tabla documentos adjuntos
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Documento Adjunto',
						'value_options' => array(
								'Autorización Profesor' => 'Autorización Profesor',
								'Otro' => 'Otro'
						),
				),
				'attributes' => array(
						'required' => 'required',
				),
	
		),
				array (
						'priority' => 240,
				)
						);
	
		$this->add(array(
				'name' => 'especificacion_adjunto', //de la tabla documentos adjuntos
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
							)
					)
			) ) );
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'motivo',
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
					'name' => 'especificacion_motivo',
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
	
	public function getOptionsForSelect()
	{
		$dbAdapter = $this->adapter;
		$sql       = 'SELECT usuario,nombres FROM usuarios';
	
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();
	
		$selectData = array();
	
		foreach ($result as $res) {
			$selectData[$res['usuario']] = $res['nombres'];
		}
		return $selectData;
	}
	
	
	public function getAsignaturasDeCarrera()
	{
		//@todo: Rescatar los asignaturas según la carrera elegida en el combo
		$carreraElegida = $this->get('carrera')->getAttribute('value');
	
	}
	
	public function getProfesoresDeAsignatura()
	{
		//@todo: Rescatar profesores titulares según la asignatura elegida
	}
	

	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}