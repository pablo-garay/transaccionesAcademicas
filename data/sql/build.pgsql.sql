/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     6/3/2014 12:44:54 PM                         */
/*==============================================================*/


-- drop index TIENE_FK3;
-- 
-- drop index ASIGNATURAS_POR_SOLICITUD_PK;
-- 
-- drop table ASIGNATURAS_POR_SOLICITUD;
-- 
-- drop index CREDITOS_POR_CARRERA_PK;
-- 
-- drop table CREDITOS_POR_CARRERA;
-- 
-- drop index TIENE_FK;
-- 
-- drop index DOCUMENTOS_ADJUNTOS_PK;
-- 
-- drop table DOCUMENTOS_ADJUNTOS;
-- 
-- drop index FECHAS_DE_RESOLUCION_DE_SOLICITUDES_PK;
-- 
-- drop table FECHAS_DE_RESOLUCION_DE_SOLICITUDES;
-- 
-- drop index TIENE_FK2;
-- 
-- drop index HISTORIAL_EXTRAORDINARIOS_PK;
-- 
-- drop table HISTORIAL_EXTRAORDINARIOS;
-- 
-- drop table PARAMETROS_REQUISITOS;
-- 
-- drop index PERMISOS_PK;
-- 
-- drop table PERMISOS;
-- 
-- drop index CONTIENE_FK3;
-- 
-- drop index CONTIENE_FK2;
-- 
-- drop index CONTIENE_PK;
-- 
-- drop table PERMISOS_POR_ROL;
-- 
-- drop index ROLES_PK;
-- 
-- drop table ROLES;
-- 
-- drop index TIENE_ASIGNADO_FK2;
-- 
-- drop index TIENE_ASIGNADO_FK;
-- 
-- drop index TIENE_ASIGNADO_PK;
-- 
-- drop table ROLES_POR_USUARIO;
-- 
-- drop index HECHA_POR_FK;
-- 
-- drop index SOLICITUDES_PK;
-- 
-- drop table SOLICITUDES;
-- 
-- drop index SOLICITUDES_VARIAS_PK;
-- 
-- drop table SOLICITUDES_VARIAS;
-- 
-- drop index SOLICITUD_DE_CAMBIO_DE_SECCION_PK;
-- 
-- drop table SOLICITUD_DE_CAMBIO_DE_SECCION;
-- 
-- drop index SOLICITUD_DE_CERTIFICADO_DE_ESTUDIOS_PK;
-- 
-- drop table SOLICITUD_DE_CERTIFICADO_DE_ESTUDIOS;
-- 
-- drop index SOLICITUD_DE_COLABORADOR_DE_CATEDRA_PK;
-- 
-- drop table SOLICITUD_DE_COLABORADOR_DE_CATEDRA;
-- 
-- drop index SOLICITUD_DE_CONVALIDACION_DE_MATERIAS_PK;
-- 
-- drop table SOLICITUD_DE_CONVALIDACION_DE_MATERIAS;
-- 
-- drop index SOLICITUD_DE_CREDITOS_ACADEMICOS_PK;
-- 
-- drop table SOLICITUD_DE_CREDITOS_ACADEMICOS;
-- 
-- drop index SOLICITUD_DE_DESINSCRIPCION_DE_CURSO_PK;
-- 
-- drop table SOLICITUD_DE_DESINSCRIPCION_DE_CURSO;
-- 
-- drop index SOLICITUD_DE_EXONERACION_PK;
-- 
-- drop table SOLICITUD_DE_EXONERACION;
-- 
-- drop index SOLICITUD_DE_EXTRAORDINARIO_PK;
-- 
-- drop table SOLICITUD_DE_EXTRAORDINARIO;
-- 
-- drop index SOLICITUD_DE_HOMOLOGACION_DE_MATERIAS_PK;
-- 
-- drop table SOLICITUD_DE_HOMOLOGACION_DE_MATERIAS;
-- 
-- drop index SOLICITUD_DE_INCLUSION_EN_LISTA_PK;
-- 
-- drop table SOLICITUD_DE_INCLUSION_EN_LISTA;
-- 
-- drop index SOLICITUD_DE_INSCRIPCION_TARDIA_A_EXAMEN_PK;
-- 
-- drop table SOLICITUD_DE_INSCRIPCION_TARDIA_A_EXAMEN;
-- 
-- drop index SOLICITUD_DE_PASANTIA_PK;
-- 
-- drop table SOLICITUD_DE_PASANTIA;
-- 
-- drop index SOLICITUD_DE_REDUCCION_DE_ASISTENCIA_PK;
-- 
-- drop table SOLICITUD_DE_REDUCCION_DE_ASISTENCIA;
-- 
-- drop index SOLICITUD_DE_REVISION_DE_ESCOLARIDAD_PK;
-- 
-- drop table SOLICITUD_DE_REVISION_DE_ESCOLARIDAD;
-- 
-- drop index SOLICITUD_DE_REVISION_DE_EXAMEN_PK;
-- 
-- drop table SOLICITUD_DE_REVISION_DE_EXAMEN;
-- 
-- drop index SOLICITUD_DE_RUPTURA_DE_CORRELATIVIDAD_PK;
-- 
-- drop table SOLICITUD_DE_RUPTURA_DE_CORRELATIVIDAD;
-- 
-- drop index SOLICITUD_DE_TESIS_PK;
-- 
-- drop table SOLICITUD_DE_TESIS;
-- 
-- drop index SOLICITUD_DE_TITULO_PK;
-- 
-- drop table SOLICITUD_DE_TITULO;
-- 
-- drop index SOLICITUD_DE_TRASPASO_DE_PAGO_DE_EXAMEN_PK;
-- 
-- drop table SOLICITUD_DE_TRASPASO_DE_PAGO_DE_EXAMEN;
-- 
-- drop index SOLICITUD_DE_TUTORIA_DE_CATEDRA_PK;
-- 
-- drop table SOLICITUD_DE_TUTORIA_DE_CATEDRA;
-- 
-- drop index SOLICITUD_PARA_TOMAR_MATERIA_FUERA_DE_LA_MALLA_CURRICULAR_PK;
-- 
-- drop table SOLICITUD_PARA_TOMAR_MATERIA_FUERA_DE_LA_MALLA_CURRICULAR;
-- 
-- drop index USUARIOS_PK;
-- 
-- drop table USUARIOS;
-- 
-- drop domain D_ACTA;
-- 
-- drop domain D_ADJUNTO;
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
-- drop domain D_CODIGO_ASIGNATURA;
-- 
-- drop domain D_COMPLETO_ASIGNATURA;
-- 
-- drop domain D_COMPROBANTE;
-- 
-- drop domain D_CONTRASENA;
-- 
-- drop domain D_CORREO;
-- 
-- drop domain D_CUENTA;
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
-- drop domain D_FILENAME;
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
-- drop domain D_NOMBRE_PARAMETRO;
-- 
-- drop domain D_NOMBRE_PERMISO;
-- 
-- drop domain D_NOMBRE_ROL;
-- 
-- drop domain D_NOMBRE_SECCION;
-- 
-- drop domain D_NOMBRE_TESIS;
-- 
-- drop domain D_NOMBRE_TITULO;
-- 
-- drop domain D_NOMBRE_UNIVERSIDAD;
-- 
-- drop domain D_NOMBRE_USUARIO;
-- 
-- drop domain D_NUMERO_DOCUMENTO;
-- 
-- drop domain D_NUM_ARCHIVO;
-- 
-- drop domain D_NUM_LOG;
-- 
-- drop domain D_OBSERVACIONES;
-- 
-- drop domain D_OPORTUNIDAD;
-- 
-- drop domain D_ORIGEN_DE_DOCUMENTO;
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
-- drop domain D_TIPO_ACTIVIDAD;
-- 
-- drop domain D_TIPO_CERTIFICADO;
-- 
-- drop domain D_TIPO_DOCUMENTO;
-- 
-- drop domain D_TIPO_SOLICITUD;
-- 
-- drop domain D_TIPO_TITULO;
-- 
-- drop domain D_USUARIO;
-- 
-- drop domain D_VALOR_PARAMETRO;

