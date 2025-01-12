-- Criando o banco de dados para o sistema de gestão de hotel
CREATE DATABASE hotel_management;
USE hotel_management;

-- Tabela para armazenar os dados dos clientes
CREATE TABLE cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    num_identificacao VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contacto VARCHAR(20) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela para armazenar os dados dos quartos
CREATE TABLE quarto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_quarto VARCHAR(10) UNIQUE NOT NULL,
    tipo VARCHAR(50) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    status ENUM('Disponível', 'Ocupado', 'Reservado') DEFAULT 'Disponível',
    descricao TEXT
);

-- Tabela para armazenar as reservas
CREATE TABLE reserva (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    quarto_id INT NOT NULL,
    data_checkin DATE NOT NULL,
    data_checkout DATE NOT NULL,
    status ENUM('Ativa', 'Concluída', 'Cancelada') DEFAULT 'Ativa',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES cliente(id) ON DELETE CASCADE,
    FOREIGN KEY (quarto_id) REFERENCES quarto(id) ON DELETE CASCADE
);

-- Tabela para gerenciar administradores e autenticação
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);