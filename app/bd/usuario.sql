use estoque;

create table if not exists usuarios(
    id int primary key auto_increment,
    usuario varchar(255) not null unique,
    senha varchar(255) not null
);


insert into usuarios (usuario, senha) values ('admin', password ('admin123'));function validarLogin() {
    let usuario = document.getElementById("usuario").value.trim();
    let senha = document.getElementById("senha").value.trim();

    if (usuario === "" || senha === "") {
        alert("Por favor, preencha todos os campos.");
        return false;
    }

    return true;
}