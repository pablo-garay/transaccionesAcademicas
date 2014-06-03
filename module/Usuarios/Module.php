<?php
namespace Usuarios;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager(); 
        $moduleRouteListener = new ModuleRouteListener(); 
        $moduleRouteListener->attach($eventManager); 
        // Extend the ZfcUser registration form with custom fields 
        $this->extendUserRegistrationForm($eventManager);
    }    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Extends the ZfcUser registration form with custom fields
     *
     * @param EventManager $eventManager
     */
    protected function extendUserRegistrationForm(EventManager $eventManager)
    {
        // custom fields of registration form (ZfcUser)
        $sharedEvents = $eventManager->getSharedManager();
        $sharedEvents->attach('ZfcUser\Form\Register',
                'init',
                function($e)
                {
                    /* @var $form \ZfcUser\Form\Register */
                    $form = $e->getTarget();
 
                    $form->add(
                            array(
                                    'name' => 'nombres',
                                    'type' => 'text',
                                    'attributes' => array(
                                    		'placeholder' => 'Escriba su nombre...',
                                            'required' => 'required',
                                    ),
                                    'options' => array(
                                            'label' => 'Nombres',
                                    ),
                            )
                    );
 
                    $form->add(
                            array(
                                    'name' => 'apellidos',
                                    'type' => 'text',
                                    'attributes' => array(
                                    		'placeholder' => 'Escriba su apellido...',
                                            'required' => 'required',
                                    ),
                                    'options' => array(
                                            'label' => 'Apellidos',
                                    ),
                            )
                    );
                    
//                     $form->add(array(
//                     		'name' => 'fecha_nacimiento',
//                     		'type' => 'Zend\Form\Element\Date',
//                     		'attributes' => array(
//                     				'placeholder' => 'Fecha de nacimiento...',
//                     				'required' => 'required',
//                     		),
//                     		'options' => array(
//                     				'label' => 'Fecha de Nacimiento',
//                     		),
//                     ));
                    
                    $form->add(array(
                        'name' => 'sexo',
                        'type' => 'Zend\Form\Element\Radio',
                        'attributes' => array(
                                'required' => 'required',
                        ),
                        'options' => array(
                                'label' => 'Sexo',
                                'value_options' => array(
                                        'M' => 'Masculino',
                                        'F' => 'Femenino',
                                ),
                            ),
                    ));

                    $form->add(array(
                            'name' => 'direccion',
                            'type' => 'Zend\Form\Element\Text',
                            'attributes' => array(
                                    'placeholder' => 'Escriba su dirección...',
                                    'required' => 'required',
                            ),
                            'options' => array(
                                    'label' => 'Dirección',
                            ),
                    ));

                    $form->add(array(
                            'name' => 'telefono',
                            'options' => array(
                                    'label' => 'Teléfono'
                            ),
                            'attributes' => array(
                                    // Below: HTML5 way to specify that the input will be phone number
                                    'type' => 'tel',
                                    'placeholder' => 'Escriba su teléfono...',
                                    'required' => 'required',
                                    // Below: HTML5 way to specify the allowed characters
                                    'pattern'  => '^[\d-/]+$'
                            ),
                    ));
                   
                    $form->add(array(
                        'name' => 'tipo_de_documento',
                        'type' => 'Zend\Form\Element\Select',
                        'attributes' => array(
                                'required' => 'required',
                        		'placeholder' => 'Elija el tipo de documento...',
                        ),
                        'options' => array(
                                'label' => 'Tipo de documento',
                                'value_options' => array(
                                        'Cedula de Identidad' => 'Cedula de Identidad',
                                        'Pasaporte' => 'Pasaporte',
                                        'Carnet de Migraciones' => 'Carnet de Migraciones',
                                		'Libreta Cívica' => 'Libreta Cívica',
                                		'Libreta de Baja' => 'Libreta de Baja',
                                		'RUC' => 'RUC',
                                		'Indefinido' => 'Indefinido',
                                ),
                        		'empty_option' => 'Elija el tipo de su documento...'
                            ),
                    ));

                    $form->add(array(
                            'name' => 'origen_de_documento',
                            'type' => 'Zend\Form\Element\Select',
                            'attributes' => array(
                                    'placeholder' => 'Elija el origen de su documento...',
                                    'required' => 'required',
                            ),
                            'options' => array(
                                    'label' => 'Origen de documento',
                            		'value_options' => array(
                            				'Paraguay' => 'Paraguay',
                            				'Otro' => 'Otro',
                            		),
                            		'empty_option' => 'Indique origen del documento'
                            ),
                    ));
                    
                    $form->add(array(
                    		'name' => 'numero_de_documento',
                    		'type' => 'Zend\Form\Element\Text',
                    		'attributes' => array(
                    				'placeholder' => 'Escriba el número de documento...',
                    				'required' => 'required',
                    				'pattern'  => '^\d+$'
                    		),
                    		'options' => array(
                    				'label' => 'Número de Documento',
                    		),
                    ));
                }
        );
 
        // Validators for custom fields
        $sharedEvents->attach('ZfcUser\Form\RegisterFilter',
                'init',
                function($e)
                {
                    /* @var $form \ZfcUser\Form\RegisterFilter */
                    $filter = $e->getTarget();
 
                    // Custom field firstname
                    $filter->add ( array (
                            'name' => 'nombres',
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
                                                            'isEmpty' => 'Se requiere nombres'
                                                    )
                                            )
                                    )
                            )
                    ) );
 
                    // Custom field lastname                   
                    $filter->add (array (
                            'name' => 'apellidos',
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
                                                            'isEmpty' => 'Se requiere apellidos'
                                                    )
                                            )
                                    )
                            )
                    ) );

