create database Innovamind_ProjetoFinal;
use Innovamind_ProjetoFinal;

CREATE TABLE usuario (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomeCompleto VARCHAR(200) NOT NULL,
    dataNascimento DATE NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    areaAtuacao VARCHAR(150) NOT NULL,
    nomeExibicao VARCHAR(70) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO usuario (nomeCompleto, dataNascimento, telefone, areaAtuacao, nomeExibicao, email, senha, perfil)
VALUES (
    'Administrador',
    '1990-01-01',
    '11999999999',
    'Gestão',
    'admin',
    'admin@innovamind.com',
    '$2y$10$vNPWwCfCO5voTptPMNo0l..uWHZmJah1PvtlrdoGAs1BeTJJfveni',
    'admin'
);

CREATE TABLE projetos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fk_usuario INT UNSIGNED NOT NULL,
    nomeProjeto VARCHAR(200) NOT NULL,
    nomeResponsavel VARCHAR(150) NOT NULL,
    contato VARCHAR(150) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    descricaoBreve VARCHAR(300) NOT NULL,
    faseDesenvolvimento VARCHAR(50) NOT NULL,
    contribuicao VARCHAR(350) NOT NULL,
    descricaoDetalhada TEXT NOT NULL,
    dataCadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    CONSTRAINT fk_usuario_fk FOREIGN KEY (fk_usuario) REFERENCES usuario(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE fotoProjeto (
    id_foto INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fk_projeto INT UNSIGNED NOT NULL,
    nome VARCHAR(255) NOT NULL,
    legenda VARCHAR(255),
    alternativo VARCHAR(255),
    data_upload DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_foto_projeto FOREIGN KEY (fk_projeto)
        REFERENCES projetos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
