CREATE TABLE IF NOT EXISTS usuarios (
    id INT(6) AUTO_INCREMENT,
    usuario  VARCHAR(50) NOT NULL,
    nome  VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    privileges INT(2) NOT NULL DEFAULT 2,
    excluido BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS categorias (
    id INT(6) AUTO_INCREMENT,
    titulo VARCHAR(50) NOT NUll,
    descricao VARCHAR(500) NOT NUll,
    excluido BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS produtos (
    id INT(6) AUTO_INCREMENT,
    idusuario INT(6) NOT NULL,
    idcategoria INT(6) NOT NULL,
    titulo VARCHAR(50) NOT NUll,
    imagem VARCHAR(500) NOT NULL,
    descricao VARCHAR(500) NOT NULL,
    valor decimal(10,2) NOT NUll,
    quantidade INT(6) NOT NULL,
    excluido BOOLEAN NOT NULL DEFAULT 0,
    PRIMARY KEY(id),
    FOREIGN KEY(idusuario) REFERENCES usuarios(id),
    FOREIGN KEY(idcategoria) REFERENCES categorias(id)
);

INSERT INTO usuarios (usuario, nome, email, senha, privileges, excluido) VALUES ('christian.murata', 'Christian Eduardo Murata', MD5('christian.murata'), 'chris_murata@hotmail.com', 1, FALSE);
INSERT INTO categorias (titulo, descricao, excluido) VALUES ('Animais', 'Pets incríveis a sua disposição', FALSE);
INSERT INTO categorias (titulo, descricao, excluido) VALUES ('Serviços', 'Os melhores serviços para você', FALSE);
INSERT INTO categorias (titulo, descricao, excluido) VALUES ('Acessórios', 'Moda e beleza', FALSE);
INSERT INTO categorias (titulo, descricao, excluido) VALUES ('Eletrônicos', 'Computadores, video-games, notebooks, tablets e smartphones.', FALSE);
INSERT INTO categorias (titulo, descricao, excluido) VALUES ('Eletrodomésticos', 'As melhores ofertas de eletrodomésticos que a sua casa precisa! ', FALSE);