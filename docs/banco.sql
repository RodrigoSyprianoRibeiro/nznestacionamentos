SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";

CREATE TABLE IF NOT EXISTS marca (
  id int(5) NOT NULL AUTO_INCREMENT,
  nome varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  CONSTRAINT pk_marca PRIMARY KEY (id)
) AUTO_INCREMENT=13 ;

INSERT INTO marca (id, nome) VALUES
(1, 'Citroën'),
(2, 'Fiat'),
(3, 'Ford'),
(4, 'Chevrolet'),
(5, 'Honda'),
(6, 'Hyundai'),
(7, 'Kia Motors'),
(8, 'Nissan'),
(9, 'Peugeot'),
(10, 'Renault'),
(11, 'Toyota'),
(12, 'VolksWagen');

CREATE TABLE IF NOT EXISTS modelo (
  id int(5) NOT NULL AUTO_INCREMENT,
  nome varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  id_marca int(5) NOT NULL,
  CONSTRAINT pk_modelo PRIMARY KEY (id),
  CONSTRAINT fk_modelo_marca FOREIGN KEY (id_marca) REFERENCES marca(id)
) AUTO_INCREMENT=143 ;

INSERT INTO modelo (id, nome, id_marca) VALUES
(1, 'AirCross', 1),
(2, 'C4', 1),
(3, 'C5', 1),
(4, 'C6', 1),
(5, 'C8', 1),
(6, 'Ds3', 1),
(7, 'Ds4', 1),
(8, 'Ds5', 1),
(9, 'Xsara', 1),
(10, 'Brava', 2),
(11, 'Bravo', 2),
(12, 'Cinquecento', 2),
(13, 'Doblo', 2),
(14, 'Ducato', 2),
(15, 'Fiorino', 2),
(16, 'Freemont', 2),
(17, 'Grand Siena', 2),
(18, 'Idea', 2),
(19, 'Linea', 2),
(20, 'Palio', 2),
(21, 'Punto', 2),
(22, 'Siena', 2),
(23, 'Stilo', 2),
(24, 'Strada', 2),
(25, 'Uno', 2),
(26, 'Courier', 3),
(27, 'Ecosport', 3),
(28, 'Edge', 3),
(29, 'F-1000', 3),
(30, 'F-250', 3),
(31, 'Fiesta', 3),
(32, 'Focus', 3),
(33, 'Fusion', 3),
(34, 'Ka', 3),
(35, 'Mondeo', 3),
(36, 'Ranger', 3),
(37, 'Transit', 3),
(38, 'Agile', 4),
(39, 'Astra', 4),
(40, 'Blazer', 4),
(41, 'Camaro', 4),
(42, 'Captiva', 4),
(43, 'Celta', 4),
(44, 'Chevette', 4),
(45, 'Classic', 4),
(46, 'Cobalt', 4),
(47, 'Corsa', 4),
(48, 'Cruze', 4),
(49, 'D-20', 4),
(50, 'Ipanema', 4),
(51, 'Kadett', 4),
(52, 'Malibu', 4),
(53, 'Meriva', 4),
(54, 'Montana', 4),
(55, 'Monza', 4),
(56, 'Omega', 4),
(57, 'Onix', 4),
(58, 'Opala', 4),
(59, 'Prisma', 4),
(60, 'S10', 4),
(61, 'Trailblazer', 4),
(62, 'Vectra', 4),
(63, 'Zafira', 4),
(64, 'Accord', 5),
(65, 'City', 5),
(66, 'Civic', 5),
(67, 'Cr-V', 5),
(68, 'Fit', 5),
(69, 'Azera', 6),
(70, 'Elantra', 6),
(71, 'Genesis', 6),
(72, 'Hb20', 6),
(73, 'Hb20S', 6),
(74, 'I30', 6),
(75, 'I30Sw', 6),
(76, 'Ix35', 6),
(77, 'Santa Fé', 6),
(78, 'Sonata', 6),
(79, 'Tucson', 6),
(80, 'Veloster', 6),
(81, 'Veracruz', 6),
(82, 'Besta', 7),
(83, 'Bongo', 7),
(84, 'Cerato', 7),
(85, 'Optima', 7),
(86, 'Picanto', 7),
(87, 'Sorento', 7),
(88, 'Soul', 7),
(89, 'Sportage', 7),
(90, 'Altima', 8),
(91, 'Frontier', 8),
(92, 'Livina', 8),
(93, 'March', 8),
(94, 'Pathfinder', 8),
(95, 'Sentra', 8),
(96, 'Versa', 8),
(97, 'X-Trail', 8),
(98, 'Xterra', 8),
(99, '206', 9),
(100, '207', 9),
(101, '208', 9),
(102, '3008', 9),
(103, '306', 9),
(104, '307', 9),
(105, '308', 9),
(106, '405', 9),
(107, '406', 9),
(108, '407', 9),
(109, '408', 9),
(110, 'Clio', 10),
(111, 'Duster', 10),
(112, 'Fluence', 10),
(113, 'Logan', 10),
(114, 'Master', 10),
(115, 'Megane', 10),
(116, 'Sandero', 10),
(117, 'Scénic', 10),
(118, 'Symbol', 10),
(119, 'Camry', 11),
(120, 'Corolla', 11),
(121, 'Etios', 11),
(122, 'Hilux', 11),
(123, 'Prius', 11),
(124, 'Rav4', 11),
(125, 'Amarok', 12),
(126, 'Bora', 12),
(127, 'Brasilia', 12),
(128, 'Crossfox', 12),
(129, 'Fox', 12),
(130, 'Fusca', 12),
(131, 'Gol', 12),
(132, 'Golf', 12),
(133, 'Jetta', 12),
(134, 'Parati', 12),
(135, 'Passat', 12),
(136, 'Polo', 12),
(137, 'Santana', 12),
(138, 'Saveiro', 12),
(139, 'SpaceCross', 12),
(140, 'SpaceFox', 12),
(141, 'Up!', 12),
(142, 'Voyage', 12);

