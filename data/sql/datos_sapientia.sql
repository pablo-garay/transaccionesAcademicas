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
insert into alumnos (numero_de_documento, tipo_de_documento, origen_de_documento) values (4490335, 'Cédula de Identidad','Paraguay');

--Tabla Departamentos
insert into departamentos (departamento, nombre) values ( 1, 'DEI');
insert into departamentos (departamento, nombre) values ( 2, 'DICIA');
insert into departamentos (departamento, nombre) values ( 3, 'Departamento de Arquitectura');
insert into departamentos (departamento, nombre) values ( 4, 'Departamento de Diseño');
insert into departamentos (departamento, nombre) values ( 5, 'Departamento de Análisis');
 
--Tabla Carreras
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (1, 1, 'Ingeniería Informática', 20, 2013);
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (2, 1, 'Ingeniería Electrónica', 20,2013);
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (3, 2, 'Ingeniería Civil', 20, 2013);
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (4, 2, 'Ingeniería Ambiental', 20, 2013);
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (5, 2, 'Ingeniería Industrial', 20, 2013);
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (6, 3, 'Arquitectura', 20, 2014);
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (7, 4, 'Diseño Gráfico', 24, 2014);
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (8, 4, 'Diseño Industrial', 24, 2014);
insert into carreras (carrera, departamento, nombre, creditos_requeridos, plan_de_estudio ) values (9, 5, 'Análisis de Sistemas', 0, 2014);

--Tabla Materias
insert into materias (materia, nombre, semestre_carrera) values (1, 'Cálculo I', 2);
insert into materias (materia,  nombre, semestre_carrera) values (2, 'Cálculo II', 3);
insert into materias (materia,  nombre, semestre_carrera) values (3, 'Cálculo III', 4);
insert into materias (materia,  nombre, semestre_carrera) values (4, 'Introducción a la Física', 2);
insert into materias (materia,  nombre, semestre_carrera) values (5, 'Física I', 3);
insert into materias (materia,  nombre, semestre_carrera) values (6, 'Física II', 4);
insert into materias (materia,  nombre, semestre_carrera) values (7, 'Física III', 5);
insert into materias (materia,  nombre, semestre_carrera) values (8, 'Cálculo Numérico', 8);
insert into materias (materia,  nombre, semestre_carrera) values (9, 'Investigación de Operaciones', 7);
insert into materias (materia,  nombre, semestre_carrera) values (10, 'Ingeniería de Software I', 8);
insert into materias (materia,  nombre, semestre_carrera) values (11, 'Ingeniería de Software II', 9);
insert into materias (materia,  nombre, semestre_carrera) values (12, 'Compiladores', 9);
insert into materias (materia,  nombre, semestre_carrera) values (13, 'Informática I', 8);
insert into materias (materia,  nombre, semestre_carrera) values (14, 'Informática II', 9);
insert into materias (materia,  nombre, semestre_carrera) values (15, 'Sistemas Paralelos y Distribuidos', 9);
insert into materias (materia,  nombre, semestre_carrera) values (16, 'Organización de Empresas', 9);
insert into materias (materia,  nombre, semestre_carrera) values (17, 'Electromagnetismo', 5);
insert into materias (materia,  nombre, semestre_carrera) values (18, 'Electrónica I', 6);
insert into materias (materia,  nombre, semestre_carrera) values (19, 'Introducción a la Sociología', 2);
insert into materias (materia,  nombre, semestre_carrera) values (20, 'Ética Personal', 8);
insert into materias (materia,  nombre, semestre_carrera) values (21, 'Matemática I', 1);

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
insert into matriculas_por_carrera (matricula, carrera) values (61039, 1);
insert into matriculas_por_carrera (matricula, carrera) values (61040, 2);
insert into matriculas_por_carrera (matricula, carrera) values (61050, 3);
insert into matriculas_por_carrera (matricula, carrera) values (61060, 4);
insert into matriculas_por_carrera (matricula, carrera) values (61045, 9);
insert into matriculas_por_carrera (matricula, carrera) values (61070, 9);
--Tabla Alumno por matriculas
insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (4490334,'Cédula de Identidad','Paraguay', 61039);
insert into matriculas_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento,matricula) values (4490335,'Cédula de Identidad','Paraguay', 61070);
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


insert into cursos (curso, materia, semestre_anho, anho, seccion) values
(1,1,1,2013,'A');
insert into cursos (curso, materia, semestre_anho, anho, seccion) values
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

insert into cursos (curso, materia,  semestre_anho, anho, seccion) values
(14,21,1,2014,'A');

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

insert into alumnos_por_curso (numero_de_documento, tipo_de_documento, origen_de_documento,curso, curso_actual) values (4490335,'Cédula de Identidad','Paraguay',14, FALSE);

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

insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (13,14,5,'18:30:00','19:10:00');
insert into horarios_de_clase (horario, curso, dia, hora_inicio, hora_fin) values (14,14,6,'18:30:00','19:10:00');
--Tabla calificaciones por alumno
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (4490334,'Cédula de Identidad','Paraguay', 1, 4);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (4490334,'Cédula de Identidad','Paraguay', 2, 4);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (4430203,'Cédula de Identidad','Paraguay',2, 3);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (3300000,'Cédula de Identidad','Paraguay', 1, 5);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (3500000,'Cédula de Identidad','Paraguay',2, 5);
insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (3150130,'Cédula de Identidad','Paraguay',3, 2);

insert into calificaciones_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, calificacion) values (4490335,'Cédula de Identidad','Paraguay',3, 5);
--Tabla carrera por materia
insert into materias_por_carrera (carrera, materia) values (1,1);
insert into materias_por_carrera (carrera, materia) values (2,1);
insert into materias_por_carrera (carrera, materia) values (3,1);
insert into materias_por_carrera (carrera, materia) values (4,1);
insert into materias_por_carrera (carrera, materia) values (5,1);

insert into materias_por_carrera (carrera, materia) values (1, 2);
insert into materias_por_carrera (carrera, materia) values (2, 2);
insert into materias_por_carrera (carrera, materia) values (3, 2);
insert into materias_por_carrera (carrera, materia) values (4, 2);
insert into materias_por_carrera (carrera, materia) values (5, 2);

insert into materias_por_carrera (carrera, materia) values (1, 3);
insert into materias_por_carrera (carrera, materia) values (2, 3);
insert into materias_por_carrera (carrera, materia) values (3, 3);
insert into materias_por_carrera (carrera, materia) values (4, 3);
insert into materias_por_carrera (carrera, materia) values (5, 3);

insert into materias_por_carrera (carrera, materia) values (1, 4);
insert into materias_por_carrera (carrera, materia) values (2, 4);
insert into materias_por_carrera (carrera, materia) values (3, 4);
insert into materias_por_carrera (carrera, materia) values (4, 4);
insert into materias_por_carrera (carrera, materia) values (5, 4);

insert into materias_por_carrera (carrera, materia) values (1, 5);
insert into materias_por_carrera (carrera, materia) values (2, 5);
insert into materias_por_carrera (carrera, materia) values (3, 5);
insert into materias_por_carrera (carrera, materia) values (4, 5);
insert into materias_por_carrera (carrera, materia) values (5, 5);

insert into materias_por_carrera (carrera, materia) values (1, 6);
insert into materias_por_carrera (carrera, materia) values (2, 6);
insert into materias_por_carrera (carrera, materia) values (3, 6);
insert into materias_por_carrera (carrera, materia) values (4, 6);
insert into materias_por_carrera (carrera, materia) values (5, 6);

insert into materias_por_carrera (carrera, materia) values (1, 7);
insert into materias_por_carrera (carrera, materia) values (2, 7);
insert into materias_por_carrera (carrera, materia) values (3, 7);
insert into materias_por_carrera (carrera, materia) values (4, 7);
insert into materias_por_carrera (carrera, materia) values (5, 7);

insert into materias_por_carrera (carrera, materia) values (1, 8);


insert into materias_por_carrera (carrera, materia) values (1, 9);
insert into materias_por_carrera (carrera, materia) values (2, 9);
insert into materias_por_carrera (carrera, materia) values (3, 9);
insert into materias_por_carrera (carrera, materia) values (4, 9);
insert into materias_por_carrera (carrera, materia) values (5, 9);

insert into materias_por_carrera (carrera, materia) values (1, 10);

insert into materias_por_carrera (carrera, materia) values (1, 11);

insert into materias_por_carrera (carrera, materia) values (1, 12);

insert into materias_por_carrera (carrera, materia) values (1, 13);

insert into materias_por_carrera (carrera, materia) values (1, 14);

insert into materias_por_carrera (carrera, materia) values (1, 15);

insert into materias_por_carrera (carrera, materia) values (1, 16);
insert into materias_por_carrera (carrera, materia) values (2, 16);

insert into materias_por_carrera (carrera, materia) values (2, 17);

insert into materias_por_carrera (carrera, materia) values (3, 18);

insert into materias_por_carrera (carrera, materia) values (1, 19);
insert into materias_por_carrera (carrera, materia) values (2, 19);
insert into materias_por_carrera (carrera, materia) values (3, 19);
insert into materias_por_carrera (carrera, materia) values (4, 19);
insert into materias_por_carrera (carrera, materia) values (5, 19);
insert into materias_por_carrera (carrera, materia) values (6, 19);
insert into materias_por_carrera (carrera, materia) values (7, 19);
insert into materias_por_carrera (carrera, materia) values (8, 19);
insert into materias_por_carrera (carrera, materia) values (9, 19);

