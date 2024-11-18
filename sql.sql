create database ativ_johann
use ativ_johann

create table cliente(
ID int primary key auto_increment,
nome varchar(25),
email varchar(60),
telefone varchar(11)
);

create table colaborador(
ID int primary key auto_increment,
nome varchar(25),
email varchar(60),
telefone varchar(11)
);

create table chamado(
ID int primary key auto_increment,
id_cliente int,
id_colaborador int,
descricao varchar(200),
criticidade enum("baixa", "media", "alta"),
status_chamado enum("aberto", "em andamento", "resolvido"),
data_abertura datetime,
foreign key (id_cliente) REFERENCES cliente(ID),
foreign key (id_colaborador) REFERENCES colaborador(ID)
)
