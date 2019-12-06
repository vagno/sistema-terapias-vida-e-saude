CREATE DATABASE IF NOT EXISTS db_blog;

USE db_blog;

/* Lógico_1: */

CREATE TABLE tab_clientes (
    nome varchar(100),
    idade integer(3),
    email varchar(30),
    telefone varchar(20),
    celular varchar(20),
    status varchar(20),
    foto varchar(200),
    cpf varchar(20) PRIMARY KEY
);

CREATE TABLE tab_agenda (
    pagamento char,
    comparecimento char,
    anotacoes varchar(200),
    id_cpf varchar(20),
    valor double,
    hora time,
    data date,
    PRIMARY KEY (id_cpf, hora, data)
);

CREATE TABLE gastos (
    tag varchar(15),
    descricao varchar(200),
    valor double,
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    fornecedor varchar(100)
);

CREATE TABLE clientes_agenda_tab_agenda_tab_clientes_gastos (
    fk_tab_agenda_id_cpf varchar(20),
    fk_tab_agenda_hora time,
    fk_tab_agenda_data date,
    fk_tab_clientes_cpf varchar(20)
);
 
ALTER TABLE clientes_agenda_tab_agenda_tab_clientes_gastos ADD CONSTRAINT FK_clientes_agenda_tab_agenda_tab_clientes_gastos_1
    FOREIGN KEY (fk_tab_agenda_id_cpf, fk_tab_agenda_hora, fk_tab_agenda_data)
    REFERENCES tab_agenda (id_cpf, hora, data)
    ON DELETE NO ACTION;
 
ALTER TABLE clientes_agenda_tab_agenda_tab_clientes_gastos ADD CONSTRAINT FK_clientes_agenda_tab_agenda_tab_clientes_gastos_2
    FOREIGN KEY (fk_tab_clientes_cpf)
    REFERENCES tab_clientes (cpf)
    ON DELETE NO ACTION;


