/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     21/05/2014 07:01:58 p.m.                     */
/*==============================================================*/

-- 
-- drop index ALUMNOS_PK;
-- 
-- drop table ALUMNOS;
-- 
-- drop index SIGUE_FK3;
-- 
-- drop index SIGUE_FK2;
-- 
-- drop index SIGUE_PK;
-- 
-- drop table ALUMNO_POR_CARRERA;
-- 
-- drop index INSCRIPTO_A_FK3;
-- 
-- drop index INSCRIPTO_A_FK2;
-- 
-- drop index INSCRIPTO_A_PK;
-- 
-- drop table ALUMNO_POR_CURSO;
-- 
-- drop index TIENE_FK6;
-- 
-- drop index TIENE_FK5;
-- 
-- drop index ASISTENCIAS_POR_ALUMNO_PK;
-- 
-- drop table ASISTENCIAS_POR_ALUMNO;
-- 
-- drop index TIENE_FK3;
-- 
-- drop index TIENE_FK2;
-- 
-- drop index CALIFICACIONES_POR_ALUMNO_PK;
-- 
-- drop table CALIFICACIONES_POR_ALUMNO;
-- 
-- drop index TIENE_FK;
-- 
-- drop index CARRERAS_PK;
-- 
-- drop table CARRERAS;
-- 
-- drop index TIENE_FK9;
-- 
-- drop index TIENE_FK8;
-- 
-- drop index TIENE_PK;
-- 
-- drop table CARRERA_POR_MATERIA;
-- 
-- drop index MATERIA_CORRELATIVA_FK;
-- 
-- drop index MATERIA_FK;
-- 
-- drop index ASOCIADO_A_FK;
-- 
-- drop index CORRELATIVA_POR_CARRERA_PK;
-- 
-- drop table CORRELATIVA_POR_CARRERA;
-- 
-- drop index PERTENECE_A_FK;
-- 
-- drop index CURSOS_PK;
-- 
-- drop table CURSOS;
-- 
-- drop index DEPARTAMENTOS_PK;
-- 
-- drop table DEPARTAMENTOS;
-- 
-- drop index PARTE_DE_FK;
-- 
-- drop index TIENE_FK4;
-- 
-- drop index HISTORIAL_EXTRAORDINARIOS_PK;
-- 
-- drop table HISTORIAL_EXTRAORDINARIOS;
-- 
-- drop index SIGUE_FK;
-- 
-- drop index HORARIOS_DE_CLASE_PK;
-- 
-- drop table HORARIOS_DE_CLASE;
-- 
-- drop index TIENE_FK7;
-- 
-- drop index HORARIOS_DE_EXAMEN_PK;
-- 
-- drop table HORARIOS_DE_EXAMEN;
-- 
-- drop index INCLUYE_FK;
-- 
-- drop index INSCRIPTO_A_FK;
-- 
-- drop index INSCRIPCION_EXAMEN_POR_ALUMNO_PK;
-- 
-- drop table INSCRIPCION_EXAMEN_POR_ALUMNO;
-- 
-- drop index MATERIAS_PK;
-- 
-- drop table MATERIAS;
-- 
-- drop index PROFESORES_PK;
-- 
-- drop table PROFESORES;
-- 
-- drop index ENSENHA_FK2;
-- 
-- drop index ENSENHA_FK;
-- 
-- drop index ENSENHA_PK;
-- 
-- drop table PROFESORES_POR_CURSO;
-- 
-- drop domain D_ANHO;
-- 
-- drop domain D_APELLIDO_USUARIO;
-- 
-- drop domain D_ASISTENCIA;
-- 
-- drop domain D_ASUNTO_SOLICITUD;
-- 
-- drop domain D_BOOLEAN;
-- 
-- drop domain D_CALIFICACION;
-- 
-- drop domain D_CANTIDAD;
-- 
-- drop domain D_CARRERA;
-- 
-- drop domain D_CEDULA;
-- 
-- drop domain D_CONTRASENA;
-- 
-- drop domain D_CORREO;
-- 
-- drop domain D_CUENTA;
-- 
-- drop domain D_CURSO;
-- 
-- drop domain D_DEPARTAMENTO;
-- 
-- drop domain D_DESCRIPCION_ACTIVIDADES;
-- 
-- drop domain D_DESCRIPCION_LOG;
-- 
-- drop domain D_DESCRIPCION_PERMISO;
-- 
-- drop domain D_DIA;
-- 
-- drop domain D_DIRECCION;
-- 
-- drop domain D_DIRECCION_EMAIL;
-- 
-- drop domain D_DOCUMENT_ID;
-- 
-- drop domain D_EMAIL;
-- 
-- drop domain D_ESTADO_CUENTA;
-- 
-- drop domain D_ESTADO_SOLICITUD;
-- 
-- drop domain D_ETAPA_ACTUAL;
-- 
-- drop domain D_FECHA;
-- 
-- drop domain D_FECHAHORA;
-- 
-- drop domain D_FILE;
-- 
-- drop domain D_HISTORIAL;
-- 
-- drop domain D_HORA;
-- 
-- drop domain D_HORARIO;
-- 
-- drop domain D_MATERIA;
-- 
-- drop domain D_MATRICULA;
-- 
-- drop domain D_MESA_ENTRADA;
-- 
-- drop domain D_MOTIVO;
-- 
-- drop domain D_NOMBRE_CARRERA;
-- 
-- drop domain D_NOMBRE_DEPARTAMENTO;
-- 
-- drop domain D_NOMBRE_LOG;
-- 
-- drop domain D_NOMBRE_LUGAR;
-- 
-- drop domain D_NOMBRE_MATERIA;
-- 
-- drop domain D_NOMBRE_PERMISO;
-- 
-- drop domain D_NOMBRE_ROL;
-- 
-- drop domain D_NOMBRE_TESIS;
-- 
-- drop domain D_NOMBRE_TITULO;
-- 
-- drop domain D_NOMBRE_UNIVERSIDAD;
-- 
-- drop domain D_NOMBRE_USUARIO;
-- 
-- drop domain D_NUM_ARCHIVO;
-- 
-- drop domain D_NUM_LOG;
-- 
-- drop domain D_OBSERVACIONES;
-- 
-- drop domain D_OPORTUNIDAD;
-- 
-- drop domain D_PARAMETRO;
-- 
-- drop domain D_PERMISO;
-- 
-- drop domain D_PROFESOR;
-- 
-- drop domain D_RESULTADO_REQUISITO;
-- 
-- drop domain D_ROL;
-- 
-- drop domain D_SECCION;
-- 
-- drop domain D_SEMESTRE;
-- 
-- drop domain D_SEXO;
-- 
-- drop domain D_SOLICITUD;
-- 
-- drop domain D_TELEFONO;
-- 
-- drop domain D_TEXTO_EMAIL;
-- 
-- drop domain D_TEXTO_LOG;
-- 
-- drop domain D_TIME;
-- 
-- drop domain D_TIPO_CERTIFICADO;
-- 
-- drop domain D_TIPO_TITULO;
-- 
-- drop domain D_USUARIO;

