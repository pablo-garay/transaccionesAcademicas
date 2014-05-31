-- Table: user_role

-- DROP TABLE user_role;

CREATE TABLE user_role
(
  id serial NOT NULL,
  role_id character varying(255) NOT NULL,
  is_default smallint NOT NULL,
  parent_id integer,
  CONSTRAINT user_role_pkey PRIMARY KEY (id),
  CONSTRAINT parent FOREIGN KEY (parent_id)
      REFERENCES user_role (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
-- Table: user_role_linker

-- DROP TABLE user_role_linker;

CREATE TABLE user_role_linker
(
  user_id integer NOT NULL,
  role_id integer NOT NULL,
  CONSTRAINT pklinker PRIMARY KEY (user_id, role_id),
  CONSTRAINT roleid FOREIGN KEY (role_id)
      REFERENCES user_role (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT userid FOREIGN KEY (user_id)
      REFERENCES usuarios (usuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);