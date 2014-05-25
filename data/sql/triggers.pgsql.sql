CREATE OR REPLACE FUNCTION usuario_add() RETURNS trigger AS $$
    BEGIN
        NEW.estado_cuenta := 'A';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS usuario_add ON usuarios;

CREATE TRIGGER usuario_add BEFORE INSERT ON usuarios
    FOR EACH ROW EXECUTE PROCEDURE usuario_add();



CREATE OR REPLACE FUNCTION solicitud_insert() RETURNS trigger AS $$
    BEGIN
	NEW.fecha_solicitada := current_date;
        NEW.estado_solicitud := 'NUEVO';
        NEW.etapa_actual := 'RCDA';
        NEW.resultado_requisitos := 'NO_VERIFICADO';
        NEW.mesa_entrada := NEW.solicitud;
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS solicitud_insert ON solicitudes;

CREATE TRIGGER solicitud_insert BEFORE INSERT ON solicitudes
    FOR EACH ROW EXECUTE PROCEDURE solicitud_insert();



CREATE OR REPLACE FUNCTION extraordinario_insert() RETURNS trigger AS $$
    BEGIN
	NEW.cumple_fecha := 'NO_VERIFICADO';
        NEW.ausente_tercera_op := 'NO_VERIFICADO';
        NEW.inscripto_tercera_op := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS extraordinario_insert ON solicitud_de_extraordinario;

CREATE TRIGGER extraordinario_insert BEFORE INSERT ON solicitud_de_extraordinario
    FOR EACH ROW EXECUTE PROCEDURE extraordinario_insert();



CREATE OR REPLACE FUNCTION exoneracion_insert() RETURNS trigger AS $$
    BEGIN
	NEW.cumple_porcentaje_asistencia := 'NO_VERIFICADO';
	NEW.ausencia_finales := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS exoneracion_insert ON solicitud_de_exoneracion;

CREATE TRIGGER exoneracion_insert BEFORE INSERT ON solicitud_de_exoneracion
    FOR EACH ROW EXECUTE PROCEDURE exoneracion_insert();



CREATE OR REPLACE FUNCTION tutoriacatedra_insert() RETURNS trigger AS $$
    BEGIN
	NEW.cumple_nota_minima_requerida := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS tutoriacatedra_insert ON solicitud_de_tutoria_de_catedra;

CREATE TRIGGER tutoriacatedra_insert BEFORE INSERT ON solicitud_de_tutoria_de_catedra
    FOR EACH ROW EXECUTE PROCEDURE tutoriacatedra_insert();



CREATE OR REPLACE FUNCTION tesis_insert() RETURNS trigger AS $$
    BEGIN
	NEW.cumple_aprobacion_materias := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS tesis_insert ON solicitud_de_tesis;

CREATE TRIGGER tesis_insert BEFORE INSERT ON solicitud_de_tesis
    FOR EACH ROW EXECUTE PROCEDURE tesis_insert();


-- 
-- CREATE OR REPLACE FUNCTION inclusionlista_insert() RETURNS trigger AS $$
--     BEGIN
--         
--         RETURN NEW;
--     END;
-- $$ LANGUAGE plpgsql;
-- 
-- DROP TRIGGER IF EXISTS inclusionlista_insert ON solicitud_de_inclusion_en_lista;
-- 
-- CREATE TRIGGER inclusionlista_insert BEFORE INSERT ON solicitud_de_inclusion_en_lista
--     FOR EACH ROW EXECUTE PROCEDURE inclusionlista_insert();



CREATE OR REPLACE FUNCTION cambioseccion_insert() RETURNS trigger AS $$
    BEGIN
	NEW.materia_seccion_validas := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS cambioseccion_insert ON solicitud_de_cambio_de_seccion;

CREATE TRIGGER cambioseccion_insert BEFORE INSERT ON solicitud_de_cambio_de_seccion
    FOR EACH ROW EXECUTE PROCEDURE cambioseccion_insert();      



