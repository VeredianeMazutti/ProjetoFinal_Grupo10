DROP SCHEMA IF EXISTS Innovamind_ProjetoFinal;
CREATE SCHEMA IF NOT EXISTS Innovamind_ProjetoFinal  DEFAULT CHARACTER SET utf8mb4;
USE Innovamind_ProjetoFinal;

CREATE TABLE usuario (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nomeCompleto VARCHAR(200) NOT NULL,
    dataNascimento DATE NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    areaAtuacao VARCHAR(150) NOT NULL,
    nomeExibicao VARCHAR(70) NOT NULL UNIQUE,
    foto VARCHAR(255),
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario',
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
    nomeProjeto VARCHAR(100) NOT NULL,
    nomeResponsavel VARCHAR(150) NOT NULL,
    nomeColaboradores TEXT,
    nomeInstituicao VARCHAR (150),
    emailProjeto VARCHAR(100) NOT NULL,
        localizacaoEstado ENUM(
		'acre',
        'alagoas',
        'amapa',
        'amazonas',
        'bahia',
        'ceara',
        'distrito_federal',
        'espirito_santo',
        'goias',
        'maranhao',
        'mato_grosso',
        'mato_grosso_do_sul',
        'minas_gerais',
        'para',
        'paraiba',
        'parana',
        'pernambuco',
        'piaui',
        'rio_de_janeiro',
        'rio_grande_do_norte',
        'rio_grande_do_sul',
        'rondonia',
        'roraima',
        'santa_catarina',
        'sao_paulo',
        'sergipe',
        'tocantins'
    ) NOT NULL,
    categoria ENUM(
        'sustentabilidade',
        'educacao',
        'tecnologia',
        'impacto_social',
        'saude',
        'cultura',
        'empreendedorismo',
        'cidadania',
        'comunicacao',
        'economia',
        'ciencias',
        'entretenimento',
        'sociedade',
        'outras'
    ) NOT NULL,
    breveDescricao VARCHAR(150) NOT NULL,
    faseDesenvolvimento ENUM(
        'ideia',
        'planejamento',
        'em_andamento',
        'concluido'
    ) NOT NULL,
    contribuicao TEXT NOT NULL,
    descricaoDetalhada TEXT NOT NULL,
    linksProjeto TEXT,
    visualizacoes INT UNSIGNED DEFAULT 0,
    dataCadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_projeto_usuario FOREIGN KEY (fk_usuario) REFERENCES usuario(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE projetoCurtidas (
    idCurtida INT AUTO_INCREMENT PRIMARY KEY,
    fk_idProjeto INT UNSIGNED NOT NULL,
    fk_idUsuario INT UNSIGNED,       -- pode ser NULL para visitantes
    visitanteHash VARCHAR(255),      -- identificador único do visitante (cookie/hash)
    UNIQUE KEY unico_usuario_projeto (fk_idProjeto, fk_idUsuario, visitanteHash),
    FOREIGN KEY (fk_idProjeto) REFERENCES projetos(id) ON DELETE CASCADE,
    FOREIGN KEY (fk_idUsuario) REFERENCES usuario(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE trilha (
    id_trilha INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    subtitulo VARCHAR(255) NULL,
    descricao TEXT NULL,
    duracao VARCHAR(100) NULL,
    nivel VARCHAR(50) NULL,
    introducao LONGTEXT NULL,
    objetivos LONGTEXT NULL,
    conteudo LONGTEXT NULL,
    imagemCapa VARCHAR(255) NULL,
    pontuacaoMinima INT DEFAULT 0,
    perguntasTrilha LONGTEXT NULL,
    mensagemConclusao LONGTEXT NULL,
    gerarCertificado TINYINT(1) DEFAULT 0,
    autorTrilha VARCHAR(255) NULL,
    tagsTrilha VARCHAR(255) NULL,
    referenciasTrilha LONGTEXT NULL,
    ativoTrilha TINYINT(1) DEFAULT 1,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE trilha_usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_trilha INT NOT NULL,
    nome_usuario VARCHAR(255) NOT NULL,
    nota INT NOT NULL,
    certificado VARCHAR(255),
    data_conclusao DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_trilha) REFERENCES trilha(id_trilha)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE apoiadores (
    idApoiadores INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('pessoa', 'empresa', 'instituicao') NOT NULL,
    nome VARCHAR(255) NOT NULL,
    descricao VARCHAR(500) NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL,
    site VARCHAR(255) DEFAULT NULL,
    instagram VARCHAR(255) DEFAULT NULL,
    linkedin VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE faq (
    idFaq INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pergunta VARCHAR(450) NOT NULL,
    resposta TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE editalinterno (
    idEditalInterno INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descResumida TEXT NOT NULL,
    descCompleta TEXT NOT NULL,
    organizacao VARCHAR(255) NOT NULL,
    tipoApoio VARCHAR(255) NOT NULL,
    dataAbertura DATE NOT NULL,
    dataEncerramento DATE NOT NULL,
    status VARCHAR(50) NOT NULL,
    vagas INT NOT NULL,
    criterios TEXT NOT NULL,
    participantes TEXT NOT NULL,
    etapas TEXT,
    beneficios TEXT,
    responsavel VARCHAR(255),
    contato VARCHAR(255),
    observacoes TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE inscricaoedital (
    idInscricao INT AUTO_INCREMENT PRIMARY KEY,
    idEditalInterno INT NOT NULL,
    fk_usuario INT NOT NULL,
    responsavel VARCHAR(150) NOT NULL,
    email VARCHAR(120) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    instituicao VARCHAR(150) NULL,
    titulo VARCHAR(200) NOT NULL,
    resumo TEXT NOT NULL,
    objetivo TEXT NOT NULL,
    relato TEXT NOT NULL,
	status VARCHAR(20) NOT NULL,
    dataInscricao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_inscricao_edital
        FOREIGN KEY (idEditalInterno) REFERENCES editalinterno(idEditalInterno)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE editaisexternos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao VARCHAR(100) NOT NULL,
    link VARCHAR(500) NOT NULL,
    dataCadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE RecuperacaoSenha (
    idRecuperacaoSenha INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idUsuarioFK INT(11) NOT NULL,
    tokenRecuperacaoSenha VARCHAR(200) NOT NULL UNIQUE,
    expiraRecuperacaoSenha DATETIME NOT NULL,
    criadoRecuperacaoSenha DATETIME DEFAULT CURRENT_TIMESTAMP(),
    KEY idUsuarioFK (idUsuarioFK),
    CONSTRAINT recuperacao_senha_usuario FOREIGN KEY (idUsuarioFK) REFERENCES Usuario(idUsuario) ON DELETE CASCADE
);