CREATE TABLE IF NOT EXISTS perfil (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  CONSTRAINT pk_perfil PRIMARY KEY (id)
) AUTO_INCREMENT=4 ;

INSERT INTO perfil (id, nome) VALUES
(1, 'master'),
(2, 'funcionario'),
(3, 'cliente');

CREATE TABLE IF NOT EXISTS usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  login varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  senha varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  ultimo_acesso datetime DEFAULT NULL,
  acesso_atual datetime DEFAULT NULL,
  id_perfil int(11) NOT NULL,
  ativo tinyint(1) NOT NULL DEFAULT '1',
  CONSTRAINT pk_usuario PRIMARY KEY (id),
  CONSTRAINT fk_usuario_perfil FOREIGN KEY (id_perfil) REFERENCES perfil(id)
) AUTO_INCREMENT=11 ;

INSERT INTO usuario (id, login, senha, ultimo_acesso, acesso_atual, id_perfil, ativo) VALUES
(1, 'master', '698dc19d489c4e4db73e28a713eab07b', '2015-06-03 23:36:14', '2015-06-14 03:47:13', 1, 1),
(2, 'joao.silva', '698dc19d489c4e4db73e28a713eab07b', '2015-05-28 11:25:57', '2015-06-02 12:36:19', 2, 1),
(3, 'pedro.rafael', '698dc19d489c4e4db73e28a713eab07b', '2015-05-28 11:25:57', '2015-06-02 12:36:19', 2, 1),
(4, 'andre.neto', '698dc19d489c4e4db73e28a713eab07b', '2015-05-28 11:25:57', '2015-06-02 12:36:19', 2, 1),
(5, 'bibiane.silva', '698dc19d489c4e4db73e28a713eab07b', '2015-05-28 11:25:57', '2015-06-02 12:36:19', 2, 1),
(6, 'abadio.rodrigues', '698dc19d489c4e4db73e28a713eab07b', NULL, NULL, 3, 1),
(7, 'leonardo.dias', '698dc19d489c4e4db73e28a713eab07b', NULL, NULL, 3, 1),
(8, 'pedro.pereira', '698dc19d489c4e4db73e28a713eab07b', NULL, NULL, 3, 1),
(9, 'yuri.martins', '698dc19d489c4e4db73e28a713eab07b', NULL, NULL, 3, 1),
(10, 'mariah.alves', '698dc19d489c4e4db73e28a713eab07b', NULL, NULL, 3, 1);

