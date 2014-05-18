<?php

namespace Visualize\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DOMPDFModule\View\Model\PdfModel;


class VisualizeController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function calificacionesAction()
    {
        $fechaBD = "15/03/2014"; //de la solicitud
        $nombreBD = "Luis Fernando"; //nombre del solicitante
        $apellidoBD = "Villalba Vera"; //apellido del solicitante
        $matriculaBD = "59191"; //matricula del solicitante
        $carreraBD= "IF"; //carrera del solicitante
        return array(
            "fechaSol"=>$fechaBD,
            "nombreSol" => $nombreBD,
            "apellidoSol" => $apellidoBD,
            "matriculaSol" => $matriculaBD,
            "carreraSol" => $carreraBD,
            );
    }
    
    public function extraordinarioAction()
    {
        //quitar de la bd
        
        $pdf = new PdfModel();
        #Para meter las variables
        #$pdf->setVariables(array(
        #  'prueba' => 'Funciona',
        #));
        return $pdf;
        
    }

    public function rupturaCorrelaAction()
    {
        $fechaBD = "15/03/2014"; //de la solicitud
        $nombreBD = "Luis Fernando"; //nombre del solicitante
        $apellidoBD = "Villalba Vera"; //apellido del solicitante
        $matriculaBD = "59191"; //matricula del solicitante
        $carreraBD= "IF"; //carrera del solicitante
        $telefonoBD = "021372255";
        $materiaRC = "MPI";
        $motivoRC = "Para tomar la materia INFO1";
        $adjuntoRC = "certificado de trabajo";
        return array(
            "fechaSol"=>$fechaBD,
            "nombreSol" => $nombreBD,
            "apellidoSol" => $apellidoBD,
            "matriculaSol" => $matriculaBD,
            "telefonoSol" => $telefonoBD,
            "carreraSol" => $carreraBD,
            "materiaRC" => $materiaRC,
            "motivoRC" =>  $motivoRC,
            "adjuntoRC" => $adjuntoRC,
            "firma" => "ALUMNO"
            );
    }


}

