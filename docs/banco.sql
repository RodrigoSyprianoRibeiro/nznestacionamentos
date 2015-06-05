CREATE TABLE perfil (
id int NOT NULL AUTO_INCREMENT,
nome varchar(40) NOT NULL,
CONSTRAINT pk_perfil PRIMARY KEY (id)
);

CREATE TABLE usuario (
id int NOT NULL AUTO_INCREMENT,
login varchar(40) NOT NULL,
senha varchar(40) NOT NULL,
ultimo_acesso datetime,
acesso_atual datetime,
id_perfil int NOT NULL,
CONSTRAINT pk_usuario PRIMARY KEY (id),
CONSTRAINT fk_usuario_perfil FOREIGN KEY (id_perfil) REFERENCES perfil(id)
);

CREATE TABLE pessoa (
id int NOT NULL AUTO_INCREMENT,
nome varchar(40) NOT NULL,
email varchar(40) NOT NULL,
telefone varchar(14) NOT NULL,
CONSTRAINT pk_pessoa PRIMARY KEY (id)
);

CREATE TABLE pessoa_fisica (
id int NOT NULL AUTO_INCREMENT,
cpf varchar(14) NOT NULL,
rg varchar(20) NOT NULL,
data_nascimento date NOT NULL,
id_pessoa int NOT NULL,
CONSTRAINT pk_pessoa_fisica PRIMARY KEY (id),
CONSTRAINT fk_pessoa_fisica_pessoa FOREIGN KEY (id_pessoa) REFERENCES pessoa(id)
);

CREATE TABLE pessoa_juridica (
id int NOT NULL AUTO_INCREMENT,
cnpj varchar(18) NOT NULL,
data_fundacao date NOT NULL,
id_pessoa int NOT NULL,
CONSTRAINT pk_pessoa_juridica PRIMARY KEY (id),
CONSTRAINT fk_pessoa_juridica_pessoa FOREIGN KEY (id_pessoa) REFERENCES pessoa(id)
);

CREATE TABLE estacionamento (
id int NOT NULL AUTO_INCREMENT,
endereco varchar(100) NOT NULL,
numero int,
complemento varchar(100),
bairro varchar(100) NOT NULL,
cep varchar(9) NOT NULL,
cidade varchar(40) NOT NULL,
uf varchar(2) NOT NULL,
id_pessoa_juridica int NOT NULL,
CONSTRAINT pk_estacionamento PRIMARY KEY (id),
CONSTRAINT fk_estacionamento_pessoa_juridica FOREIGN KEY (id_pessoa_juridica) REFERENCES pessoa_juridica(id)
);

CREATE TABLE tabela_preco (
id int NOT NULL AUTO_INCREMENT,
valor numeric(5,2) NOT NULL,
tempo int NOT NULL,
descricao varchar(100),
id_estacionamento int NOT NULL,
CONSTRAINT pk_tabela_preco PRIMARY KEY (id),
CONSTRAINT fk_tabela_preco_estacionamento FOREIGN KEY (id_estacionamento) REFERENCES estacionamento(id)
);

CREATE TABLE funcionario (
id int NOT NULL AUTO_INCREMENT,
matricula int NOT NULL,
data_admissao date NOT NULL,
salario numeric(9,2) NOT NULL,
id_usuario int NOT NULL,
id_estacionamento int NOT NULL,
id_pessoa_fisica int NOT NULL,
CONSTRAINT pk_funcionario PRIMARY KEY (id),
CONSTRAINT fk_funcionario_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id),
CONSTRAINT fk_funcionario_estacionamento FOREIGN KEY (id_estacionamento) REFERENCES estacionamento(id),
CONSTRAINT fk_funcionario_pessoa_fisica FOREIGN KEY (id_pessoa_fisica) REFERENCES pessoa_fisica(id)
);

CREATE TABLE cliente (
id int NOT NULL AUTO_INCREMENT,
saldo numeric(9,2) NOT NULL,
dia_pagamento int,
data_encerramento datetime,
id_usuario int NOT NULL,
id_pessoa int NOT NULL,
CONSTRAINT pk_cliente PRIMARY KEY (id),
CONSTRAINT fk_cliente_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id),
CONSTRAINT fk_cliente_pessoa FOREIGN KEY (id_pessoa) REFERENCES pessoa(id)
);

CREATE TABLE tipo_veiculo (
id int NOT NULL AUTO_INCREMENT,
tipo varchar(40) NOT NULL,
marca varchar(40) NOT NULL,
modelo varchar(40) NOT NULL,
CONSTRAINT pk_tipo_veiculo PRIMARY KEY (id)
);

CREATE TABLE veiculo (
id int NOT NULL AUTO_INCREMENT,
placa varchar(8) NOT NULL,
cor varchar(20) NOT NULL,
id_tipo_veiculo int NOT NULL,
CONSTRAINT pk_veiculo PRIMARY KEY (id),
CONSTRAINT fk_veiculo_tipo_veiculo FOREIGN KEY (id_tipo_veiculo) REFERENCES tipo_veiculo(id)
);

CREATE TABLE estada (
id int NOT NULL AUTO_INCREMENT,
entrada datetime,
saida datetime,
valor numeric(9,2),
status varchar(20) NOT NULL DEFAULT 'Entrou',
id_estacionamento int NOT NULL,
id_veiculo int NOT NULL,
CONSTRAINT pk_estada PRIMARY KEY (id),
CONSTRAINT fk_estada_estacionamento FOREIGN KEY (id_estacionamento) REFERENCES estacionamento(id),
CONSTRAINT fk_estada_veiculo FOREIGN KEY (id_veiculo) REFERENCES veiculo(id)
);

INSERT INTO perfil (id, nome)
 VALUES 
 (1, 'master'),
 (2, 'funcionario'),
 (3, 'cliente');

INSERT INTO usuario (id, login, senha, ultimo_acesso, acesso_atual, id_perfil) VALUES
(1, 'master', '698dc19d489c4e4db73e28a713eab07b', '2015-05-23 20:55:14', '2015-05-23 20:58:15', 1),
(2, 'funcionario', '698dc19d489c4e4db73e28a713eab07b', '2015-05-23 20:56:40', '2015-05-24 16:43:36', 2),
(3, 'cliente', '698dc19d489c4e4db73e28a713eab07b', '2015-05-23 20:55:40', '2015-05-23 20:55:40', 3);
