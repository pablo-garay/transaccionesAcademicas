<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
    	/* Navigation */
    	$sm = $e->getApplication()->getServiceManager();
    	
    	// Add ACL information to the Navigation view helper
    	$authorize = $sm->get('BjyAuthorizeServiceAuthorize');
    	$acl = $authorize->getAcl();
    	$role = $authorize->getIdentity();
    	/* Define que elementos del navigator son visibles segun el rol del usuario */
    	\Zend\View\Helper\Navigation::setDefaultAcl($acl);
    	\Zend\View\Helper\Navigation::setDefaultRole($role); 

    	
    	
    	/* Translator */    	
        $translator = $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        $translator->addTranslationFile(
        		'phpArray',
        		'./vendor/zendframework/zendframework/resources/languages/es/Zend_Validate.php',
        		'default',
        		'es_ES'
        );
        \Zend\Validator\AbstractValidator::setDefaultTranslator(new
        		\Zend\Mvc\I18n\Translator($translator));
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
}