/*==============================================================*/
/* Table: ASIGNATURAS_POR_SOLICITUD                             */
/*==============================================================*/
create table ASIGNATURAS_POR_SOLICITUD (
   SOLICITUD            INT4                 not null,
   ASIGNATURA           VARCHAR(80)          not null,
   SECCION              VARCHAR(6)           null,
   SEMESTRE_ANHO        INT4                 null
      constraint CKC_SEMESTRE_ANHO_ASIGNATU check (SEMESTRE_ANHO is null or (SEMESTRE_ANHO >= 1)),
   SEMESTRE             INT4                 null
      constraint CKC_SEMESTRE_ASIGNATU check (SEMESTRE is null or (SEMESTRE >= 1)),
   ANHO                 INT4                 null
      constraint CKC_ANHO_ASIGNATU check (ANHO is null or (ANHO >= 1950)),
   PORCENTAJE_ASISTENCIA_ACTUAL INT4                 null,
   PORCENTAJE_ASISTENCIA_ANTERIOR INT4                 null,
   CARRERA_DE_ASIGNATURA VARCHAR(80)          null,
   COD_ASIGNATURA       VARCHAR(30)          null,
   constraint PK_ASIGNATURAS_POR_SOLICITUD primary key (SOLICITUD, ASIGNATURA)
);

/*==============================================================*/
/* Index: ASIGNATURAS_POR_SOLICITUD_PK                          */
/*==============================================================*/
create unique index ASIGNATURAS_POR_SOLICITUD_PK on ASIGNATURAS_POR_SOLICITUD (
SOLICITUD,
ASIGNATURA
);

/*==============================================================*/
/* Index: TIENE_FK3                                             */
/*==============================================================*/
create  index TIENE_FK3 on ASIGNATURAS_POR_SOLICITUD (
SOLICITUD
);

/*==============================================================*/
/* Table: CREDITOS_POR_CARRERA                                  */
/*==============================================================*/
create table CREDITOS_POR_CARRERA (
   CARRERA              INT4                 not null,
   NOMBRE               VARCHAR(80)          not null,
   CREDITOS_REQUERIDOS  INT4                 null
      constraint CKC_CREDITOS_REQUERID_CREDITOS check (CREDITOS_REQUERIDOS is null or (CREDITOS_REQUERIDOS >= 0)),
   constraint PK_CREDITOS_POR_CARRERA primary key (CARRERA)
);

/*==============================================================*/
/* Index: CREDITOS_POR_CARRERA_PK                               */
/*==============================================================*/
create unique index CREDITOS_POR_CARRERA_PK on CREDITOS_POR_CARRERA (
CARRERA
);

/*==============================================================*/
/* Table: DOCUMENTOS_ADJUNTOS                                   */
/*==============================================================*/
create table DOCUMENTOS_ADJUNTOS (
   ID_DOCUMENTO         SERIAL not null,
   SOLICITUD            INT4                 not null,
   FECHA_ADJUNTO        DATE                 not null,
   ARCHIVO              VARCHAR(255)         not null,
   DESCRIPCION          TEXT                 null,
   TIPO                 TEXT                 null,
   constraint PK_DOCUMENTOS_ADJUNTOS primary key (ID_DOCUMENTO)
);

