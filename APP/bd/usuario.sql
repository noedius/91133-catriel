use estoque;

create table if not exists usuarios(
    id int primary key auto_increment,
    usuario varchar(255) not null unique,
    senha varchar(255) not null
);


insert into usuarios (usuario, senha) values ('admin', password ('admin123'));