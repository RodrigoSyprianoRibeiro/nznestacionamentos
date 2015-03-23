--Postgres
CREATE TABLE public.perfil
(
   id serial NOT NULL, 
   nome character varying(100) NOT NULL, 
   CONSTRAINT pk_perfil PRIMARY KEY (id)
) 
WITH (
  OIDS = FALSE
)
;
CREATE TABLE public.usuario
(
   id serial NOT NULL, 
   nome character varying(100) NOT NULL, 
   email character varying(100) NOT NULL, 
   senha character varying(40) NOT NULL, 
   id_perfil integer NOT NULL, 
   CONSTRAINT pk_usuario PRIMARY KEY (id), 
   CONSTRAINT fk_pessoa_perfil FOREIGN KEY (id_perfil) REFERENCES perfil (id) ON UPDATE NO ACTION ON DELETE NO ACTION
) 
WITH (
  OIDS = FALSE
)
;
--MySQL
CREATE TABLE perfil
(
   id int NOT NULL AUTO_INCREMENT,
   nome varchar(100) NOT NULL,
   PRIMARY KEY (id)
);
CREATE TABLE usuario
(
   id int NOT NULL AUTO_INCREMENT,
   nome varchar(100) NOT NULL,
   cpf varchar(14) NOT NULL,
   email varchar(100) NOT NULL,
   senha varchar(40) NOT NULL,
   id_perfil int NOT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY (id_perfil) REFERENCES perfil (id)
);