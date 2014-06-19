<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	public function indexAction()
	{
        $serviceLocator = $this->getServiceLocator();
        $config = $serviceLocator->get('config');
        return array(
                    'version'=> $config['application']['version'], 
                    'applicationName' => $config['application']['name']
                );
	}
	
	public function helpAction()
	{
		return array();
	}
	
	public function aboutAction()
	{
		return array();
	}
	
	public function manualsAction(){
		
		/* Get user role */
		$authorize = $this->getServiceLocator()->get('BjyAuthorize\Provider\Identity\ProviderInterface');
		$roles = $authorize->getIdentityRoles();
		$role = $roles[0];
		
		if ($role == 'admin') return $this->redirect()->toUrl("/manuals/manual_administrador.pdf");
		else if (in_array ($role , 
				array('recepcion', 'secretaria_general', 'secretaria_departamento', 'secretaria_academica', 'decano', 'director_academico', 'director_departamento')))
			return $this->redirect()->toUrl("/manuals/manual_funcionario.pdf");
		else 
			return $this->redirect()->toUrl("/manuals/manual_usuario.pdf");
	}
}