/*==============================================================*/
/* Domain: D_ANHO                                               */
/*==============================================================*/
create domain D_ANHO as INT4;

/*==============================================================*/
/* Domain: D_APELLIDO_USUARIO                                   */
/*==============================================================*/
create domain D_APELLIDO_USUARIO as VARCHAR(80);

/*==============================================================*/
/* Domain: D_ASISTENCIA                                         */
/*==============================================================*/
create domain D_ASISTENCIA as INT4;

/*==============================================================*/
/* Domain: D_ASUNTO_SOLICITUD                                   */
/*==============================================================*/
create domain D_ASUNTO_SOLICITUD as CHAR(80);

/*==============================================================*/
/* Domain: D_BOOLEAN                                            */
/*==============================================================*/
create domain D_BOOLEAN as BOOL;

/*==============================================================*/
/* Domain: D_CALIFICACION                                       */
/*==============================================================*/
create domain D_CALIFICACION as INT4;

/*==============================================================*/
/* Domain: D_CANTIDAD                                           */
/*==============================================================*/
create domain D_CANTIDAD as INT4;

/*==============================================================*/
/* Domain: D_CARRERA                                            */
/*==============================================================*/
create domain D_CARRERA as INT4;

/*==============================================================*/
/* Domain: D_CEDULA                                             */
/*==============================================================*/
create domain D_CEDULA as INT4;

/*==============================================================*/
/* Domain: D_CONTRASENA                                         */
/*==============================================================*/
create domain D_CONTRASENA as VARCHAR(100);

/*==============================================================*/
/* Domain: D_CORREO                                             */
/*==============================================================*/
create domain D_CORREO as INT4;

/*==============================================================*/
/* Domain: D_CUENTA                                             */
/*==============================================================*/
create domain D_CUENTA as INT4;

/*==============================================================*/
/* Domain: D_CURSO                                              */
/*==============================================================*/
create domain D_CURSO as INT4;

/*==============================================================*/
/* Domain: D_DEPARTAMENTO                                       */
/*==============================================================*/
create domain D_DEPARTAMENTO as INT4;

/*==============================================================*/
/* Domain: D_DESCRIPCION_ACTIVIDADES                            */
/*==============================================================*/
create domain D_DESCRIPCION_ACTIVIDADES as TEXT;

/*==============================================================*/
/* Domain: D_DESCRIPCION_LOG                                    */
/*==============================================================*/
create domain D_DESCRIPCION_LOG as TEXT;

