<?php
return array(
    'controllers' => array(
        'invokables' => array(
            // below is key                      and below is the fully qualified class name
            'Solicitud\Controller\Formulario' => 'Solicitud\Controller\FormularioController',
        	'Solicitud\Controller\Actor' 	  => 'Solicitud\Controller\ActorController',
        	'Solicitud\Controller\Lista' 	  => 'Solicitud\Controller\ListaController',
        	'Solicitud\Controller\SituacionAcademica' => 'Solicitud\Controller\SituacionAcademicaController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'solicitud' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/solicitud',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Solicitud\Controller',
                        'controller'    => 'Formulario',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                	'list' => array(
                		'type'    => 'Segment',
                		'options' => array (
                			'route' => '/lista[/:action][/:page][/order_by/:order_by][/:order]',
                			'constraints' => array(
                					'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                					'page'     => '[0-9]+',
                					'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                					'order' => 'ASC|DESC',
                			),
                			'defaults' => array(
                				'controller'    => 'Lista',
                				'action'        => 'todas',
                				'page'          => '1',
                			),
                		)
                	),
                		'academica' => array(
                				'type'    => 'Segment',
                				'options' => array (
                						'route' => '/situacionacademica[/:action][/:page]',
                						'defaults' => array(
                								'controller'    => 'SituacionAcademica',
                								'action'        => 'index',
                						),
                				),
                		),
            		'actor' => array(
        				'type'    => 'Segment',
		                'options' => array(
		                    'route'    => '/actor[/:action][/:id]',
		                    'constraints' => array(
		                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
		                        'id'     => '[0-9]+',
		                    ),
		                    'defaults' => array(
		                        'controller' => 'Actor',
		                        'action'     => 'recepcion',
		                    ),
		                ),
            		)                	
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Solicitud' => __DIR__ . '/../view',
        ),
    ),
	'service_manager' => array (
			'factories' => array(
					'database' => 'Solicitud\Service\Factory\Database',
					'sapientiadb' => 'Solicitud\Service\Factory\SapientiaDatabase',
			),
			'invokables' => array(
					'table-gateway' => 'Solicitud\Service\Invokable\TableGateway',
					'goaliomailservice_message' => 'GoalioMailService\Mail\Service\Message',
			)
	),
    'translator' => array(
        'locale' => 'es_ES',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),	
	'table-gateway' => array(
			'map' => array(
					'solicitudes' => 'Solicitud\Model\Solicitud',
					'solicitudExtraordinario' => 'Solicitud\Model\SolicitudExtraordinario',
			)
	),

    // Below is the menu navigation for this module
	'navigation' => array(
		'default' => array(
			array(
				'label' => 'Solicitudes',
				'route' => 'solicitud/default',
				'controller'=> 'lista',
				'action' => 'todas',
				'resource'   => 'solicitudes',
				'privilege'  => 'listar',
				'pages' => array(
					array(
						'label' => 'Lista de Solicitudes',
						'route' => 'solicitud/default',
						'controller' => 'lista',
						'action' => 'todas',
// 						// acl
						'resource'   => 'solicitudes',
						'privilege'  => 'list',
					),
					array(
						'label' => 'Lista de Solicitudes Pendientes',
						'route' => 'solicitud/default',
						'controller' => 'lista',
						'action' => 'pendientes',
// 						// acl
						'resource'   => 'solicitudes',
						'privilege'  => 'list',
					),
					array(
						'label' => 'Lista de Solicitudes Nuevas',
						'route' => 'solicitud/default',
						'controller' => 'lista',
						'action' => 'nuevas',
// 						// acl
						'resource'   => 'solicitudes',
						'privilege'  => 'list',
					),					
					array(
						'label' => 'Lista de Solicitudes Aprobadas',
						'route' => 'solicitud/default',
						'controller' => 'lista',
						'action' => 'aprobadas',							
// 						// acl
						'resource'   => 'solicitudes',
						'privilege'  => 'list',
					),
					array(
						'label' => 'Lista de Solicitudes Rechazadas',
						'route' => 'solicitud/default',
						'controller' => 'lista',
						'action' => 'rechazadas',							
// 						// acl
						'resource'   => 'solicitudes',
						'privilege'  => 'list',
					),
					array(
						'label' => 'Lista de Solicitudes Anuladas',
						'route' => 'solicitud/default',
						'controller' => 'lista',
						'action' => 'anuladas',							
// 						// acl
						'resource'   => 'solicitudes',
						'privilege'  => 'list',
					),
				)
			),
			array(
				'label' => 'Crear Solicitud',
				'route' => 'application/default',
				'controller'=> 'index',
				'action' => 'help',
				'resource'   => 'formulario',
				'privilege'  => 'listar',
				'pages' => array(
					array(
						'label' => 'Examen Extraordinario',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'extraordinario',
						'resource' => 'formulario',
						'privilege' => 'list',
					),				
					array(
						'label' => 'Ruptura de Correlatividad',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'ruptura',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Certificado de Estudios',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'certificado',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Inscripción tardía a examen',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'inscripciontardia',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Creditos Académicos',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'creditos',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Reducción de Asistencia',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'reduccion',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Revisión de Examen',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'revisionexamen',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Desinscripción de Materia',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'desinscripcion',
						'resource' => 'formulario',
						'privilege' => 'list',
					),									
					array(
						'label' => 'Traspaso de pago de Examen',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'traspasopago',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Revisión de Escolaridad',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'revisionescolaridad',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Colaborador de Cátedra',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'colaboradorcatedra',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Solicitud de Título',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'titulo',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Convalidación de Materias',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'convalidacionmaterias',
						'resource' => 'formulario',
						'privilege' => 'convalidacion',
					),
					array(
						'label' => 'Homologación de Materias',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'homologacionmaterias',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Solicitud de Tesis',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'tesis',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Solicitud de Pasantía',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'pasantia',
						'resource' => 'formulario',
						'privilege' => 'list',
					),	
					array(
						'label' => 'Tutoría de Cátedra',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'tutoriacatedra',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Exoneración de Asistencia',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'exoneracion',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Asignatura Fuera de Malla Curricular',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'materiafueramallacurricular',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Solicitud de Cambio de Sección',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'cambioseccion',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Inclusión en Lista',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'inclusionlista',
						'resource' => 'formulario',
						'privilege' => 'list',
					),
					array(
						'label' => 'Solicitudes Varias',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'solicitudesvarias',
						'resource' => 'formulario',
						'privilege' => 'varias',
					),																															
				)
			)
		),
	),
);
