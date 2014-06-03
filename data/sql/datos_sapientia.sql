--Tabla Alumnos
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (3295333, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (3300000, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (3500000, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (4250000, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (4490334, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (4290280, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (3150130, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (4530190, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (4430203, 'Cédula de Identidad','Paraguay');
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (3990235, 'Cédula de Identidad','Paraguay');


--Tabla Departamentos
insert into departamentos (departamento, nombre) values ( 1, 'DEI');
insert into departamentos (departamento, nombre) values ( 2, 'DICIA');
insert into departamentos (departamento, nombre) values ( 3, 'Departamento de Arquitectura');
insert into departamentos (departamento, nombre) values ( 4, 'Departamento de Diseño');
insert into departamentos (departamento, nombre) values ( 5, 'Departamento de Análisis');
 
--Tabla Carreras
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (1,2013, 1, 'Ingeniería Informática');
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (2,2013, 1, 'Ingeniería Electrónica');
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (3,2014, 2, 'Ingeniería Civil');
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (4,2014, 2, 'Ingeniería Ambiental');
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (5,2014, 2, 'Ingeniería Industrial');
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (6,2014, 3, 'Arquitectura');
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (7,2014, 4, 'Diseño Gráfico');
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (8,2014, 4, 'Diseño Industrial');
insert into carreras (carrera, plan_de_estudio, departamento, nombre ) values (9,2014, 5, 'Análisis de Sistemas');

--Tabla Materias
insert into materias (materia, nombre) values (1, 'Cálculo I');
insert into materias (materia, nombre) values (2, 'Cálculo II');
insert into materias (materia, nombre) values (3, 'Cálculo III');
insert into materias (materia, nombre) values (4, 'Introducción a la Física');
insert into materias (materia, nombre) values (5, 'Física I');
insert into materias (materia, nombre) values (6, 'Física II');
insert into materias (materia, nombre) values (7, 'Física III');
insert into materias (materia, nombre) values (8, 'Cálculo Numérico');
insert into materias (materia, nombre) values (9, 'Investigación de Operaciones');
insert into materias (materia, nombre) values (10, 'Ingeniería de Software I');
insert into materias (materia, nombre) values (11, 'Ingeniería de Software II');
insert into materias (materia, nombre) values (12, 'Compiladores');
insert into materias (materia, nombre) values (13, 'Informática I');
insert into materias (materia, nombre) values (14, 'Informática II');
insert into materias (materia, nombre) values (15, 'Sistemas Paralelos y Distribuidos');
insert into materias (materia, nombre) values (16, 'Organización de Empresas');
insert into materias (materia, nombre) values (17, 'Electromagnetismo');
insert into materias (materia, nombre) values (18, 'Electrónica I');
insert into materias (materia, nombre) values (19, 'Introducción a la Sociología');
insert into materias (materia, nombre) values (20, 'Ética Personal');

insert into profesores (profesor, nombre) values (1, 'Luca Cernuzzi');
insert into profesores (profesor, nombre) values (2, 'Vicente Gonzalez');
insert into profesores (profesor, nombre) values (3, 'Carlos Sánchez');
insert into profesores (profesor, nombre) values (4, 'Raúl Fernández');
insert into profesores (profesor, nombre) values (5, 'Iván Prieto');
insert into profesores (profesor, nombre) values (6, 'Jorge Hiraiwa');
insert into profesores (profesor, nombre) values (7, 'Francisco Benza');
insert into profesores (profesor, nombre) values (8, 'Alexander Wich');
insert into profesores (profesor, nombre) values (9, 'Luis Martínez');
insert into profesores (profesor, nombre) values (10, 'Enrique Gossen');
insert into profesores (profesor, nombre) values (11, 'Iván Fuster');
insert into profesores (profesor, nombre) values (12, 'Zárate');
insert into profesores (profesor, nombre) values (13, 'Silvio Suárez');
insert into profesores (profesor, nombre) values (14, 'Carmen Von Lücken');
insert into profesores (profesor, nombre) values (15, 'Fernando Brunetti');
insert into profesores (profesor, nombre) values (16, 'Magalí Gonzalez');
insert into profesores (profesor, nombre) values (17, 'Omar Romero');


--Tabla matriculas por carrera
insert into matriculas_por_carrera (matricula, carrera, plan_de_estudio) values (61039, 1, 2013);
insert into matriculas_por_carrera (matricula, carrera, plan_de_estudio) values (61040,2, 2013);
insert into matriculas_por_carrera (matricula, carrera, plan_de_estudio) values (61050,3, 2014);
insert into matriculas_por_carrera (matricula, carrera, plan_de_estudio) values (61060,4, 2014);

--Tabla Alumno por matriculas
insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (4490334,'Cédula de Identidad','Paraguay', 61039);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, matricula) values (3295333, 'Cédula de Identidad','Paraguay', 2);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, matricula) values (3300000, 'Cédula de Identidad','Paraguay', 3);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, matricula) values (3500000,'Cédula de Identidad','Paraguay', 4);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (4250000,'Cédula de Identidad','Paraguay', 6);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (4290280,'Cédula de Identidad','Paraguay', 1);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (3150130,'Cédula de Identidad','Paraguay', 3);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (4430203,'Cédula de Identidad','Paraguay', 5);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (4490334,'Cédula de Identidad','Paraguay', 61039);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (4530190,'Cédula de Identidad','Paraguay', 8);
-- insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (3990235,'Cédula de Identidad','Paraguay', 9);


insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(1,1,1,2013,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(2,2,2,2013,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(3,3,1,2013,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(4,4,2,2013,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(5,5,1,2013,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(6,6,2,2013,'A');



insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(7,1,1,2014,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(8,2,1,2014,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(9,3,1,2014,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(10,4,1,2014,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(11,5,1,2014,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(12,6,1,2014,'A');
insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(13,6,1,2014,'A');

--Tabla Alumnos por curso
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (3150130,'Cédula de Identidad','Paraguay',3, FALSE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (3295333,'Cédula de Identidad','Paraguay',1, FALSE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (3300000,'Cédula de Identidad','Paraguay',1, FALSE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (3500000,'Cédula de Identidad','Paraguay',2, FALSE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (4490334,'Cédula de Identidad','Paraguay',2, FALSE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (4430203,'Cédula de Identidad','Paraguay',2, FALSE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (4490334,'Cédula de Identidad','Paraguay',1, FALSE);

insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (3150130,'Cédula de Identidad','Paraguay',7, TRUE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (3295333,'Cédula de Identidad','Paraguay',8, TRUE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (3300000,'Cédula de Identidad','Paraguay',8, TRUE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (3500000,'Cédula de Identidad','Paraguay',9, TRUE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (4490334,'Cédula de Identidad','Paraguay',12, TRUE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (4430203,'Cédula de Identidad','Paraguay',12, TRUE);
insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (4490334,'Cédula de Identidad','Paraguay',9, TRUE);

--Tabla Asistencias por alumno
-- insert into asistencias_por_alumno (asistencia, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values (1, 4490334,'Cédula de Identidad','Paraguay', 3, '2014-03-02', TRUE);
-- insert into asistencias_por_alumno (asistencia, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values (2, 3150130,'Cédula de Identidad','Paraguay', 1, '2014-03-02', TRUE);
-- insert into asistencias_por_alumno (asistencia, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values (3, 3295333,'Cédula de Identidad','Paraguay', 2, '2014-03-02', TRUE);
-- insert into asistencias_por_alumno (asistencia, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values (4, 3300000,'Cédula de Identidad','Paraguay', 2, '2014-03-02', TRUE);
-- insert into asistencias_por_alumno (asistencia, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values (5, 3500000,'Cédula de Identidad','Paraguay', 3, '2014-03-02', TRUE);
-- insert into asistencias_por_alumno (asistencia, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values (6, 4490334,'Cédula de Identidad','Paraguay', 6, '2014-03-02', TRUE);
-- insert into asistencias_por_alumno (asistencia, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values (7, 4430203,'Cédula de Identidad','Paraguay', 6, '2014-03-02', TRUE);


--Tabla de Horarios de clase
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (1,1,2,'14:30:00','16:05:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (2,1,4,'13:00:00','14:30:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (3,2,3,'16:05:00','17:45:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (4,2,5,'15:20:00','17:00:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (5,3,2,'13:00:00','15:20:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (6,3,4,'14:30:00','16:05:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (7,4,3,'14:30:00','16:05:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (8,4,5,'16:05:00','17:45:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (9,5,5,'13:00:00','14:30:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (10,5,6,'13:00:00','14:30:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (11,6,3,'14:30:00','16:05:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (12,6,5,'13:00:00','14:30:00');

--Tabla calificaciones por alumno
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (4490334,'Cédula de Identidad','Paraguay', 1, 4);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (4490334,'Cédula de Identidad','Paraguay', 2, 4);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (4430203,'Cédula de Identidad','Paraguay',2, 3);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (3300000,'Cédula de Identidad','Paraguay', 1, 5);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (3500000,'Cédula de Identidad','Paraguay',2, 5);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (3150130,'Cédula de Identidad','Paraguay',3, 2);

--Tabla carrera por materia
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 1);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013, 1);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014, 1);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014, 1);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014, 1);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 2);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013, 2);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014, 2);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014, 2);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014, 2);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 3);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013, 3);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014, 3);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014, 3);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014, 3);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 4);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013, 4);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014, 4);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014, 4);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014, 4);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013,5);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013,5);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014,5);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014,5);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014,5);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013,6);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013,6);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014,6);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014,6);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014,6);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013,7);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013,7);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014,7);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014,7);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014,7);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013,8);


insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013,9);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013,9);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014,9);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014,9);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014,9);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 10);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 11);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 12);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 13);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 14);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 15);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 16);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013, 16);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013, 17);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014, 18);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 19);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013, 19);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014, 19);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014, 19);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014, 19);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (6, 2014, 19);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (7, 2014, 19);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (8, 2014, 19);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (9, 2014, 19);

insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (1, 2013, 20);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (2, 2013,20);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (3, 2014,20);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (4, 2014,20);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (5, 2014,20);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (6, 2014,20);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (7, 2014,20);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (8, 2014,20);
insert into materias_por_carrera (carrera, plan_de_estudio, materia) values (9, 2014,20);


--Tabla correlativa_por_carrera
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (1, 2013, 2, 1, 3);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (2, 2013,2, 1, 3);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (3, 2014,2, 1, 3);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (4, 2014,2, 1, 3);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (5, 2014,2, 1, 3);

insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (1, 2013,5, 4, 3);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (2, 2013,5, 4, 3);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (3, 2014,5, 4, 3);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (4, 2014,5, 4, 3);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (5, 2014,5, 4, 3);

insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (1, 2013,6, 5, 4);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (2, 2013,6, 5, 4);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (3, 2014,6, 5, 4);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (4, 2014,6, 5, 4);
insert into correlativa_por_carrera (carrera, plan_de_estudio, materia, materia_correlativa, semestre_carrera) values (5, 2014,6, 5, 4);

--Tabla asistencias por alumno
insert into asistencias_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3150130, 'Cédula de Identidad','Paraguay', 3, '2013-09-04', 2,2);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3150130, 'Cédula de Identidad','Paraguay', 3, '2013-09-06', 0,2);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3150130, 'Cédula de Identidad','Paraguay', 3, '2013-09-11', 3,3);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3150130, 'Cédula de Identidad','Paraguay', 3, '2013-09-12', 2,2);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3150130, 'Cédula de Identidad','Paraguay', 7, '2014-03-04', 3,3);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3295333, 'Cédula de Identidad','Paraguay', 1, '2013-09-06', 3,3);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3295333, 'Cédula de Identidad','Paraguay', 1, '2013-09-08', 2,2);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3295333, 'Cédula de Identidad','Paraguay', 1, '2013-09-13', 2,2);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3295333, 'Cédula de Identidad','Paraguay',8, '2014-03-04', 3,3);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3300000, 'Cédula de Identidad','Paraguay', 1, '2013-09-06', 2,2);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3300000, 'Cédula de Identidad','Paraguay', 8, '2014-03-06', 3,3);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3500000, 'Cédula de Identidad','Paraguay', 2, '2013-09-06', 0,3);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 3500000, 'Cédula de Identidad','Paraguay', 9, '2014-03-06', 2,2);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 4430203, 'Cédula de Identidad','Paraguay', 2, '2013-09-06', 0,2);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 4430203, 'Cédula de Identidad','Paraguay', 12, '2014-03-06', 2,2);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 4490334, 'Cédula de Identidad','Paraguay', 1, '2013-09-04', 0,3);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 4490334, 'Cédula de Identidad','Paraguay', 2, '2013-09-06', 3,3);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 4490334, 'Cédula de Identidad','Paraguay', 9, '2014-03-04', 2,2);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, horas_asistidas, horas_totales) values ( 4490334, 'Cédula de Identidad','Paraguay', 12, '2014-03-06', 2,2);

