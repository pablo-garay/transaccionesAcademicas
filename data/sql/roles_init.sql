INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (0, 'admin', 0, NULL);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (1, 'guest', 1, NULL);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (2, 'user', 0, 1);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (3, 'alumno', 0, 2);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (4, 'recepcion', 0, 1);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (5, 'secretaria_general', 0, 1);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (6, 'secretaria_academica', 0, 1);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (7, 'secretaria_departamento', 0, 1);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (8, 'decano', 0, 1);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (9, 'director_academico', 0, 1);

INSERT INTO user_role (id, role_id, is_default, parent_id)
VALUES (10, 'director_departamento', 0, 1);
