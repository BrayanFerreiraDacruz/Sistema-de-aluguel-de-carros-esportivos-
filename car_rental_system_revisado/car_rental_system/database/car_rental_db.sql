CREATE DATABASE IF NOT EXISTS car_rental_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE car_rental_db;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    tipo_usuario ENUM('cliente', 'admin') NOT NULL DEFAULT 'cliente',
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE carros (
    id_carro INT AUTO_INCREMENT PRIMARY KEY,
    marca VARCHAR(50) NOT NULL,
    modelo VARCHAR(50) NOT NULL,
    ano YEAR NOT NULL,
    cor VARCHAR(30),
    placa VARCHAR(10) NOT NULL UNIQUE,
    preco_diario DECIMAL(10, 2) NOT NULL,
    status ENUM('disponivel', 'alugado', 'manutencao') NOT NULL DEFAULT 'disponivel',
    imagem_url VARCHAR(255)
);

CREATE TABLE alugueis (
    id_aluguel INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_carro INT NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim_previsto DATE NOT NULL,
    data_devolucao DATE,
    valor_total DECIMAL(10, 2) NOT NULL,
    status ENUM('pendente', 'ativo', 'concluido', 'cancelado') NOT NULL DEFAULT 'pendente',
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_carro) REFERENCES carros(id_carro) ON DELETE RESTRICT
);

INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES 
('Administrador', 'admin@carrental.com', '$2y$10$7/lF8j.gY9.hK2j.G5.g.e.t.h.i.s.i.s.a.h.a.s.h.e.x.a.m.p.l.e', 'admin');

INSERT INTO carros (marca, modelo, ano, cor, placa, preco_diario, imagem_url) VALUES
('Ferrari', '488 GTB', 2020, 'Vermelho', 'ABC-1234', 1500.00, 'ferrari_488.jpg'),
('Lamborghini', 'Huracan Evo', 2021, 'Amarelo', 'DEF-5678', 1800.00, 'huracan_evo.jpg'),
('Porsche', '911 Turbo S', 2022, 'Preto', 'GHI-9012', 1200.00, 'porsche_911.jpg');