CREATE TABLE IF NOT EXISTS cliente (
  id int(5) NOT NULL AUTO_INCREMENT,
  nome varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  tipo varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  cpf varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  rg varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  data_nascimento date DEFAULT NULL,
  cnpj varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  data_fundacao date DEFAULT NULL,
  email varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  telefone varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  saldo decimal(9,2) NOT NULL DEFAULT '0.00',
  data_encerramento date DEFAULT NULL,
  id_usuario int(5) NOT NULL,
  ativo tinyint(1) NOT NULL DEFAULT '1',
  CONSTRAINT pk_cliente PRIMARY KEY (id),
  CONSTRAINT fk_cliente_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id)
) AUTO_INCREMENT=6 ;

INSERT INTO cliente (id, nome, tipo, cpf, rg, data_nascimento, cnpj, data_fundacao, email, telefone, saldo, id_usuario, ativo) VALUES
(1, 'Abadio dos Santos Rodrigues', 'fisica', '007.819.151-39', '98499806', '1985-09-24', NULL, NULL, 'abadio@gmail.com', '(48) 9998-7654', '50.00', 6, 1),
(2, 'Leonardo Filipe Dias', 'fisica', '947.867.500-18', '33025919', '1987-02-11', NULL, NULL, 'leonardo@gmail.com', '(48) 9865-4512', '10.00', 7, 1),
(3, 'Pedro Bryan Pereira', 'fisica', '007.819.151-39', '905065871', '1990-10-20', NULL, NULL, 'pedro@gmail.com', '(48) 9954-8721', '150.00', 8, 1),
(4, 'Yuri Benjamin Martins', 'fisica', '007.819.151-39', '459865781', '2000-01-15', NULL, NULL, 'yuri@gmail.com', '(48) 9854-6532', '30.00', 9, 1),
(5, 'Mariah Valentina Stella Alves', 'fisica', '007.819.151-39', '659845321', '1990-03-19', NULL, NULL, 'mariah@gmail.com', '(48) 9865-4102', '40.00', 10, 1);

CREATE TABLE IF NOT EXISTS veiculo (
  id int(5) NOT NULL AUTO_INCREMENT,
  id_cliente int(5) NOT NULL,
  id_marca int(5) NOT NULL,
  id_modelo int(5) NOT NULL,
  placa varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  cor varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  ativo tinyint(1) NOT NULL DEFAULT '1',
  CONSTRAINT pk_veiculo PRIMARY KEY (id),
  CONSTRAINT fk_veiculo_cliente FOREIGN KEY (id_cliente) REFERENCES cliente(id),
  CONSTRAINT fk_veiculo_marca FOREIGN KEY (id_marca) REFERENCES marca(id),
  CONSTRAINT fk_veiculo_modelo FOREIGN KEY (id_modelo) REFERENCES modelo(id)
) AUTO_INCREMENT=6;

INSERT INTO veiculo (id, id_cliente, id_marca, id_modelo, placa, cor, ativo) VALUES
(1, 1, 1, 3, 'ABB-9114', 'Vermelho', 1),
(2, 2, 2, 10, 'AFD-7492', 'Amarelo', 1),
(3, 3, 3, 30, 'BAC-7733', 'Branco', 1),
(4, 4, 6, 71, 'BAZ-9843', 'Preto', 1),
(5, 5, 4, 58, 'BEE-1195', 'Azul', 1);

CREATE TABLE IF NOT EXISTS estacionamento (
  id int(5) NOT NULL AUTO_INCREMENT,
  nome varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  cnpj varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  data_fundacao date NOT NULL,
  email varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  telefone varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  cep varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  logradouro varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  numero varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  complemento varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  bairro varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  cidade varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  uf varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  nr_vaga_comum int(5) NOT NULL DEFAULT '0',
  nr_vaga_especial int(5) NOT NULL DEFAULT '0',
  nr_vaga_aluguel int(5) NOT NULL DEFAULT '0',
  ativo tinyint(1) NOT NULL DEFAULT '1',
  CONSTRAINT pk_estacionamento PRIMARY KEY (id)
) AUTO_INCREMENT=4 ;

