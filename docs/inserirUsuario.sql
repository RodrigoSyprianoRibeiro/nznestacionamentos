START TRANSACTION;

SELECT setval('perfil_id_seq', 1, false);

INSERT INTO perfil (nome)
 VALUES
  ('admin'),
  ('usuario');

SELECT setval('usuario_id_seq', 1, false);

INSERT INTO usuario (nome, cpf, email, senha, id_perfil)
 VALUES
  ('Rodrigo Ribeiro', '062.413.979-40', 'rodrigo.sypriano.ribeiro@gmail.com', md5('teste'), 1);

COMMIT;