/*==============================================================*/
/* Domain: D_DESCRIPCION_PERMISO                                */
/*==============================================================*/
create domain D_DESCRIPCION_PERMISO as TEXT;

/*==============================================================*/
/* Domain: D_DIA                                                */
/*==============================================================*/
create domain D_DIA as INT4;

/*==============================================================*/
/* Domain: D_DIRECCION                                          */
/*==============================================================*/
create domain D_DIRECCION as CHAR(120);

/*==============================================================*/
/* Domain: D_DIRECCION_EMAIL                                    */
/*==============================================================*/
create domain D_DIRECCION_EMAIL as CHAR(255);

/*==============================================================*/
/* Domain: D_DOCUMENT_ID                                        */
/*==============================================================*/
create domain D_DOCUMENT_ID as INT4;

/*==============================================================*/
/* Domain: D_EMAIL                                              */
/*==============================================================*/
create domain D_EMAIL as CHAR(80);

/*==============================================================*/
/* Domain: D_ESTADO_CUENTA                                      */
/*==============================================================*/
create domain D_ESTADO_CUENTA as CHAR(1);

/*==============================================================*/
/* Domain: D_ESTADO_SOLICITUD                                   */
/*==============================================================*/
create domain D_ESTADO_SOLICITUD as CHAR(6);

/*==============================================================*/
/* Domain: D_ETAPA_ACTUAL                                       */
/*==============================================================*/
create domain D_ETAPA_ACTUAL as CHAR(6);

/*==============================================================*/
/* Domain: D_FECHA                                              */
/*==============================================================*/
create domain D_FECHA as DATE;

/*==============================================================*/
/* Domain: D_FECHAHORA                                          */
/*==============================================================*/
create domain D_FECHAHORA as DATE;

/*==============================================================*/
/* Domain: D_HISTORIAL                                          */
/*==============================================================*/
create domain D_HISTORIAL as INT4;

/*==============================================================*/
/* Domain: D_HORA                                               */
/*==============================================================*/
create domain D_HORA as TIME;

/*==============================================================*/
/* Domain: D_HORARIO                                            */
/*==============================================================*/
create domain D_HORARIO as INT4;

/*==============================================================*/
/* Domain: D_MATERIA                                            */
/*==============================================================*/
create domain D_MATERIA as INT4;

/*==============================================================*/
/* Domain: D_MATRICULA                                          */
/*==============================================================*/
create domain D_MATRICULA as INT4;

/*==============================================================*/
/* Domain: D_MESA_ENTRADA                                       */
/*==============================================================*/
create domain D_MESA_ENTRADA as CHAR(30);

/*==============================================================*/
/* Domain: D_MOTIVO                                             */
/*==============================================================*/
create domain D_MOTIVO as TEXT;

/*==============================================================*/
/* Domain: D_NOMBRE_CARRERA                                     */
/*==============================================================*/
create domain D_NOMBRE_CARRERA as CHAR(80);

/*==============================================================*/
/* Domain: D_NOMBRE_DEPARTAMENTO                                */
/*==============================================================*/
create domain D_NOMBRE_DEPARTAMENTO as CHAR(80);

/*==============================================================*/
/* Domain: D_NOMBRE_LOG                                         */
/*==============================================================*/
create domain D_NOMBRE_LOG as CHAR(80);

/*==============================================================*/
/* Domain: D_NOMBRE_LUGAR                                       */
/*==============================================================*/
create domain D_NOMBRE_LUGAR as CHAR(80);

/*==============================================================*/
/* Domain: D_NOMBRE_MATERIA                                     */
/*==============================================================*/
create domain D_NOMBRE_MATERIA as CHAR(80);

/*==============================================================*/
/* Domain: D_NOMBRE_PERMISO                                     */
/*==============================================================*/
create domain D_NOMBRE_PERMISO as CHAR(80);

/*==============================================================*/
/* Domain: D_NOMBRE_ROL                                         */
/*==============================================================*/
create domain D_NOMBRE_ROL as CHAR(80);

/*==============================================================*/
/* Domain: D_NOMBRE_TESIS                                       */
/*==============================================================*/
create domain D_NOMBRE_TESIS as CHAR(80);

/*==============================================================*/
/* Domain: D_NOMBRE_TITULO                                      */
/*==============================================================*/
create domain D_NOMBRE_TITULO as CHAR(60);

/*==============================================================*/
/* Domain: D_NOMBRE_UNIVERSIDAD                                 */
/*==============================================================*/
create domain D_NOMBRE_UNIVERSIDAD as CHAR(40);

/*==============================================================*/
/* Domain: D_NOMBRE_USUARIO                                     */
/*==============================================================*/
create domain D_NOMBRE_USUARIO as VARCHAR(80);

