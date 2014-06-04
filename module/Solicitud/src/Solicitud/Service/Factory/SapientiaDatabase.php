<?php
namespace Solicitud\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\Db\Adapter\Adapter as DbAdapter;
use Zend\ServiceManager\ServiceLocatorInterface;

class SapientiaDatabase implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$config = $serviceLocator->get('config');
		$adapter = new DbAdapter($config['sapientiadb']);
		return $adapter;
	}
}