--Tabla Historial de Extraordinarios
insert into historial_extraordinarios (historial, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha) values (1, 4490334, 'Cédula de Identidad','Paraguay', 1, '2014-02-25');
insert into historial_extraordinarios (historial, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha) values (2, 3295333, 'Cédula de Identidad','Paraguay', 1, '2014-02-25');


--Tabla Inscripcion a examen por alumno
insert into inscripcion_examen_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, inscripcion, curso, oportunidad,  presencia, fecha_de_abono, comprobante) values (4490334, 'Cédula de Identidad','Paraguay', 1, 1, '3', FALSE, '2013-12-10', '200-3445556f4');
insert into inscripcion_examen_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, inscripcion, curso, oportunidad,  presencia, fecha_de_abono, comprobante) values (3295333, 'Cédula de Identidad','Paraguay', 2, 1, '3', FALSE, '2013-12-10', '200-3448856a1');
insert into inscripcion_examen_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, inscripcion, curso, oportunidad,  presencia, fecha_de_abono, comprobante) values (3295333, 'Cédula de Identidad','Paraguay', 3, 9, '3', TRUE, '2014-12-17', '200-34483226b1');

--Tabla Horarios de examen
insert into horarios_de_examen (horario_de_examen, curso, fecha_de_examen, hora_de_examen, oportunidad) values (1, 1, '2014-02-07', '14:00', '3');
insert into horarios_de_examen (horario_de_examen, curso, fecha_de_examen, hora_de_examen, oportunidad) values (2, 9, '2014-02-23', '14:00', '3');

--Tabla Profesores por curso
insert into profesores_por_curso (profesor, curso) values (14, 1);
insert into profesores_por_curso (profesor, curso) values (14, 2);
insert into profesores_por_curso (profesor, curso) values (12, 3);
insert into profesores_por_curso (profesor, curso) values (3, 4);
insert into profesores_por_curso (profesor, curso) values (3, 5);
insert into profesores_por_curso (profesor, curso) values (11, 6);
insert into profesores_por_curso (profesor, curso) values (14, 7);
insert into profesores_por_curso (profesor, curso) values (14, 8);
insert into profesores_por_curso (profesor, curso) values (12, 9);
insert into profesores_por_curso (profesor, curso) values (3, 10);
insert into profesores_por_curso (profesor, curso) values (3, 11);
insert into profesores_por_curso (profesor, curso) values (11, 12);