//                     $filter->add ( array (
//                             'name' => 'fecha_nacimiento',
//                             'filters' => array (
//                                     array ('name' => 'StripTags'),
//                                     array ('name' => 'StringTrim'),
//                             ),
//                             'validators' => array (
//                                     array (
//                                             'name' => 'NotEmpty',
//                                             // @todo Validar fecha minima
//                                     )
//                             )
//                     ) );

                    $filter->add ( array (
                            'name' => 'sexo',
                            'filters' => array(
                                    array ( 'name' => 'StripTags' ),
                                    array ( 'name' => 'StringTrim' ),
                            ),
                            'validators' => array (
                                    array (
                                            'name' => 'NotEmpty',
                                            // @todo validar que sea caracter M o F
                                    ),
                            )
                    ));

                    $filter->add (array (
                            'name' => 'direccion',
                            'filters' => array(
                                    array ( 'name' => 'StripTags' ),
                                    array ( 'name' => 'StringTrim' ),
                            ),
                            'validators' => array (
                                    array (
                                            'name' => 'NotEmpty',
                                            //@todo validate que sea Alphanum
                                    ),
                            )
                    ));

                    $filter->add ( array (
                            'name' => 'telefono',
                            'filters' => array(
                                    array ( 'name' => 'digits' ),
                                    array ( 'name' => 'stringtrim' ),
                            ),
                            'validators' => array (
                                    array (
                                            'name' => 'regex',
                                            'options' => array (
                                                    'pattern' => '/^[\d-\/]+$/',
                                            )
                                    ),
                            )
                    ));

                    $filter->add ( array (
                            'name' => 'tipo_de_documento',
                            'filters' => array(
                                    array ( 'name' => 'StripTags' ),
                                    array ( 'name' => 'StringTrim' ),
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
                    ));

                    $filter->add (array (
                            'name' => 'numero_de_documento',
                            'filters' => array(
                                    array ( 'name' => 'StripTags' ),
                                    array ( 'name' => 'StringTrim' ),
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
                    ));
                    
                    $filter->add (array (
                    		'name' => 'origen_de_documento',
                    		'filters' => array(
                    				array ( 'name' => 'StripTags' ),
                    				array ( 'name' => 'StringTrim' ),
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
                    ));
                }
        );
    }
}
