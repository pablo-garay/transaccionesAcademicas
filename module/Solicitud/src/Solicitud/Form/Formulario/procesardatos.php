<?php


use Solicitud\Service\Factory\DatabaseSapientia as DatabaseAdapter;

function getDbAdapter()
{
	//instanciar la clase cuyo metodo nos devuelve el adaptador de nuestra bd
	$database = new DatabaseAdapter();
	//llamamos al metodo que nos devuelve el adaptador de bd
	$dbAdapter = $database->createService($this->getServiceLocator());
	 
	return $dbAdapter;
}

 if(isset($_POST["materia"]))
 {
    
    $dbAdapter = getDbAdapter();
    $sql = "SELECT pxc.profesor, p.nombre FROM profesores_por_curso AS pxc INNER JOIN profesores AS p ON pxc.profesor = p.profesor
    			INNER JOIN cursos AS c ON pxc.curso = c.curso INNER JOIN materias AS m ON m.nombre = ".$_POST["materia"] ;
    
    $statement = $dbAdapter->query($sql);
    $result    = $statement->execute();
    
    $selectData = array();
    
    foreach ($result as $res) {
    	$selectData[$res['p.nombre']] = $res['p.nombre'];
    }
    echo $selectData;
    
    
     //echo $opciones;
 }
?>