/*==============================================================*/
/* Domain: D_NUM_ARCHIVO                                        */
/*==============================================================*/
create domain D_NUM_ARCHIVO as INT4;

/*==============================================================*/
/* Domain: D_NUM_LOG                                            */
/*==============================================================*/
create domain D_NUM_LOG as INT4;

/*==============================================================*/
/* Domain: D_OBSERVACIONES                                      */
/*==============================================================*/
create domain D_OBSERVACIONES as TEXT;

/*==============================================================*/
/* Domain: D_OPORTUNIDAD                                        */
/*==============================================================*/
create domain D_OPORTUNIDAD as INT4;

/*==============================================================*/
/* Domain: D_PARAMETRO                                          */
/*==============================================================*/
create domain D_PARAMETRO as INT4;

/*==============================================================*/
/* Domain: D_PERMISO                                            */
/*==============================================================*/
create domain D_PERMISO as INT4;

/*==============================================================*/
/* Domain: D_PROFESOR                                           */
/*==============================================================*/
create domain D_PROFESOR as INT4;

/*==============================================================*/
/* Domain: D_RESULTADO_REQUISITO                                */
/*==============================================================*/
create domain D_RESULTADO_REQUISITO as CHAR(13);

/*==============================================================*/
/* Domain: D_ROL                                                */
/*==============================================================*/
create domain D_ROL as INT4;

/*==============================================================*/
/* Domain: D_SECCION                                            */
/*==============================================================*/
create domain D_SECCION as CHAR(1);

/*==============================================================*/
/* Domain: D_SEMESTRE                                           */
/*==============================================================*/
create domain D_SEMESTRE as INT4;

/*==============================================================*/
/* Domain: D_SEXO                                               */
/*==============================================================*/
create domain D_SEXO as CHAR(1);

/*==============================================================*/
/* Domain: D_SOLICITUD                                          */
/*==============================================================*/
create domain D_SOLICITUD as INT4;

/*==============================================================*/
/* Domain: D_TELEFONO                                           */
/*==============================================================*/
create domain D_TELEFONO as VARCHAR(30);

/*==============================================================*/
/* Domain: D_TEXTO_EMAIL                                        */
/*==============================================================*/
create domain D_TEXTO_EMAIL as TEXT;

/*==============================================================*/
/* Domain: D_TEXTO_LOG                                          */
/*==============================================================*/
create domain D_TEXTO_LOG as TEXT;

/*==============================================================*/
/* Domain: D_TIME                                               */
/*==============================================================*/
create domain D_TIME as TIME;

/*==============================================================*/
/* Domain: D_TIPO_CERTIFICADO                                   */
/*==============================================================*/
create domain D_TIPO_CERTIFICADO as CHAR(1);

/*==============================================================*/
/* Domain: D_TIPO_TITULO                                        */
/*==============================================================*/
create domain D_TIPO_TITULO as CHAR(15);

/*==============================================================*/
/* Domain: D_USUARIO                                            */
/*==============================================================*/
create domain D_USUARIO as INT4;

/*==============================================================*/
/* Table: ALUMNOS                                               */
/*==============================================================*/
create table ALUMNOS (
   CEDULA               D_MATRICULA          not null,
   constraint PK_ALUMNOS primary key (CEDULA)
);

/*==============================================================*/
/* Index: ALUMNOS_PK                                            */
/*==============================================================*/
create unique index ALUMNOS_PK on ALUMNOS (
CEDULA
);

/*==============================================================*/
/* Table: ALUMNO_POR_CARRERA                                    */
/*==============================================================*/
create table ALUMNO_POR_CARRERA (
   CEDULA               D_MATRICULA          not null,
   CARRERA              D_CARRERA            not null,
   constraint PK_ALUMNO_POR_CARRERA primary key (CEDULA, CARRERA)
);

/*==============================================================*/
/* Index: SIGUE_PK                                              */
/*==============================================================*/
create unique index SIGUE_PK on ALUMNO_POR_CARRERA (
CEDULA,
CARRERA
);

/*==============================================================*/
/* Index: SIGUE_FK2                                             */
/*==============================================================*/
create  index SIGUE_FK2 on ALUMNO_POR_CARRERA (
CEDULA
);

/*==============================================================*/
/* Index: SIGUE_FK3                                             */
/*==============================================================*/
create  index SIGUE_FK3 on ALUMNO_POR_CARRERA (
CARRERA
);

/*==============================================================*/
/* Table: ALUMNO_POR_CURSO                                      */
/*==============================================================*/
create table ALUMNO_POR_CURSO (
   CEDULA               D_MATRICULA          not null,
   CURSO                D_CURSO              not null,
   constraint PK_ALUMNO_POR_CURSO primary key (CEDULA, CURSO)
);

/*==============================================================*/
/* Index: INSCRIPTO_A_PK                                        */
/*==============================================================*/
create unique index INSCRIPTO_A_PK on ALUMNO_POR_CURSO (
CEDULA,
CURSO
);