/*==============================================================*/
/* Index: DOCUMENTOS_ADJUNTOS_PK                                */
/*==============================================================*/
create unique index DOCUMENTOS_ADJUNTOS_PK on DOCUMENTOS_ADJUNTOS (
ID_DOCUMENTO
);

/*==============================================================*/
/* Index: TIENE_FK                                              */
/*==============================================================*/
create  index TIENE_FK on DOCUMENTOS_ADJUNTOS (
SOLICITUD
);

/*==============================================================*/
/* Table: FECHAS_DE_RESOLUCION_DE_SOLICITUDES                   */
/*==============================================================*/
create table FECHAS_DE_RESOLUCION_DE_SOLICITUDES (
   SOLICITUD            INT4                 not null,
   FECHA_RESOLUCION     DATE                 not null,
   constraint PK_FECHAS_DE_RESOLUCION_DE_SOL primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: FECHAS_DE_RESOLUCION_DE_SOLICITUDES_PK                */
/*==============================================================*/
create unique index FECHAS_DE_RESOLUCION_DE_SOLICITUDES_PK on FECHAS_DE_RESOLUCION_DE_SOLICITUDES (
SOLICITUD
);

/*==============================================================*/
/* Table: HISTORIAL_EXTRAORDINARIOS                             */
/*==============================================================*/
create table HISTORIAL_EXTRAORDINARIOS (
   HISTORIAL            SERIAL not null,
   USUARIO              INT4                 not null,
   MATERIA              VARCHAR(80)          not null,
   FECHA_HORA           DATE                 not null,
   constraint PK_HISTORIAL_EXTRAORDINARIOS primary key (HISTORIAL)
);

/*==============================================================*/
/* Index: HISTORIAL_EXTRAORDINARIOS_PK                          */
/*==============================================================*/
create unique index HISTORIAL_EXTRAORDINARIOS_PK on HISTORIAL_EXTRAORDINARIOS (
HISTORIAL
);

/*==============================================================*/
/* Index: TIENE_FK2                                             */
/*==============================================================*/
create  index TIENE_FK2 on HISTORIAL_EXTRAORDINARIOS (
USUARIO
);

/*==============================================================*/
/* Table: PARAMETROS_REQUISITOS                                 */
/*==============================================================*/
create table PARAMETROS_REQUISITOS (
   NOMBRE               VARCHAR(80)          not null,
   VALOR_PARAMETRO      VARCHAR(10)          not null
);

/*==============================================================*/
/* Table: PERMISOS                                              */
/*==============================================================*/
create table PERMISOS (
   PERMISO              SERIAL not null,
   NOMBRE               VARCHAR(80)          not null,
   DESCRIPCION          TEXT                 null,
   constraint PK_PERMISOS primary key (PERMISO)
);

/*==============================================================*/
/* Index: PERMISOS_PK                                           */
/*==============================================================*/
create unique index PERMISOS_PK on PERMISOS (
PERMISO
);

/*==============================================================*/
/* Table: PERMISOS_POR_ROL                                      */
/*==============================================================*/
create table PERMISOS_POR_ROL (
   ROL                  INT4                 not null,
   PERMISO              INT4                 not null,
   constraint PK_PERMISOS_POR_ROL primary key (ROL, PERMISO)
);

/*==============================================================*/
/* Index: CONTIENE_PK                                           */
/*==============================================================*/
create unique index CONTIENE_PK on PERMISOS_POR_ROL (
ROL,
PERMISO
);

/*==============================================================*/
/* Index: CONTIENE_FK2                                          */
/*==============================================================*/
create  index CONTIENE_FK2 on PERMISOS_POR_ROL (
ROL
);

/*==============================================================*/
/* Index: CONTIENE_FK3                                          */
/*==============================================================*/
create  index CONTIENE_FK3 on PERMISOS_POR_ROL (
PERMISO
);

/*==============================================================*/
/* Table: ROLES                                                 */
/*==============================================================*/
create table ROLES (
   ROL                  SERIAL not null,
   NOMBRE_ROL           VARCHAR(80)          not null,
   constraint PK_ROLES primary key (ROL)
);

/*==============================================================*/
/* Index: ROLES_PK                                              */
/*==============================================================*/
create unique index ROLES_PK on ROLES (
ROL
);

/*==============================================================*/
/* Table: ROLES_POR_USUARIO                                     */
/*==============================================================*/
create table ROLES_POR_USUARIO (
   USUARIO              INT4                 not null,
   ROL                  INT4                 not null,
   constraint PK_ROLES_POR_USUARIO primary key (USUARIO, ROL)
);

/*==============================================================*/
/* Index: TIENE_ASIGNADO_PK                                     */
/*==============================================================*/
create unique index TIENE_ASIGNADO_PK on ROLES_POR_USUARIO (
USUARIO,
ROL
);

/*==============================================================*/
/* Index: TIENE_ASIGNADO_FK                                     */
/*==============================================================*/
create  index TIENE_ASIGNADO_FK on ROLES_POR_USUARIO (
USUARIO
);

/*==============================================================*/
/* Index: TIENE_ASIGNADO_FK2                                    */
/*==============================================================*/
create  index TIENE_ASIGNADO_FK2 on ROLES_POR_USUARIO (
ROL
);

/*==============================================================*/
/* Table: SOLICITUDES                                           */
/*==============================================================*/
create table SOLICITUDES (
   SOLICITUD            SERIAL not null,
   USUARIO_SOLICITANTE  INT4                 not null,
   TIPO_SOLICITUD       VARCHAR(80)          null,
   MESA_ENTRADA         INT4                 not null,
   MATRICULA            INT4                 null,
   CARRERA              VARCHAR(80)          not null,
   FECHA_SOLICITADA     DATE                 not null,
   ESTADO_SOLICITUD     VARCHAR(6)           not null
      constraint CKC_ESTADO_SOLICITUD_SOLICITU check (ESTADO_SOLICITUD in ('APROB','RECHAZ','ANUL','NUEVO','PEND','CANCEL')),
   ETAPA_ACTUAL         VARCHAR(6)           not null
      constraint CKC_ETAPA_ACTUAL_SOLICITU check (ETAPA_ACTUAL in ('DEL_DE','DEL_DA','DEL_DD','DEL_SA','DEL_SD','DEL_SG','RCDA','FINAL','DEL_SS')),
   OBSERVACIONES        TEXT                 null,
   RESULTADO_REQUISITOS VARCHAR(13)          not null
      constraint CKC_RESULTADO_REQUISI_SOLICITU check (RESULTADO_REQUISITOS in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   constraint PK_SOLICITUDES primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUDES_PK                                        */
/*==============================================================*/
create unique index SOLICITUDES_PK on SOLICITUDES (
SOLICITUD
);

/*==============================================================*/
/* Index: HECHA_POR_FK                                          */
/*==============================================================*/
create  index HECHA_POR_FK on SOLICITUDES (
USUARIO_SOLICITANTE
);

/*==============================================================*/
/* Table: SOLICITUDES_VARIAS                                    */
/*==============================================================*/
create table SOLICITUDES_VARIAS (
   SOLICITUD            INT4                 not null,
   ESPECIFICACION_MOTIVO TEXT                 not null,
   constraint PK_SOLICITUDES_VARIAS primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUDES_VARIAS_PK                                 */
/*==============================================================*/
create unique index SOLICITUDES_VARIAS_PK on SOLICITUDES_VARIAS (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_CAMBIO_DE_SECCION                        */
/*==============================================================*/
create table SOLICITUD_DE_CAMBIO_DE_SECCION (
   SOLICITUD            INT4                 not null,
   MOTIVO               TEXT                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   NUEVA_SECCION_ELEGIDA VARCHAR(6)           not null,
   constraint PK_SOLICITUD_DE_CAMBIO_DE_SECC primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_CAMBIO_DE_SECCION_PK                     */
/*==============================================================*/
create unique index SOLICITUD_DE_CAMBIO_DE_SECCION_PK on SOLICITUD_DE_CAMBIO_DE_SECCION (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_CERTIFICADO_DE_ESTUDIOS                  */
/*==============================================================*/
create table SOLICITUD_DE_CERTIFICADO_DE_ESTUDIOS (
   SOLICITUD            INT4                 not null,
   CARRERA_CURSADA      VARCHAR(80)          null,
   TIPO_DE_CERTIFICADO  CHAR(1)              not null
      constraint CKC_TIPO_DE_CERTIFICA_SOLICITU check (TIPO_DE_CERTIFICADO in ('S','L')),
   TIPO_DE_TITULO       VARCHAR(15)          not null,
   SOLICITUD_ANTERIOR   BOOL                 null,
   ACLARACIONES         TEXT                 null,
   APROBACION_PLAN_MATERIAS VARCHAR(13)          not null
      constraint CKC_APROBACION_PLAN_M_SOLICITU check (APROBACION_PLAN_MATERIAS in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   PRESENTACION_CERTIFICADO_ESTUDIOS VARCHAR(13)          not null
      constraint CKC_PRESENTACION_CERT_SOLICITU check (PRESENTACION_CERTIFICADO_ESTUDIOS in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   constraint PK_SOLICITUD_DE_CERTIFICADO_DE primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_CERTIFICADO_DE_ESTUDIOS_PK               */
/*==============================================================*/
create unique index SOLICITUD_DE_CERTIFICADO_DE_ESTUDIOS_PK on SOLICITUD_DE_CERTIFICADO_DE_ESTUDIOS (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_COLABORADOR_DE_CATEDRA                   */
/*==============================================================*/
create table SOLICITUD_DE_COLABORADOR_DE_CATEDRA (
   SOLICITUD            INT4                 not null,
   PROFESOR             VARCHAR(80)          null,
   DESCRIPCION_ACTIVIDADES TEXT                 not null,
   MATERIA_CURSADA      VARCHAR(13)          not null
      constraint CKC_MATERIA_CURSADA_SOLICITU check (MATERIA_CURSADA in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   NOTA_MINIMA_REQUERIDA VARCHAR(13)          not null
      constraint CKC_NOTA_MINIMA_REQUE_SOLICITU check (NOTA_MINIMA_REQUERIDA in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   AYUDANTE_COLABORADOR BOOL                 not null,
   SOLICITANTE_LICENCIADO_ULTIMO_ANHO VARCHAR(13)          null
      constraint CKC_SOLICITANTE_LICEN_SOLICITU check (SOLICITANTE_LICENCIADO_ULTIMO_ANHO is null or (SOLICITANTE_LICENCIADO_ULTIMO_ANHO in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE'))),
   CARRERAS_PROFESOR    TEXT                 null,
   constraint PK_SOLICITUD_DE_COLABORADOR_DE primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_COLABORADOR_DE_CATEDRA_PK                */
/*==============================================================*/
create unique index SOLICITUD_DE_COLABORADOR_DE_CATEDRA_PK on SOLICITUD_DE_COLABORADOR_DE_CATEDRA (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_CONVALIDACION_DE_MATERIAS                */
/*==============================================================*/
create table SOLICITUD_DE_CONVALIDACION_DE_MATERIAS (
   SOLICITUD            INT4                 not null,
   UNIVERSIDAD_ORIGEN   VARCHAR(40)          not null,
   DIRECCION_UNIVERSIDAD_ORIGEN VARCHAR(120)         not null,
   TELEFONO_UNIVERSIDAD_ORIGEN VARCHAR(30)          not null,
   EMAIL_UNIVERSIDAD_ORIGEN VARCHAR(255)         not null,
   CARRERA_CURSADA_UNIVERSIDAD_ORIGEN VARCHAR(80)          not null,
   constraint PK_SOLICITUD_DE_CONVALIDACION_ primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_CONVALIDACION_DE_MATERIAS_PK             */
/*==============================================================*/
create unique index SOLICITUD_DE_CONVALIDACION_DE_MATERIAS_PK on SOLICITUD_DE_CONVALIDACION_DE_MATERIAS (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_CREDITOS_ACADEMICOS                      */
/*==============================================================*/
create table SOLICITUD_DE_CREDITOS_ACADEMICOS (
   SOLICITUD            INT4                 not null,
   TIPO_ACTIVIDAD       TEXT                 not null,
   DESCRIPCION_ACTIVIDADES TEXT                 not null,
   FECHA_INICIO         DATE                 not null,
   FECHA_FIN            DATE                 not null,
   CANTIDAD_HORAS_REALIZADAS INT4                 null
      constraint CKC_CANTIDAD_HORAS_RE_SOLICITU check (CANTIDAD_HORAS_REALIZADAS is null or (CANTIDAD_HORAS_REALIZADAS >= 0)),
   CREDITOS_OTORGADOS   INT4                 null
      constraint CKC_CREDITOS_OTORGADO_SOLICITU check (CREDITOS_OTORGADOS is null or (CREDITOS_OTORGADOS >= 0)),
   constraint PK_SOLICITUD_DE_CREDITOS_ACADE primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_CREDITOS_ACADEMICOS_PK                   */
/*==============================================================*/
create unique index SOLICITUD_DE_CREDITOS_ACADEMICOS_PK on SOLICITUD_DE_CREDITOS_ACADEMICOS (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_DESINSCRIPCION_DE_CURSO                  */
/*==============================================================*/
create table SOLICITUD_DE_DESINSCRIPCION_DE_CURSO (
   SOLICITUD            INT4                 not null,
   MOTIVO_DESINSCRIPCION TEXT                 null,
   CURSO_COMPLETO       VARCHAR(30)          null,
   POR_ASIGNATURA       VARCHAR(30)          null,
   CUOTAS_PAGADAS       VARCHAR(13)          null
      constraint CKC_CUOTAS_PAGADAS_SOLICITU check (CUOTAS_PAGADAS is null or (CUOTAS_PAGADAS in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE'))),
   constraint PK_SOLICITUD_DE_DESINSCRIPCION primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_DESINSCRIPCION_DE_CURSO_PK               */
/*==============================================================*/
create unique index SOLICITUD_DE_DESINSCRIPCION_DE_CURSO_PK on SOLICITUD_DE_DESINSCRIPCION_DE_CURSO (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_EXONERACION                              */
/*==============================================================*/
create table SOLICITUD_DE_EXONERACION (
   SOLICITUD            INT4                 not null,
   MOTIVO               TEXT                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   CUMPLE_PORCENTAJE_ASISTENCIA VARCHAR(13)          not null
      constraint CKC_CUMPLE_PORCENTAJE_SOLICITU check (CUMPLE_PORCENTAJE_ASISTENCIA in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   AUSENCIA_FINALES     VARCHAR(13)          not null
      constraint CKC_AUSENCIA_FINALES_SOLICITU check (AUSENCIA_FINALES in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   constraint PK_SOLICITUD_DE_EXONERACION primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_EXONERACION_PK                           */
/*==============================================================*/
create unique index SOLICITUD_DE_EXONERACION_PK on SOLICITUD_DE_EXONERACION (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_EXTRAORDINARIO                           */
/*==============================================================*/
create table SOLICITUD_DE_EXTRAORDINARIO (
   SOLICITUD            INT4                 not null,
   FECHA_EXTRAORDINARIO DATE                 not null,
   PROFESOR             VARCHAR(80)          not null,
   MOTIVO               TEXT                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   CUMPLE_FECHA         VARCHAR(13)          not null
      constraint CKC_CUMPLE_FECHA_SOLICITU check (CUMPLE_FECHA in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   AUSENTE_TERCERA_OP   VARCHAR(13)          not null
      constraint CKC_AUSENTE_TERCERA_O_SOLICITU check (AUSENTE_TERCERA_OP in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   INSCRIPTO_TERCERA_OP VARCHAR(13)          not null
      constraint CKC_INSCRIPTO_TERCERA_SOLICITU check (INSCRIPTO_TERCERA_OP in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   constraint PK_SOLICITUD_DE_EXTRAORDINARIO primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_EXTRAORDINARIO_PK                        */
/*==============================================================*/
create unique index SOLICITUD_DE_EXTRAORDINARIO_PK on SOLICITUD_DE_EXTRAORDINARIO (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_HOMOLOGACION_DE_MATERIAS                 */
/*==============================================================*/
create table SOLICITUD_DE_HOMOLOGACION_DE_MATERIAS (
   SOLICITUD            INT4                 not null,
   PLAN_DE_ESTUDIO_PREVIO INT4                 not null
      constraint CKC_PLAN_DE_ESTUDIO_P_SOLICITU check (PLAN_DE_ESTUDIO_PREVIO >= 1950),
   PLAN_DE_ESTUDIO_NUEVO INT4                 not null
      constraint CKC_PLAN_DE_ESTUDIO_N_SOLICITU check (PLAN_DE_ESTUDIO_NUEVO >= 1950),
   CARRERA_ANTERIOR     VARCHAR(80)          not null,
   constraint PK_SOLICITUD_DE_HOMOLOGACION_D primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_HOMOLOGACION_DE_MATERIAS_PK              */
/*==============================================================*/
create unique index SOLICITUD_DE_HOMOLOGACION_DE_MATERIAS_PK on SOLICITUD_DE_HOMOLOGACION_DE_MATERIAS (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_INCLUSION_EN_LISTA                       */
/*==============================================================*/
create table SOLICITUD_DE_INCLUSION_EN_LISTA (
   SOLICITUD            INT4                 not null,
   MOTIVO               TEXT                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   constraint PK_SOLICITUD_DE_INCLUSION_EN_L primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_INCLUSION_EN_LISTA_PK                    */
/*==============================================================*/
create unique index SOLICITUD_DE_INCLUSION_EN_LISTA_PK on SOLICITUD_DE_INCLUSION_EN_LISTA (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_INSCRIPCION_TARDIA_A_EXAMEN              */
/*==============================================================*/
create table SOLICITUD_DE_INSCRIPCION_TARDIA_A_EXAMEN (
   SOLICITUD            INT4                 not null,
   OPORTUNIDAD          CHAR(1)              not null
      constraint CKC_OPORTUNIDAD_SOLICITU check (OPORTUNIDAD in ('1','2','3','E')),
   MOTIVO               TEXT                 not null,
   FECHA_DE_EXAMEN      DATE                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   constraint PK_SOLICITUD_DE_INSCRIPCION_TA primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_INSCRIPCION_TARDIA_A_EXAMEN_PK           */
/*==============================================================*/
create unique index SOLICITUD_DE_INSCRIPCION_TARDIA_A_EXAMEN_PK on SOLICITUD_DE_INSCRIPCION_TARDIA_A_EXAMEN (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_PASANTIA                                 */
/*==============================================================*/
create table SOLICITUD_DE_PASANTIA (
   SOLICITUD            INT4                 not null,
   LUGAR                VARCHAR(80)          not null,
   DIRECCION_LUGAR      VARCHAR(120)         not null,
   TELEFONO_LUGAR       VARCHAR(30)          not null,
   CORREO_ELECTRONICO   VARCHAR(255)         null,
   MOTIVO               TEXT                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   constraint PK_SOLICITUD_DE_PASANTIA primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_PASANTIA_PK                              */
/*==============================================================*/
create unique index SOLICITUD_DE_PASANTIA_PK on SOLICITUD_DE_PASANTIA (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_REDUCCION_DE_ASISTENCIA                  */
/*==============================================================*/
create table SOLICITUD_DE_REDUCCION_DE_ASISTENCIA (
   SOLICITUD            INT4                 not null,
   MOTIVO               TEXT                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   ASISTENCIA_MINIMA    VARCHAR(13)          not null
      constraint CKC_ASISTENCIA_MINIMA_SOLICITU check (ASISTENCIA_MINIMA in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   constraint PK_SOLICITUD_DE_REDUCCION_DE_A primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_REDUCCION_DE_ASISTENCIA_PK               */
/*==============================================================*/
create unique index SOLICITUD_DE_REDUCCION_DE_ASISTENCIA_PK on SOLICITUD_DE_REDUCCION_DE_ASISTENCIA (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_REVISION_DE_ESCOLARIDAD                  */
/*==============================================================*/
create table SOLICITUD_DE_REVISION_DE_ESCOLARIDAD (
   SOLICITUD            INT4                 not null,
   constraint PK_SOLICITUD_DE_REVISION_DE_ES primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_REVISION_DE_ESCOLARIDAD_PK               */
/*==============================================================*/
create unique index SOLICITUD_DE_REVISION_DE_ESCOLARIDAD_PK on SOLICITUD_DE_REVISION_DE_ESCOLARIDAD (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_REVISION_DE_EXAMEN                       */
/*==============================================================*/
create table SOLICITUD_DE_REVISION_DE_EXAMEN (
   SOLICITUD            INT4                 not null,
   MOTIVO               TEXT                 not null,
   FECHA_EXAMEN         DATE                 not null,
   PROFESOR             VARCHAR(80)          null,
   OPORTUNIDAD          CHAR(1)              not null
      constraint CKC_OPORTUNIDAD_SOLICITU check (OPORTUNIDAD in ('1','2','3','E')),
   CALIFICACION_PREVIA  CHAR(1)              not null
      constraint CKC_CALIFICACION_PREV_SOLICITU check (CALIFICACION_PREVIA in ('0','1','2','3','4','5','F')),
   CALIFICACION_NUEVA   CHAR(1)              not null
      constraint CKC_CALIFICACION_NUEV_SOLICITU check (CALIFICACION_NUEVA in ('0','1','2','3','4','5','F')),
   FECHA_REVISION       DATE                 null,
   HORA_REVISION        TIME                 null,
   LUGAR_REVISION       VARCHAR(80)          null,
   constraint PK_SOLICITUD_DE_REVISION_DE_EX primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_REVISION_DE_EXAMEN_PK                    */
/*==============================================================*/
create unique index SOLICITUD_DE_REVISION_DE_EXAMEN_PK on SOLICITUD_DE_REVISION_DE_EXAMEN (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_RUPTURA_DE_CORRELATIVIDAD                */
/*==============================================================*/
create table SOLICITUD_DE_RUPTURA_DE_CORRELATIVIDAD (
   SOLICITUD            INT4                 not null,
   CUMPLE_PROMEDIO_MINIMO VARCHAR(13)          not null
      constraint CKC_CUMPLE_PROMEDIO_M_SOLICITU check (CUMPLE_PROMEDIO_MINIMO in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   HASTA_CUARTO_SEMESTRE_REGULAR VARCHAR(13)          not null
      constraint CKC_HASTA_CUARTO_SEME_SOLICITU check (HASTA_CUARTO_SEMESTRE_REGULAR in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   constraint PK_SOLICITUD_DE_RUPTURA_DE_COR primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_RUPTURA_DE_CORRELATIVIDAD_PK             */
/*==============================================================*/
create unique index SOLICITUD_DE_RUPTURA_DE_CORRELATIVIDAD_PK on SOLICITUD_DE_RUPTURA_DE_CORRELATIVIDAD (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_TESIS                                    */
/*==============================================================*/
create table SOLICITUD_DE_TESIS (
   SOLICITUD            INT4                 not null,
   TEMA_TESIS           VARCHAR(80)          not null,
   CUMPLE_APROBACION_MATERIAS VARCHAR(13)          not null
      constraint CKC_CUMPLE_APROBACION_SOLICITU check (CUMPLE_APROBACION_MATERIAS in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   constraint PK_SOLICITUD_DE_TESIS primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_TESIS_PK                                 */
/*==============================================================*/
create unique index SOLICITUD_DE_TESIS_PK on SOLICITUD_DE_TESIS (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_TITULO                                   */
/*==============================================================*/
create table SOLICITUD_DE_TITULO (
   SOLICITUD            INT4                 not null,
   NOMBRE_TITULO        VARCHAR(15)          not null,
   APROBACION_TOTAL_DE_MATERIAS VARCHAR(13)          not null
      constraint CKC_APROBACION_TOTAL__SOLICITU check (APROBACION_TOTAL_DE_MATERIAS in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   CUMPLE_CREDITOS_REQUERIDOS VARCHAR(13)          not null
      constraint CKC_CUMPLE_CREDITOS_R_SOLICITU check (CUMPLE_CREDITOS_REQUERIDOS in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   PRESENTO_TESIS       VARCHAR(13)          not null
      constraint CKC_PRESENTO_TESIS_SOLICITU check (PRESENTO_TESIS in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   FOTOCOPIA_CEDULA     BOOL                 not null,
   FOTOCOPIA_CERTIFICADO_NACIMIENTO BOOL                 not null,
   FOTOCOPIA_CERTIFICADO_MATRIMONIO BOOL                 not null,
   FOTOCOPIA_DE_TITULO_DE_GRADO BOOL                 not null,
   FOTOCOPIA_SIMPLE_DE_TITULO BOOL                 not null,
   POSTGRADO            BOOL                 not null,
   OTROS                BOOL                 null,
   ESPECIFICACION_OTROS TEXT                 null,
   constraint PK_SOLICITUD_DE_TITULO primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_TITULO_PK                                */
/*==============================================================*/
create unique index SOLICITUD_DE_TITULO_PK on SOLICITUD_DE_TITULO (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_TRASPASO_DE_PAGO_DE_EXAMEN               */
/*==============================================================*/
create table SOLICITUD_DE_TRASPASO_DE_PAGO_DE_EXAMEN (
   SOLICITUD            INT4                 not null,
   OPORTUNIDAD_PAGADA   CHAR(1)              not null
      constraint CKC_OPORTUNIDAD_PAGAD_SOLICITU check (OPORTUNIDAD_PAGADA in ('1','2','3','E')),
   FECHA_OPORTUNIDAD_PAGADA DATE                 not null,
   OPORTUNIDAD_A_PAGAR  CHAR(1)              not null
      constraint CKC_OPORTUNIDAD_A_PAG_SOLICITU check (OPORTUNIDAD_A_PAGAR in ('1','2','3','E')),
   FECHA_OPORTUNIDAD_A_PAGAR DATE                 not null,
   CUMPLE_PLAZO_LIMITE  VARCHAR(13)          not null
      constraint CKC_CUMPLE_PLAZO_LIMI_SOLICITU check (CUMPLE_PLAZO_LIMITE in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   FECHA_DE_ABONO       DATE                 null,
   COMPROBANTE          VARCHAR(120)         null,
   constraint PK_SOLICITUD_DE_TRASPASO_DE_PA primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_TRASPASO_DE_PAGO_DE_EXAMEN_PK            */
/*==============================================================*/
create unique index SOLICITUD_DE_TRASPASO_DE_PAGO_DE_EXAMEN_PK on SOLICITUD_DE_TRASPASO_DE_PAGO_DE_EXAMEN (
SOLICITUD
);

/*==============================================================*/
/* Table: SOLICITUD_DE_TUTORIA_DE_CATEDRA                       */
/*==============================================================*/
create table SOLICITUD_DE_TUTORIA_DE_CATEDRA (
   SOLICITUD            INT4                 not null,
   PROFESOR             VARCHAR(80)          null,
   MOTIVO               TEXT                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   CUMPLE_NOTA_MINIMA_REQUERIDA VARCHAR(13)          not null
      constraint CKC_CUMPLE_NOTA_MINIM_SOLICITU check (CUMPLE_NOTA_MINIMA_REQUERIDA in ('CUMPLE','NO_CUMPLE','NO_VERIFICADO','FALTANTE')),
   constraint PK_SOLICITUD_DE_TUTORIA_DE_CAT primary key (SOLICITUD)
);

/*==============================================================*/
/* Index: SOLICITUD_DE_TUTORIA_DE_CATEDRA_PK                    */
/*==============================================================*/
create unique index SOLICITUD_DE_TUTORIA_DE_CATEDRA_PK on SOLICITUD_DE_TUTORIA_DE_CATEDRA (
SOLICITUD
);

/*==================================================================*/
/* Table: SOLICITUD_PARA_TOMAR_MATERIA_FUERA_DE_LA_MALLA_CURRICULAR */
/*==================================================================*/
create table SOLICITUD_PARA_TOMAR_MATERIA_FUERA_DE_LA_MALLA_CURRICULAR (
   SOLICITUD            INT4                 not null,
   MOTIVO               TEXT                 not null,
   ESPECIFICACION_MOTIVO TEXT                 null,
   constraint PK_SOLICITUD_PARA_TOMAR_MATERI primary key (SOLICITUD)
);

/*=====================================================================*/
/* Index: SOLICITUD_PARA_TOMAR_MATERIA_FUERA_DE_LA_MALLA_CURRICULAR_PK */
/*=====================================================================*/
create unique index SOLICITUD_PARA_TOMAR_MATERIA_FUERA_DE_LA_MALLA_CURRICULAR_PK on SOLICITUD_PARA_TOMAR_MATERIA_FUERA_DE_LA_MALLA_CURRICULAR (
SOLICITUD
);

/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS (
   USUARIO              SERIAL not null,
   NUMERO_DE_DOCUMENTO  INT4                 not null,
   TIPO_DE_DOCUMENTO    VARCHAR(80)          not null,
   ORIGEN_DE_DOCUMENTO  VARCHAR(80)          not null,
   NOMBRES              VARCHAR(80)          not null,
   APELLIDOS            VARCHAR(80)          not null,
   SEXO                 CHAR(1)              not null
      constraint CKC_SEXO_USUARIOS check (SEXO in ('M','F')),
   DIRECCION            VARCHAR(120)         not null,
   TELEFONO             VARCHAR(30)          not null,
   EMAIL                VARCHAR(255)         null,
   CONTRASENA           VARCHAR(100)         not null,
   ESTADO_CUENTA        CHAR(1)              null
      constraint CKC_ESTADO_CUENTA_USUARIOS check (ESTADO_CUENTA is null or (ESTADO_CUENTA in ('A','I'))),
   constraint PK_USUARIOS primary key (USUARIO)
);

/*==============================================================*/
/* Index: USUARIOS_PK                                           */
/*==============================================================*/
create unique index USUARIOS_PK on USUARIOS (
USUARIO
);

alter table ASIGNATURAS_POR_SOLICITUD
   add constraint FK_ASIGNATU_TIENE_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table DOCUMENTOS_ADJUNTOS
   add constraint FK_DOCUMENT_TIENE_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table FECHAS_DE_RESOLUCION_DE_SOLICITUDES
   add constraint FK_FECHAS_D_TIENE_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table HISTORIAL_EXTRAORDINARIOS
   add constraint FK_HISTORIA_TIENE_USUARIOS foreign key (USUARIO)
      references USUARIOS (USUARIO)
      on delete restrict on update restrict;

alter table PERMISOS_POR_ROL
   add constraint FK_PERMISOS_CONTIENE_PERMISOS foreign key (PERMISO)
      references PERMISOS (PERMISO)
      on delete restrict on update restrict;

alter table PERMISOS_POR_ROL
   add constraint FK_PERMISOS_CONTIENE_ROLES foreign key (ROL)
      references ROLES (ROL)
      on delete restrict on update restrict;

alter table ROLES_POR_USUARIO
   add constraint FK_ROLES_PO_TIENE_ASI_ROLES foreign key (ROL)
      references ROLES (ROL)
      on delete restrict on update restrict;

alter table ROLES_POR_USUARIO
   add constraint FK_ROLES_PO_TIENE_ASI_USUARIOS foreign key (USUARIO)
      references USUARIOS (USUARIO)
      on delete restrict on update restrict;

alter table SOLICITUDES
   add constraint FK_SOLICITU_HECHA_POR_USUARIOS foreign key (USUARIO_SOLICITANTE)
      references USUARIOS (USUARIO)
      on delete restrict on update restrict;

alter table SOLICITUDES_VARIAS
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_CAMBIO_DE_SECCION
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_CERTIFICADO_DE_ESTUDIOS
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_COLABORADOR_DE_CATEDRA
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_CONVALIDACION_DE_MATERIAS
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_CREDITOS_ACADEMICOS
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_DESINSCRIPCION_DE_CURSO
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_EXONERACION
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_EXTRAORDINARIO
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_HOMOLOGACION_DE_MATERIAS
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_INCLUSION_EN_LISTA
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_INSCRIPCION_TARDIA_A_EXAMEN
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_PASANTIA
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_REDUCCION_DE_ASISTENCIA
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_REVISION_DE_ESCOLARIDAD
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_REVISION_DE_EXAMEN
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_RUPTURA_DE_CORRELATIVIDAD
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_TESIS
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_TITULO
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_TRASPASO_DE_PAGO_DE_EXAMEN
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_DE_TUTORIA_DE_CATEDRA
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

alter table SOLICITUD_PARA_TOMAR_MATERIA_FUERA_DE_LA_MALLA_CURRICULAR
   add constraint FK_SOLICITU_ES_UN_SOLICITU foreign key (SOLICITUD)
      references SOLICITUDES (SOLICITUD)
      on delete restrict on update restrict;

