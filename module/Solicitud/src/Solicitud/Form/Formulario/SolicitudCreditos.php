<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;

/* Solicitud de Créditos, que hereda de la clase Solicitud */
class SolicitudCreditos extends Solicitud
{
	
	//parámetros del constructor: adaptadores de la base de datos, y el identificador del usuario logueado
	public function __construct(AdapterInterface $dbadapter, $idUsuario,  AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		// Le pasamos los respectivos parámetros al constructor del padre
		parent::__construct($name = 'solicitudCreditos', $dbadapter, $idUsuario, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');
	
		/* A partir de aquí agregamos los elementos particulares a esta solicitud */
		$this->add(array(
				'name' => 'tipo_actividad',
				'type' => 'Zend\Form\Element\Select',
				'attributes' => array(
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Tipo de actividad',
						'empty_option' => 'Seleccione una actividad ',
						'value_options' => array(
								'Materias' => 'Materias',
								'Ayudantía de Cátedra' => 'Ayudantía de Cátedra',
								'Cursos en la UC' => 'Cursos en la UC',
								'Seminario en la UC' => 'Seminario en la UC',
								'Trabajos en la UC' => 'Trabajos en la UC',
								'Actividades en la UC' => 'Actividades en la UC',
								'Cursos en otra Universidad' => 'Cursos en otra Universidad',
								'Seminario en otra Universidad' => 'Seminario en otra Universidad',
								'Trabajos en otra Universidad' => 'Trabajos en otra Universidad',
								'Actividades en otra Universidad' => 'Actividades otra Universidad',)
				),
		
		),
				array (
						'priority' => 290,
				)
		);
		
		
		$this->add(array(
				'name' => 'fecha_inicio',
				'type' => 'Zend\Form\Element\Date',
				'attributes' => array(
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Fecha de Inicio de la Actividad',
				),
		),
				array (
						'priority' => 280,
				)
		);
		
		
		$this->add(array(
				'name' => 'fecha_fin',
				'type' => 'Zend\Form\Element\Date',
				'attributes' => array(
						'required' => 'required',
				),
				'options' => array(
						'label' => 'Fecha de Fin de la Actividad',
				),
		),
				array (
						'priority' => 270,
				)
		);
		
		
		$this->add ( array (
				'name' => 'descripcion_actividades',
				'type' => 'Zend\Form\Element\Textarea',
				'attributes' => array (
						'placeholder' => 'Describa la actividad realizada...',
						'required' => 'required',
				),
				'options' => array (
						'label' => 'Descripción de la Actividad'
				)
		),
				array (
						'priority' => 260,
		) );	


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
					'name' => 'tipo_actividad',
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
					)
			) ) );
			
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'fecha_inicio',
					'validators' => array (
							array (
									'name' => 'Date',
							),
					)
			) ) );
			
			
			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'fecha_fin',
					'validators' => array (
							array (
									'name' => 'Date',
							),
					)
			) ) );				
	

			$inputFilter->add ( $factory->createInput ( array (
					'name' => 'descripcion_actividades',
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
					)
			) ) );
			
			
			
			//@todo verificar, validar fechas no sean futuro
			
	
			$this->filter = $inputFilter;
		}
	
		return $this->filter;
	}
	
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
	
}