/*==============================================================*/
/* Index: INSCRIPTO_A_FK2                                       */
/*==============================================================*/
create  index INSCRIPTO_A_FK2 on ALUMNO_POR_CURSO (
CEDULA
);

/*==============================================================*/
/* Index: INSCRIPTO_A_FK3                                       */
/*==============================================================*/
create  index INSCRIPTO_A_FK3 on ALUMNO_POR_CURSO (
CURSO
);

/*==============================================================*/
/* Table: ASISTENCIAS_POR_ALUMNO                                */
/*==============================================================*/
create table ASISTENCIAS_POR_ALUMNO (
   ASISTENCIA           D_ASISTENCIA         not null,
   CEDULA               D_MATRICULA          null,
   CURSO                D_CURSO              null,
   FECHA_HORA           D_FECHAHORA          not null,
   PRESENCIA            D_BOOLEAN            null,
   constraint PK_ASISTENCIAS_POR_ALUMNO primary key (ASISTENCIA)
);

/*==============================================================*/
/* Index: ASISTENCIAS_POR_ALUMNO_PK                             */
/*==============================================================*/
create unique index ASISTENCIAS_POR_ALUMNO_PK on ASISTENCIAS_POR_ALUMNO (
ASISTENCIA
);

/*==============================================================*/
/* Index: TIENE_FK5                                             */
/*==============================================================*/
create  index TIENE_FK5 on ASISTENCIAS_POR_ALUMNO (
CURSO
);

/*==============================================================*/
/* Index: TIENE_FK6                                             */
/*==============================================================*/
create  index TIENE_FK6 on ASISTENCIAS_POR_ALUMNO (
CEDULA
);

/*==============================================================*/
/* Table: CALIFICACIONES_POR_ALUMNO                             */
/*==============================================================*/
create table CALIFICACIONES_POR_ALUMNO (
   CEDULA               D_MATRICULA          not null,
   CURSO                D_CURSO              not null,
   CALIFICACION         D_CALIFICACION       not null,
   constraint PK_CALIFICACIONES_POR_ALUMNO primary key (CEDULA, CURSO)
);

/*==============================================================*/
/* Index: CALIFICACIONES_POR_ALUMNO_PK                          */
/*==============================================================*/
create unique index CALIFICACIONES_POR_ALUMNO_PK on CALIFICACIONES_POR_ALUMNO (
CEDULA,
CURSO
);

/*==============================================================*/
/* Index: TIENE_FK2                                             */
/*==============================================================*/
create  index TIENE_FK2 on CALIFICACIONES_POR_ALUMNO (
CEDULA
);

/*==============================================================*/
/* Index: TIENE_FK3                                             */
/*==============================================================*/
create  index TIENE_FK3 on CALIFICACIONES_POR_ALUMNO (
CURSO
);

/*==============================================================*/
/* Table: CARRERAS                                              */
/*==============================================================*/
create table CARRERAS (
   CARRERA              D_CARRERA            not null,
   DEPARTAMENTO         D_DEPARTAMENTO       not null,
   NOMBRE               D_NOMBRE_CARRERA     not null,
   CREDITOS_REQUERIDOS  D_CANTIDAD           null,
   constraint PK_CARRERAS primary key (CARRERA)
);

/*==============================================================*/
/* Index: CARRERAS_PK                                           */
/*==============================================================*/
create unique index CARRERAS_PK on CARRERAS (
CARRERA
);

/*==============================================================*/
/* Index: TIENE_FK                                              */
/*==============================================================*/
create  index TIENE_FK on CARRERAS (
DEPARTAMENTO
);

/*==============================================================*/
/* Table: CARRERA_POR_MATERIA                                   */
/*==============================================================*/
create table CARRERA_POR_MATERIA (
   CARRERA              D_CARRERA            not null,
   MATERIA              D_MATERIA            not null,
   constraint PK_CARRERA_POR_MATERIA primary key (CARRERA, MATERIA)
);

/*==============================================================*/
/* Index: TIENE_PK                                              */
/*==============================================================*/
create unique index TIENE_PK on CARRERA_POR_MATERIA (
CARRERA,
MATERIA
);

/*==============================================================*/
/* Index: TIENE_FK8                                             */
/*==============================================================*/
create  index TIENE_FK8 on CARRERA_POR_MATERIA (
CARRERA
);

/*==============================================================*/
/* Index: TIENE_FK9                                             */
/*==============================================================*/
create  index TIENE_FK9 on CARRERA_POR_MATERIA (
MATERIA
);

