<?php
namespace Solicitud\Form\Formulario;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Db\Adapter\AdapterInterface;
require_once "funcionesDB.php";


class SolicitudExoneracion extends Solicitud
{
	
	public function __construct(AdapterInterface $dbadapter, AdapterInterface $sapientiaDbadapter) { //parámetro del constructor: adaptador de la base de datos
		
		parent::__construct($name = 'solicitudExoneracion', $dbadapter, $sapientiaDbadapter);
	
		$this->setAttribute('method', 'post');

		//////////////////////***********INICIO Extracción de Datos**************/////////////////
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// rescatar su cedula
		$usuarioLogueado = 1;
		
		$datos = getDatosUsuario($dbadapter, $usuarioLogueado);
		$cedulaUsuario = $datos['cedula'];

		$datosAlumno = getMateriasYProfesoresUsuario($sapientiaDbadapter, $cedulaUsuario, TRUE);
		$selectDataMat = $datosAlumno['materias'] ;
		
		//////////////////////***********FIN Extracción de Datos**************/////////////////
		
		$this->add(array(
				'name' => 'asignatura',
				'type' => 'Zend\Form\Element\Select',
				'options' => array(
						'label' => 'Asignatura:',
						'empty_option' => 'Seleccione una asignatura..',
						'value_options' => $selectDataMat,//$this->getSubjectsOfCareer(),
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
				'type' => 'Zend\Form\Element\Radio',
				'name' => 'motivo',
				'options' => array(
						'label' => 'Motivo',
						'value_options' => array(
								'Enfermedad' => 'Enfermedad',
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
						'label' => 'Especificación de Motivo'
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
				'name' => 'tipo',
				'type' => 'Zend\Form\Element\Radio',
				'options' => array(
						'label' => 'Documento Adjunto',
						'value_options' => array(
								'Certificado Médico' => 'Certificado Médico',
								'Certificado de Trabajo' => 'Certificado de Trabajo',
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
	
	
	public function getAsignaturas()
	{
		//$usuarioLogueado = getUsuarioLogueado(); @todo: rescatar el usuario logueado
		// recatar su cedula
		$dbAdapter = $this->sapientiaDbAdapter;
		$sql       = 'SELECT m.materia, m.nombre FROM materias AS m INNER JOIN cursos AS c ON m.materia = c.materia
				INNER JOIN alumnos_por_curso AS axc ON c.curso = axc.curso AND axc.numero_de_documento = 4490334 AND c.anho = 2013 AND c.semestre_anho = 2';
																									//$usuarioLogueado
		$statement = $dbAdapter->query($sql);
		$result    = $statement->execute();

		$selectData = array();

		foreach ($result as $res) {
			$selectData[$res['nombre']] = $res['nombre'];
		}
		return $selectData;

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