<?php
namespace Solicitud\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class Solicitud extends AbstractTableGateway
{

	public function __construct()
	{

		$this->table = 'solicitudes';
		$this->featureSet = new Feature\FeatureSet();
		$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
		$this->featureSet->addFeature(new Feature\SequenceFeature('solicitud','solicitudes_solicitud_seq'));
		$this->initialize();
	}

	public function insert($set)
	{
		// $fields = $this->getColumns(); // obtener columnas de tabla

		$solicitudData = array(
			'usuario_solicitante' => $set['usuario'],
			'carrera' => $set['carrera'],
			'tipo_solicitud' => $set['tipo_solicitud'],
			'matricula' => $set['matricula'],
		);

		parent::insert($solicitudData);
		return $this->lastInsertValue;
	}
}

// class SolicitudExtraordinario extends AbstractTableGateway
// {

// 	public function __construct()
// 	{

// 		$this->table = 'solicitud_de_extraordinario';
// 		$this->featureSet = new Feature\FeatureSet();
// 		$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
// 		$this->initialize();
// 	}

// 	public function insert($set)
// 	{
// 		return parent::insert($set);
// 	}
// }