/*==============================================================*/
/* Table: CORRELATIVA_POR_CARRERA                               */
/*==============================================================*/
create table CORRELATIVA_POR_CARRERA (
   CARRERA              D_CARRERA            not null,
   MATERIA              D_MATERIA            not null,
   MAT_MATERIA          D_MATERIA            not null,
   SEMESTRE_CARRERA     D_SEMESTRE           not null,
   constraint PK_CORRELATIVA_POR_CARRERA primary key (CARRERA, MATERIA, MAT_MATERIA)
);

/*==============================================================*/
/* Index: CORRELATIVA_POR_CARRERA_PK                            */
/*==============================================================*/
create unique index CORRELATIVA_POR_CARRERA_PK on CORRELATIVA_POR_CARRERA (
CARRERA,
MATERIA,
MAT_MATERIA
);

/*==============================================================*/
/* Index: ASOCIADO_A_FK                                         */
/*==============================================================*/
create  index ASOCIADO_A_FK on CORRELATIVA_POR_CARRERA (
CARRERA
);

/*==============================================================*/
/* Index: MATERIA_FK                                            */
/*==============================================================*/
create  index MATERIA_FK on CORRELATIVA_POR_CARRERA (
MATERIA
);

/*==============================================================*/
/* Index: MATERIA_CORRELATIVA_FK                                */
/*==============================================================*/
create  index MATERIA_CORRELATIVA_FK on CORRELATIVA_POR_CARRERA (
MAT_MATERIA
);

/*==============================================================*/
/* Table: CURSOS                                                */
/*==============================================================*/
create table CURSOS (
   CURSO                D_CURSO              not null,
   MATERIA              D_MATERIA            not null,
   SEMESTRE_CARRERA     D_SEMESTRE           not null,
   SEMESTRE_ANHO        D_SEMESTRE           not null,
   ANHO                 D_ANHO               not null,
   SECCION              D_SECCION            not null,
   constraint PK_CURSOS primary key (CURSO)
);

/*==============================================================*/
/* Index: CURSOS_PK                                             */
/*==============================================================*/
create unique index CURSOS_PK on CURSOS (
CURSO
);

/*==============================================================*/
/* Index: PERTENECE_A_FK                                        */
/*==============================================================*/
create  index PERTENECE_A_FK on CURSOS (
MATERIA
);

/*==============================================================*/
/* Table: DEPARTAMENTOS                                         */
/*==============================================================*/
create table DEPARTAMENTOS (
   DEPARTAMENTO         D_DEPARTAMENTO       not null,
   NOMBRE               D_NOMBRE_DEPARTAMENTO not null,
   constraint PK_DEPARTAMENTOS primary key (DEPARTAMENTO)
);

/*==============================================================*/
/* Index: DEPARTAMENTOS_PK                                      */
/*==============================================================*/
create unique index DEPARTAMENTOS_PK on DEPARTAMENTOS (
DEPARTAMENTO
);

/*==============================================================*/
/* Table: HISTORIAL_EXTRAORDINARIOS                             */
/*==============================================================*/
create table HISTORIAL_EXTRAORDINARIOS (
   HISTORIAL            D_HISTORIAL          not null,
   CEDULA               D_MATRICULA          not null,
   CURSO                D_CURSO              not null,
   FECHA_HORA           D_FECHAHORA          not null,
   constraint PK_HISTORIAL_EXTRAORDINARIOS primary key (HISTORIAL)
);

/*==============================================================*/
/* Index: HISTORIAL_EXTRAORDINARIOS_PK                          */
/*==============================================================*/
create unique index HISTORIAL_EXTRAORDINARIOS_PK on HISTORIAL_EXTRAORDINARIOS (
HISTORIAL
);

/*==============================================================*/
/* Index: TIENE_FK4                                             */
/*==============================================================*/
create  index TIENE_FK4 on HISTORIAL_EXTRAORDINARIOS (
CEDULA
);

/*==============================================================*/
/* Index: PARTE_DE_FK                                           */
/*==============================================================*/
create  index PARTE_DE_FK on HISTORIAL_EXTRAORDINARIOS (
CURSO
);

/*==============================================================*/
/* Table: HORARIOS_DE_CLASE                                     */
/*==============================================================*/
create table HORARIOS_DE_CLASE (
   HORARIO              D_HORARIO            not null,
   CURSO                D_CURSO              not null,
   DIA                  D_DIA                not null,
   HORA_INICIO          D_HORA               not null,
   HORA_FIN             D_HORA               not null,
   constraint PK_HORARIOS_DE_CLASE primary key (HORARIO)
);

/*==============================================================*/
/* Index: HORARIOS_DE_CLASE_PK                                  */
/*==============================================================*/
create unique index HORARIOS_DE_CLASE_PK on HORARIOS_DE_CLASE (
HORARIO
);

/*==============================================================*/
/* Index: SIGUE_FK                                              */
/*==============================================================*/
create  index SIGUE_FK on HORARIOS_DE_CLASE (
CURSO
);

