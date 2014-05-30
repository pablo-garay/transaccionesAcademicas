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

    public function seccionAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'seccionActual' => '---',
            'seccionObj' => '---',
            'profesor' => '---',
            'motivo' => '---',
            'adjunto' => '---'
        ));
        return $pdf;
    }

    public function certificadoAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'documento' => '---',
            'telefono' => '---',
            'email' => '---',
            'materiasDiurnas' => '---',
            'materiasNocturnas' => '---',
            'tipo' => '---',
            'titulo' => '---',
            'respuesta' => '---',
            'observaciones' => '---'
        ));
        return $pdf;
    }

    public function colaboradorAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'profesor' => '---',
            'adjunto' => '---'
        ));
        return $pdf;
    }

    public function creditosAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'actividad' => '---',
            'fechaIni' => '---',
            'fechaFin' => '---',
            'descripcion' => '---'
        ));
        return $pdf;
    }

    public function desinscripcionAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'codigo' => '---'
        ));
        return $pdf;
    }

    public function exoneracionAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'motivo' => '---',
            'esp_motivo' => '---',
            'adjunto' => '---',
            'esp_adjunto' => '---'
        ));
        return $pdf;
    }

    public function extraordinarioAction()
    {
        // quitar de la bd
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // Datos del alumno
            'nombre' => 'Jorge Rafael',
            'apellido' => 'Zapattini Aponte',
            'matricula' => '54816',
            'carrera' => 'Ing. Inf.',
            'telefono' => '021230123',
            // Informacion para la solicitud
            'mesaNro' => '123123',
            'asignatura' => 'Informatica 1',
            'fecha' => '15/03/14',
            'fechaEXA' => '12/03/14',
            'profesor' => 'Ing. Mauricio Kreitmayer',
            'motivo' => 'No estudie todo el contenido, para evitar recursar la materia solicito el extraordinario.',
            'adjunto' => '---'
        ));
        return $pdf;
    }

    public function inclusionAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'motivo' => '---',
            'profesor' => '---',
            'descripcion' => '---'
        ));
        return $pdf;
    }

    public function tardiaAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'oportunidad' => '---',
            'fechaEXA' => '---',
            'motivo' => '---',
            'adjunto' => '---',
            'especificacion' => '---'
        ));
        return $pdf;
    }

    public function pasantiaAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'lugar' => '---',
            'direccion' => '---',
            'email' => '---',
            'motivo' => '---',
            'esp_motivo' => '---',
            'adjunto' => '---',
            'esp_adjunto' => '---'
        ));
        return $pdf;
    }

    public function reduccionAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'profesor' => '---',
            'motivo' => '---',
            'adjunto' => '---'
        ));
        return $pdf;
    }

    public function revisionescolaridadAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'observaciones' => '---'
        ));
        return $pdf;
    }

    public function revisionexamenAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'profesor' => '---',
            'fechaEXA' => '----',
            'oportunidad' => '---',
            'calificacion' => '---',
            'motivo' => '---',
            'fechaREVI' => '----',
            'horaREVI' => '---',
            'lugarREVI' => '---'
        ));
        return $pdf;
    }

    public function rupturaAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'materiaCo' => '---',
            'motivo' => '---',
            'descripcion' => '---'
        ));
        return $pdf;
    }

    public function tituloAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'titulo' => '---',
            'descripcion' => '---',
            'documento' => '---'
        ));
        return $pdf;
    }

    public function traspasoAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'seccion' => '---',
            'op_pagada' => '---',
            'fecha_pagada' => '---',
            'op_apagar' => '---',
            'fecha_apagar' => '---'
        ));
        return $pdf;
    }

    public function tutoriaAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'profesor' => '---',
            'motivo' => '---',
            'esp_motivo' => '---',
            'adjunto' => '---',
            'esp_adjunto' => '---'
        ));
        return $pdf;
    }

    public function fueraAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asignatura' => '---',
            'motivo' => '---',
            'esp_motivo' => '---'
        ));
        return $pdf;
    }

    public function variasAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'asunto' => '---',
            'motivo' => '---',
            'esp_motivo' => '---'
        ));
        return $pdf;
    }

    public function tesisAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'tema' => '---',
            'integrante' => '---',
            'profesor' => '---',
            'adjunto' => '---',
            'esp_adjunto' => '---'
        ));
        return $pdf;
    }

    public function convalidacionAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'universidad' => '---',
            'direUniversidad' => '---',
            'telUniversidad' => '---',
            'emailUniversidad' => '---',
            'carrera' => '---'
        ));
        return $pdf;
    }

    public function homologacionAction()
    {
        $pdf = new PdfModel();
        
        $pdf->setVariables(array(
            // DATOS DE ALUMNO
            'mesaNro' => '---',
            'fecha' => '---',
            'nombre' => '---',
            'apellido' => '---',
            'matricula' => '---',
            'carrera' => '---',
            'telefono' => '---',
            // CAMPOS DE SOLICITUD
            'carreraH' => '---',
            'planEstudios' => '---',
            'adjunto' => '---',
            'esp_adjunto' => '---',
        ));
        return $pdf;
    }
}