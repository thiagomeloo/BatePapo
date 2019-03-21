create database bate_papo;
use bate_papo;

create table user (
apelido varchar(20) primary key not null,
hora dateTime not null
);


create table mensagens (
id int auto_increment not null primary key,
apelido varchar(55),
mensagem varchar(255),
hora dateTime
);