/*==============================================================*/
/* Table: HORARIOS_DE_EXAMEN                                    */
/*==============================================================*/
create table HORARIOS_DE_EXAMEN (
   HORARIO_DE_EXAMEN    D_HORARIO            not null,
   CURSO                D_CURSO              null,
   FECHA_HORA           D_FECHAHORA          not null,
   OPORTUNIDAD          D_OPORTUNIDAD        not null,
   constraint PK_HORARIOS_DE_EXAMEN primary key (HORARIO_DE_EXAMEN)
);

/*==============================================================*/
/* Index: HORARIOS_DE_EXAMEN_PK                                 */
/*==============================================================*/
create unique index HORARIOS_DE_EXAMEN_PK on HORARIOS_DE_EXAMEN (
HORARIO_DE_EXAMEN
);

/*==============================================================*/
/* Index: TIENE_FK7                                             */
/*==============================================================*/
create  index TIENE_FK7 on HORARIOS_DE_EXAMEN (
CURSO
);

/*==============================================================*/
/* Table: INSCRIPCION_EXAMEN_POR_ALUMNO                         */
/*==============================================================*/
create table INSCRIPCION_EXAMEN_POR_ALUMNO (
   CEDULA               D_MATRICULA          not null,
   CURSO                D_CURSO              not null,
   OPORTUNIDAD          D_OPORTUNIDAD        not null,
   FECHA_HORA_EXAMEN    D_FECHAHORA          not null,
   PRESENCIA            D_BOOLEAN            null,
   constraint PK_INSCRIPCION_EXAMEN_POR_ALUM primary key (CEDULA, CURSO, OPORTUNIDAD)
);

/*==============================================================*/
/* Index: INSCRIPCION_EXAMEN_POR_ALUMNO_PK                      */
/*==============================================================*/
create unique index INSCRIPCION_EXAMEN_POR_ALUMNO_PK on INSCRIPCION_EXAMEN_POR_ALUMNO (
CEDULA,
CURSO,
OPORTUNIDAD
);

/*==============================================================*/
/* Index: INSCRIPTO_A_FK                                        */
/*==============================================================*/
create  index INSCRIPTO_A_FK on INSCRIPCION_EXAMEN_POR_ALUMNO (
CEDULA
);

/*==============================================================*/
/* Index: INCLUYE_FK                                            */
/*==============================================================*/
create  index INCLUYE_FK on INSCRIPCION_EXAMEN_POR_ALUMNO (
CURSO
);

/*==============================================================*/
/* Table: MATERIAS                                              */
/*==============================================================*/
create table MATERIAS (
   MATERIA              D_MATERIA            not null,
   NOMBRE               D_NOMBRE_MATERIA     null,
   constraint PK_MATERIAS primary key (MATERIA)
);

/*==============================================================*/
/* Index: MATERIAS_PK                                           */
/*==============================================================*/
create unique index MATERIAS_PK on MATERIAS (
MATERIA
);

/*==============================================================*/
/* Table: PROFESORES                                            */
/*==============================================================*/
create table PROFESORES (
   PROFESOR             D_PROFESOR           not null,
   NOMBRE               D_NOMBRE_USUARIO     null,
   constraint PK_PROFESORES primary key (PROFESOR)
);

/*==============================================================*/
/* Index: PROFESORES_PK                                         */
/*==============================================================*/
create unique index PROFESORES_PK on PROFESORES (
PROFESOR
);

/*==============================================================*/
/* Table: PROFESORES_POR_CURSO                                  */
/*==============================================================*/
create table PROFESORES_POR_CURSO (
   PROFESOR             D_PROFESOR           not null,
   CURSO                D_CURSO              not null,
   constraint PK_PROFESORES_POR_CURSO primary key (PROFESOR, CURSO)
);

/*==============================================================*/
/* Index: ENSENHA_PK                                            */
/*==============================================================*/
create unique index ENSENHA_PK on PROFESORES_POR_CURSO (
PROFESOR,
CURSO
);

/*==============================================================*/
/* Index: ENSENHA_FK                                            */
/*==============================================================*/
create  index ENSENHA_FK on PROFESORES_POR_CURSO (
PROFESOR
);

/*==============================================================*/
/* Index: ENSENHA_FK2                                           */
/*==============================================================*/
create  index ENSENHA_FK2 on PROFESORES_POR_CURSO (
CURSO
);

alter table ALUMNO_POR_CARRERA
   add constraint FK_ALUMNO_P_SIGUE_ALUMNOS foreign key (CEDULA)
      references ALUMNOS (CEDULA)
      on delete restrict on update restrict;

alter table ALUMNO_POR_CARRERA
   add constraint FK_ALUMNO_P_SIGUE_CARRERAS foreign key (CARRERA)
      references CARRERAS (CARRERA)
      on delete restrict on update restrict;