CREATE OR REPLACE FUNCTION titulo_insert() RETURNS trigger AS $$
    BEGIN
	NEW.aprobacion_total_de_materias := 'NO_VERIFICADO';
	NEW.cumple_creditos_requeridos   := 'NO_VERIFICADO';
	NEW.presento_tesis 		 := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS titulo_insert ON solicitud_de_titulo;

CREATE TRIGGER titulo_insert BEFORE INSERT ON solicitud_de_titulo
    FOR EACH ROW EXECUTE PROCEDURE titulo_insert();



CREATE OR REPLACE FUNCTION colaboradorcatedra_insert() RETURNS trigger AS $$
    BEGIN
	NEW.materia_cursada := 'NO_VERIFICADO';
	NEW.nota_minima_requerida := 'NO_VERIFICADO';
	NEW.solicitante_licenciado_ultimo_anho := 'NO_VERIFICADO';
	NEW.ayudante_colaborador := TRUE;
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS colaboradorcatedra_insert ON solicitud_de_colaborador_de_catedra;

CREATE TRIGGER colaboradorcatedra_insert BEFORE INSERT ON solicitud_de_colaborador_de_catedra
    FOR EACH ROW EXECUTE PROCEDURE colaboradorcatedra_insert();



CREATE OR REPLACE FUNCTION traspasopago_insert() RETURNS trigger AS $$
    BEGIN
	NEW.cumple_plazo_limite := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS traspasopago_insert ON solicitud_de_traspaso_de_pago_de_examen;

CREATE TRIGGER traspasopago_insert BEFORE INSERT ON solicitud_de_traspaso_de_pago_de_examen
    FOR EACH ROW EXECUTE PROCEDURE traspasopago_insert();



CREATE OR REPLACE FUNCTION desinscripcion_insert() RETURNS trigger AS $$
    BEGIN
	NEW.cuotas_pagadas := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS desinscripcion_insert ON solicitud_de_desinscripcion_de_curso;

CREATE TRIGGER desinscripcion_insert BEFORE INSERT ON solicitud_de_desinscripcion_de_curso
    FOR EACH ROW EXECUTE PROCEDURE desinscripcion_insert();     



CREATE OR REPLACE FUNCTION reduccion_insert() RETURNS trigger AS $$
    BEGIN
	NEW.asistencia_minima := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS reduccion_insert ON solicitud_de_reduccion_de_asistencia;

CREATE TRIGGER reduccion_insert BEFORE INSERT ON solicitud_de_reduccion_de_asistencia
    FOR EACH ROW EXECUTE PROCEDURE reduccion_insert();




CREATE OR REPLACE FUNCTION certificado_insert() RETURNS trigger AS $$
    BEGIN
	NEW.aprobacion_plan_materias := 'NO_VERIFICADO';
	NEW.presentacion_certificado_estudios := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS certificado_insert ON solicitud_de_certificado_de_estudios;

CREATE TRIGGER certificado_insert BEFORE INSERT ON solicitud_de_certificado_de_estudios
    FOR EACH ROW EXECUTE PROCEDURE certificado_insert();



CREATE OR REPLACE FUNCTION ruptura_insert() RETURNS trigger AS $$
    BEGIN
	NEW.cumple_promedio_minimo := 'NO_VERIFICADO';
	NEW.hasta_cuarto_semestre_regular := 'NO_VERIFICADO';
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS ruptura_insert ON solicitud_de_ruptura_de_correlatividad;

CREATE TRIGGER ruptura_insert BEFORE INSERT ON solicitud_de_ruptura_de_correlatividad
    FOR EACH ROW EXECUTE PROCEDURE ruptura_insert();    



CREATE OR REPLACE FUNCTION revisionexamen_insert() RETURNS trigger AS $$
    BEGIN
	NEW.calificacion_nueva := 0;
        
        RETURN NEW;
    END;
$$ LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS revisionexamen_insert ON solicitud_de_revision_de_examen;

CREATE TRIGGER revisionexamen_insert BEFORE INSERT ON solicitud_de_revision_de_examen
    FOR EACH ROW EXECUTE PROCEDURE revisionexamen_insert();    



    