INSERT INTO estacionamento (id, nome, cnpj, data_fundacao, email, telefone, cep, logradouro, numero, complemento, bairro, cidade, uf, ativo) VALUES
(1, 'NZN Centro', '78.248.564/0001-35', '2014-01-22', 'tubarao.centro@nznestacionamentos.com.br', '(48) 3622-6743', '88701-000', 'Avenida Marcolino Martins Cabral', '302', NULL, 'Centro', 'Tubarão', 'SC', 1),
(2, 'NZN Morrotes', '76.118.518/0001-96', '2014-06-01', 'tubarao.morrotes@nznestacionamentos.com.br', '(48) 3622-5643', '88704-781', 'Rua Lucinda Frederico', '79', NULL, 'Morrotes', 'Tubarão', 'SC', 1),
(3, 'NZN Campestre', '84.387.349/0001-18', '2014-12-15', 'tubarao.campestre@nznestacionamentos.com.br', '(48) 3622-9865', '88706-085', 'Rua Francisco de Assis da Silva', '105', NULL, 'Campestre', 'Tubarão', 'SC', 1);

CREATE TABLE IF NOT EXISTS tabela_preco (
  id int(5) NOT NULL AUTO_INCREMENT,
  tempo int(5) NOT NULL,
  valor decimal(9,2) NOT NULL,
  id_estacionamento int(5) NOT NULL,
  ativo tinyint(1) NOT NULL DEFAULT '1',
  CONSTRAINT pk_tabela_preco PRIMARY KEY (id),
  CONSTRAINT fk_tabela_preco_estacionamento FOREIGN KEY (id_estacionamento) REFERENCES estacionamento(id)
) AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS funcionario (
  id int(5) NOT NULL AUTO_INCREMENT,
  nome varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  cpf varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  rg varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  data_nascimento date NOT NULL,
  email varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  telefone varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  matricula int(6) NOT NULL,
  data_admissao date NOT NULL,
  salario decimal(9,2) NOT NULL,
  id_usuario int(5) NOT NULL,
  id_estacionamento int(5) NOT NULL,
  ativo tinyint(1) NOT NULL DEFAULT '1',
  CONSTRAINT pk_funcionario PRIMARY KEY (id),
  CONSTRAINT fk_funcionario_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id),
  CONSTRAINT fk_funcionario_estacionamento FOREIGN KEY (id_estacionamento) REFERENCES estacionamento(id)
) AUTO_INCREMENT=5 ;

INSERT INTO funcionario (id, nome, cpf, rg, data_nascimento, email, telefone, matricula, data_admissao, salario, id_usuario, id_estacionamento, ativo) VALUES
(1, 'João da Silva', '208.614.451-20', '6598757', '1968-01-23', 'joao@gmail.com', '(48) 9988-7452', 94183, '2013-01-01', '2000.00', 2, 1, 1),
(2, 'Pedro Rafael', '297.889.923-90', '5532345', '1977-07-09', 'pedro@gmail.com', '(48) 9990-8767', 92817, '2013-09-28', '1300.00', 3, 2, 1),
(3, 'André Luiz Neto', '139.651.838-00', '1968543', '1993-12-01', 'andre@gmail.com', '(48) 9671-0283', 38519, '2015-09-05', '1000.00', 4, 3, 1),
(4, 'Bibiane Cardoso da Silva', '476.191.145-05', '9765423', '1981-09-15', 'bibiane@gmail.com', '(48) 9971-0203', 61572, '2014-04-20', '3100.00', 5, 3, 1);

CREATE TABLE IF NOT EXISTS estada (
  id int(5) NOT NULL AUTO_INCREMENT,
  entrada datetime NOT NULL,
  saida datetime NOT NULL,
  valor decimal(9,2) NOT NULL,
  status varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  id_estacionamento int(5) NOT NULL,
  id_veiculo int(5) NOT NULL,
  CONSTRAINT pk_estada PRIMARY KEY (id),
  CONSTRAINT fk_estada_estacionamento FOREIGN KEY (id_estacionamento) REFERENCES estacionamento(id),
  CONSTRAINT fk_estada_veiculo FOREIGN KEY (id_veiculo) REFERENCES veiculo(id)
) AUTO_INCREMENT=1 ;