insert into materias_por_carrera (carrera, materia) values (1, 20);
insert into materias_por_carrera (carrera, materia) values (2, 20);
insert into materias_por_carrera (carrera, materia) values (3, 20);
insert into materias_por_carrera (carrera, materia) values (4, 20);
insert into materias_por_carrera (carrera, materia) values (5, 20);
insert into materias_por_carrera (carrera, materia) values (6, 20);
insert into materias_por_carrera (carrera, materia) values (7, 20);
insert into materias_por_carrera (carrera, materia) values (8, 20);
insert into materias_por_carrera (carrera, materia) values (9, 20);

insert into materias_por_carrera (carrera, materia) values (9, 21);


--Tabla correlativa_por_carrera
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (1, 2, 1, 3);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (2, 2, 1, 3);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (3, 2, 1, 3);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (4, 2, 1, 3);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (5, 2, 1, 3);

insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (1, 5, 4, 3);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (2, 5, 4, 3);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (3, 5, 4, 3);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (4, 5, 4, 3);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (5, 5, 4, 3);

insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (1, 6, 5, 4);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (2, 6, 5, 4);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (3, 6, 5, 4);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (4, 6, 5, 4);
insert into correlativa_por_carrera (carrera, materia, materia_correlativa, semestre_carrera) values (5, 6, 5, 4);

--Tabla asistencias por alumno
insert into asistencias_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3150130, 'Cédula de Identidad','Paraguay', 3, '2013-09-04', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3150130, 'Cédula de Identidad','Paraguay', 3, '2013-09-06', FALSE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3150130, 'Cédula de Identidad','Paraguay', 3, '2013-09-11', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3150130, 'Cédula de Identidad','Paraguay', 3, '2013-09-12', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3150130, 'Cédula de Identidad','Paraguay', 7, '2014-03-04', TRUE);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4490335, 'Cédula de Identidad','Paraguay', 14, '2014-03-04', TRUE);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3295333, 'Cédula de Identidad','Paraguay', 1, '2013-09-06', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3295333, 'Cédula de Identidad','Paraguay', 1, '2013-09-08', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3295333, 'Cédula de Identidad','Paraguay', 1, '2013-09-13', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3295333, 'Cédula de Identidad','Paraguay',8, '2014-03-04', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4490335, 'Cédula de Identidad','Paraguay',14, '2014-03-04', TRUE);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3300000, 'Cédula de Identidad','Paraguay', 1, '2013-09-06', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3300000, 'Cédula de Identidad','Paraguay', 8, '2014-03-06', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4490335, 'Cédula de Identidad','Paraguay', 14, '2014-03-06', FALSE);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3500000, 'Cédula de Identidad','Paraguay', 2, '2013-09-06', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 3500000, 'Cédula de Identidad','Paraguay', 9, '2014-03-06', TRUE);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4430203, 'Cédula de Identidad','Paraguay', 2, '2013-09-06', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4430203, 'Cédula de Identidad','Paraguay', 12, '2014-03-06', TRUE);

insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4490334, 'Cédula de Identidad','Paraguay', 1, '2013-09-04', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4490334, 'Cédula de Identidad','Paraguay', 2, '2013-09-06', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4490334, 'Cédula de Identidad','Paraguay', 9, '2014-03-04', TRUE);
insert into asistencias_por_alumno ( numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha, presencia) values ( 4490334, 'Cédula de Identidad','Paraguay', 12, '2014-03-06', TRUE);

--Tabla Historial de Extraordinarios
insert into historial_extraordinarios (historial, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha) values (1, 4490334, 'Cédula de Identidad','Paraguay', 1, '2014-02-25');
insert into historial_extraordinarios (historial, numero_de_documento, tipo_de_documento, origen_de_documento, curso, fecha) values (2, 3295333, 'Cédula de Identidad','Paraguay', 1, '2014-02-25');


--Tabla Inscripcion a examen por alumno
insert into inscripcion_examen_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, inscripcion, curso, oportunidad,  presencia, fecha_de_abono, comprobante) values (4490334, 'Cédula de Identidad','Paraguay', 1, 1, 3, FALSE, '2013-12-10', '200-3445556f4');
insert into inscripcion_examen_por_alumno (numero_de_documento, tipo_de_documento, origen_de_documento, inscripcion, curso, oportunidad,  presencia, fecha_de_abono, comprobante) values (3295333, 'Cédula de Identidad','Paraguay', 2, 1, 3, FALSE, '2013-12-10', '200-3448856a1');

--Tabla Horarios de examen
insert into horarios_de_examen (horario_de_examen, curso, fecha_de_examen, hora_de_examen, oportunidad) values (1, 1, '2014-02-07', '14:00', 3);

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












