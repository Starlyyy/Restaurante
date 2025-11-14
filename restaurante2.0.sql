create table usuario(
    id_usuario int primary key AUTO_INCREMENT,
    nomeUsuario varchar(60) not null,
    senhaUsuario varchar(20) not null,
    fotoUsuario varchar(200),
    isAdm char(1) not null,

    constraint chk_usuario check (isAdm in ('S', 'N'))
);

insert into usuario (nomeUsuario, senhaUsuario, isAdm) values
('Izabella', '090908', 'S'),
('Rebeca', '280308', 'S'),
('Severino', 'garcom1', 'N')