alter table ALUMNO_POR_CURSO
   add constraint FK_ALUMNO_P_INSCRIPTO_ALUMNOS foreign key (CEDULA)
      references ALUMNOS (CEDULA)
      on delete restrict on update restrict;

alter table ALUMNO_POR_CURSO
   add constraint FK_ALUMNO_P_INSCRIPTO_CURSOS foreign key (CURSO)
      references CURSOS (CURSO)
      on delete restrict on update restrict;

alter table ASISTENCIAS_POR_ALUMNO
   add constraint FK_ASISTENC_TIENE_ALUMNOS foreign key (CEDULA)
      references ALUMNOS (CEDULA)
      on delete restrict on update restrict;

alter table ASISTENCIAS_POR_ALUMNO
   add constraint FK_ASISTENC_TIENE_CURSOS foreign key (CURSO)
      references CURSOS (CURSO)
      on delete restrict on update restrict;

alter table CALIFICACIONES_POR_ALUMNO
   add constraint FK_CALIFICA_TIENE_ALUMNOS foreign key (CEDULA)
      references ALUMNOS (CEDULA)
      on delete restrict on update restrict;

alter table CALIFICACIONES_POR_ALUMNO
   add constraint FK_CALIFICA_TIENE_CURSOS foreign key (CURSO)
      references CURSOS (CURSO)
      on delete restrict on update restrict;

alter table CARRERAS
   add constraint FK_CARRERAS_TIENE_DEPARTAM foreign key (DEPARTAMENTO)
      references DEPARTAMENTOS (DEPARTAMENTO)
      on delete restrict on update restrict;

alter table CARRERA_POR_MATERIA
   add constraint FK_CARRERA__TIENE_CARRERAS foreign key (CARRERA)
      references CARRERAS (CARRERA)
      on delete restrict on update restrict;

alter table CARRERA_POR_MATERIA
   add constraint FK_CARRERA__TIENE_MATERIAS foreign key (MATERIA)
      references MATERIAS (MATERIA)
      on delete restrict on update restrict;

alter table CORRELATIVA_POR_CARRERA
   add constraint FK_CORRELAT_ASOCIADO__CARRERAS foreign key (CARRERA)
      references CARRERAS (CARRERA)
      on delete restrict on update restrict;

alter table CORRELATIVA_POR_CARRERA
   add constraint FK_CORRELAT_MATERIA_MATERIAS foreign key (MATERIA)
      references MATERIAS (MATERIA)
      on delete restrict on update restrict;

alter table CORRELATIVA_POR_CARRERA
   add constraint FK_CORRELAT_MATERIA_C_MATERIAS foreign key (MAT_MATERIA)
      references MATERIAS (MATERIA)
      on delete restrict on update restrict;

alter table CURSOS
   add constraint FK_CURSOS_PERTENECE_MATERIAS foreign key (MATERIA)
      references MATERIAS (MATERIA)
      on delete restrict on update restrict;

alter table HISTORIAL_EXTRAORDINARIOS
   add constraint FK_HISTORIA_PARTE_DE_CURSOS foreign key (CURSO)
      references CURSOS (CURSO)
      on delete restrict on update restrict;

alter table HISTORIAL_EXTRAORDINARIOS
   add constraint FK_HISTORIA_TIENE_ALUMNOS foreign key (CEDULA)
      references ALUMNOS (CEDULA)
      on delete restrict on update restrict;

alter table HORARIOS_DE_CLASE
   add constraint FK_HORARIOS_SIGUE_CURSOS foreign key (CURSO)
      references CURSOS (CURSO)
      on delete restrict on update restrict;

alter table HORARIOS_DE_EXAMEN
   add constraint FK_HORARIOS_TIENE_CURSOS foreign key (CURSO)
      references CURSOS (CURSO)
      on delete restrict on update restrict;

alter table INSCRIPCION_EXAMEN_POR_ALUMNO
   add constraint FK_INSCRIPC_INCLUYE_CURSOS foreign key (CURSO)
      references CURSOS (CURSO)
      on delete restrict on update restrict;

alter table INSCRIPCION_EXAMEN_POR_ALUMNO
   add constraint FK_INSCRIPC_INSCRIPTO_ALUMNOS foreign key (CEDULA)
      references ALUMNOS (CEDULA)
      on delete restrict on update restrict;

alter table PROFESORES_POR_CURSO
   add constraint FK_PROFESOR_ENSENHA_CURSOS foreign key (CURSO)
      references CURSOS (CURSO)
      on delete restrict on update restrict;

alter table PROFESORES_POR_CURSO
   add constraint FK_PROFESOR_ENSENHA_PROFESOR foreign key (PROFESOR)
      references PROFESORES (PROFESOR)
      on delete restrict on update restrict;

