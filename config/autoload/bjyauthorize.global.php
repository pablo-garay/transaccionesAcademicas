<?php

return array(
    'bjyauthorize' => array(

        // set the 'guest' role as default (must be defined in a role provider)
        'default_role' => 'guest',

        /* this module uses a meta-role that inherits from any roles that should
         * be applied to the active user. the identity provider tells us which
         * roles the "identity role" should inherit from.
         *
         * for ZfcUser, this will be your default identity provider
         */
        'identity_provider' => 'BjyAuthorize\Provider\Identity\ZfcUserZendDb',

        /* If you only have a default role and an authenticated role, you can
         * use the 'AuthenticationIdentityProvider' to allow/restrict access
         * with the guards based on the state 'logged in' and 'not logged in'.
         *
         * 'default_role'       => 'guest',         // not authenticated
         * 'authenticated_role' => 'user',          // authenticated
         * 'identity_provider'  => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
         */

        /* role providers simply provide a list of roles that should be inserted
         * into the Zend\Acl instance. the module comes with two providers, one
         * to specify roles in a config file and one to load roles using a
         * Zend\Db adapter.
         */
        'role_providers' => array(

            /* here, 'guest' and 'user are defined as top-level roles, with
             * 'admin' inheriting from user
             */
            'BjyAuthorize\Provider\Role\Config' => array(
                'guest' => array(),
                'user'  => array('children' => array(
                    'admin' => array(),
                	//'funcionario' => array('children' => array())
                )),
            ),

            // this will load roles from the user_role table in a database
            // format: user_role(role_id(varchar), parent(varchar))
            'BjyAuthorize\Provider\Role\ZendDb' => array(
                'table'                 => 'user_role',
                'identifier_field_name' => 'id',
                'role_id_field'         => 'role_id',
                'parent_role_field'     => 'parent_id',
            ),

            
        ),
        // resource providers provide a list of resources that will be tracked
        // in the ACL. like roles, they can be hierarchical
        'resource_providers' => array(
            'BjyAuthorize\Provider\Resource\Config' => array(
                'lista' => array(),
            	'solicitudes' => array(),
            	'formulario' => array(),
            	'admin' => array(),
            ),
        ),

        /* rules can be specified here with the format:
         * array(roles (array), resource, [privilege (array|string), assertion])
         * assertions will be loaded using the service manager and must implement
         * Zend\Acl\Assertion\AssertionInterface.
         * *if you use assertions, define them using the service manager!*
         */
        'rule_providers' => array(
            'BjyAuthorize\Provider\Rule\Config' => array(
                'allow' => array(
                    // allow guests and users (and admins, through inheritance)
                    // the "wear" privilege on the resource "pants"
                	array(array("recepcion", "secretaria_general", "alumno", "secretaria_academica", 
            			"secretaria_departamento", "decano", "director_academico", "director_departamento"), 
                		'solicitudes', array('listar', 'list')),
                	
                	array(array("user"),
                		'formulario', array('listar', 'convalidacion', 'varias')),
                	
                	array(array("alumno"),
                		'formulario', array('listar', 'list')),
                		
                	array(array("admin"),
                		'admin', array('listUsuarios'))
                ),

                // Don't mix allow/deny rules if you are using role inheritance.
                // There are some weird bugs.
                'deny' => array(
                		array(array("alumno"), 'formulario', array('convalidacion')),
                		array(array("admin"), 'formulario')
                ),
            ),
        ),

       

        /* Currently, only controller and route guards exist
         *
         * Consider enabling either the controller or the route guard depending on your needs.
         */
        'guards' => array(
            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all controllers and actions unless they are specified here.
             * You may omit the 'action' index to allow access to the entire controller
             */
            'BjyAuthorize\Guard\Controller' => array(
            	/* Guest */
                array('controller' => 'Application\Controller\Index', 'roles' => array('guest','user')),
                // You can also specify an array of actions or an array of controllers (or both)
                // allow "guest" and "admin" to access actions "list" and "manage" on these "index",
                // "static" and "console" controllers
                array('controller' => array('zfcuser', 'goalioforgotpassword_forgot'), 
                		'roles' => array('guest','user')),
            	
            	/* User */
            	array('controller' => array('Solicitud\Controller\Formulario'),
            		  'action' => array('solicitudesvarias', 'convalidacionmaterias'),
            		  'roles' => array('user')),
            	
            	/* Alumno */
            	array('controller' => array('Solicitud\Controller\Formulario'),
            			'roles' => array('alumno')),
            		
            	array('controller' => array('Solicitud\Controller\Actor'), 'action' => 'alumno',
            			'roles' => array('alumno')),
            		
            	/* Funcionarios y Alumno acceden a listas */
            	array('controller' => array('Solicitud\Controller\Lista'),
            			'roles' => array("recepcion", "secretaria_general", "alumno", "secretaria_academica", 
            			"secretaria_departamento", "decano", "director_academico", "director_departamento")),
            	
            	/* Funcionarios ven situacion academica */
            	array('controller' => array('Solicitud\Controller\SituacionAcademica'),
            			'roles' => array("recepcion", "secretaria_general", "secretaria_academica",
            					"secretaria_departamento", "decano", "director_academico", "director_departamento")),
            	
            	/* Recepcion */
            	array('controller' => array('Solicitud\Controller\Actor'), 'action' => 'recepcion',
            			'roles' => array("recepcion")),
            	
            	/* Secretaria General */
            	array('controller' => array('Solicitud\Controller\Actor'), 'action' => 'secretariageneral',
            			'roles' => array("secretaria_general")),
            	
            	/* Secretaria Academica */
            	array('controller' => array('Solicitud\Controller\Actor'), 'action' => 'secretariadepartamento',
            			'roles' => array("secretaria_departamento")),
            		
            	/* Secretaria Academica */
            	array('controller' => array('Solicitud\Controller\Actor'), 'action' => 'secretariaacademica',
           				'roles' => array("secretaria_academica")),
            		
        		/* Decano */
        		array('controller' => array('Solicitud\Controller\Actor'), 'action' => 'decano',
        				'roles' => array("decano")),
        				 
        		/* Director Academico */
        		array('controller' => array('Solicitud\Controller\Actor'), 'action' => 'directoracademico',
        				'roles' => array("director_academico")),
        		
        		/* Director Departamento */
        		array('controller' => array('Solicitud\Controller\Actor'), 'action' => 'directordepartamento',
        				'roles' => array("director_departamento")),            	
				
				/* Admin */
                array('controller' => 'ZfcAdmin\Controller\AdminController','roles' => array('admin')),
                array('controller' => 'zfcuseradmin','roles' => array('admin')),
                // Below is the default index action used by the ZendSkeletonApplication
                // array('controller' => 'Application\Controller\Index', 'roles' => array('guest', 'user')),
            ),

            /* If this guard is specified here (i.e. it is enabled), it will block
             * access to all routes unless they are specified here.
             */
//             'BjyAuthorize\Guard\Route' => array(
//             	/* Guest */
//                 array('route' => 'zfcuser', 'roles' => array('guest','user')),
//                 array('route' => 'zfcuser/login', 'roles' => array('guest')),
//                 array('route' => 'zfcuser/register', 'roles' => array('guest')),
//             	/* User */
//             	array('route' => 'zfcuser/logout', 'roles' => array('user')),
//                 // Below is the default index action used by the ZendSkeletonApplication
//                 array('route' => 'home', 'roles' => array('guest', 'user')),
//                 array('route' => 'application/default', 'roles' => array('guest', 'user')),
//                 array('route' => 'zfcadmin', 'roles' => array('admin')),
//             ),
        ),
    ),
);
