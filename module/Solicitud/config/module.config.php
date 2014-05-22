<?php
return array(
    'controllers' => array(
        'invokables' => array(
            // below is key                      and below is the fully qualified class name
            'Solicitud\Controller\Formulario' => 'Solicitud\Controller\FormularioController',
        	'Solicitud\Controller\Actor' 	  => 'Solicitud\Controller\ActorController',
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
                			'route' => '/formulario/list[/:page]',
                			'constraints' => array(
                					'page'     => '[0-9]*',
                			),
                			'defaults' => array(
                				'controller'    => 'Formulario',
                				'action'        => 'list',
                				'page'          => '1',
                			),
                		)
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
			)
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
				'controller'=> 'formulario',
				'pages' => array(
					array(
						'label' => 'Lista',
						'route' => 'solicitud/list',
// 						// acl
// 						'resource'   => 'test',
// 						'privilege'  => 'list',
					),
					array(
						'label' => 'Lista de Solicitudes Pendientes',
						'route' => 'solicitud/list',
// 						// acl
// 						'resource'   => 'test',
// 						'privilege'  => 'list',
					),
					array(
						'label' => 'Lista de Solicitudes Nuevas',
						'route' => 'solicitud/list',
// 						// acl
// 						'resource'   => 'test',
// 						'privilege'  => 'list',
					),					
					array(
						'label' => 'Lista de Solicitudes Aprobadas',
						'route' => 'solicitud/list',
// 						// acl
// 						'resource'   => 'test',
// 						'privilege'  => 'list',
					),
					array(
						'label' => 'Lista de Solicitudes Rechazadas',
						'route' => 'solicitud/list',
// 						// acl
// 						'resource'   => 'test',
// 						'privilege'  => 'list',
					),
					array(
						'label' => 'Lista de Solicitudes Anuladas',
						'route' => 'solicitud/list',
// 						// acl
// 						'resource'   => 'test',
// 						'privilege'  => 'list',
					),
				)
			),
			array(
				'label' => 'Crear Solicitud',
				'route' => 'solicitud/default',
				'controller'=> 'formulario',
				'pages' => array(
					array(
						'label' => 'Examen Extraordinario',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'extraordinario',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),				
					array(
						'label' => 'Ruptura de Correlatividad',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'ruptura',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),
					array(
						'label' => 'Certificado de Estudios',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'certificado',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Inscripción tardía a examen',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'inscripciontardia',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Creditos Académicos',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'creditos',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Reducción de Asistencia',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'reduccion',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Revisión de Examen',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'revisionexamen',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Desinscripción de Materia',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'desinscripcion',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),									
					array(
						'label' => 'Traspaso de pago de Examen',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'traspasopago',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Revisión de Escolaridad',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'revisionescolaridad',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Colaborador de Cátedra',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'colaboradorcatedra',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Solicitud de Título',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'titulo',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Convalidación de Materias',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'convalidacionmaterias',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Homologación de Materias',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'homologacionmaterias',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Solicitud de Tesis',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'tesis',
					// 						'resource' => 'formulario',
					// 						'privilege' => 'create',
					),
					array(
						'label' => 'Solicitud de Pasantía',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'pasantia',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),	
					array(
						'label' => 'Tutoría de Cátedra',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'tutoriacatedra',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),
					array(
						'label' => 'Exoneración de Asistencia',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'exoneracion',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),
					array(
						'label' => 'Asignatura Fuera de Malla Curricular',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'materiafueramallacurricular',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),
					array(
						'label' => 'Solicitud de Cambio de Sección',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'cambioseccion',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),
					array(
						'label' => 'Inclusión en Lista',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'inclusionlista',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),
					array(
						'label' => 'Solicitudes Varias',
						'route' => 'solicitud/default',
						'controller' => 'formulario',
						'action' => 'solicitudesvarias',
// 						'resource' => 'formulario',
// 						'privilege' => 'create',
					),																															
				)
			)
		),
	),
);
