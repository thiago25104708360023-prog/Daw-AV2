CREATE DATABASE IF NOT EXISTS lumine_beauty CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lumine_beauty;

-- Tabela de Usuários
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tabela de Categorias dos Serviços
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabela de Serviços Individuais
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Tabela Mestre de Agendamentos
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Itens do Agendamento (Detalhes do serviço escolhido, data e hora)
CREATE TABLE IF NOT EXISTS appointment_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    appointment_id INT NOT NULL,
    service_id INT NOT NULL,
    booking_date DATE NOT NULL,
    booking_time TIME NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Inserção das Categorias baseadas no layout do carrinho
INSERT INTO categories (id, name, slug) VALUES 
(1, 'Corte de Cabelo', 'corte'),
(2, 'Manicure', 'manicure'),
(3, 'Coloração', 'coloracao'),
(4, 'Tratamentos', 'tratamentos')
ON DUPLICATE KEY UPDATE name=VALUES(name);

-- Inserção dos serviços do menu com seus respectivos valores
INSERT INTO services (category_id, name, price) VALUES
(1, 'Corte Masculino', 40.00),
(1, 'Corte Feminino', 60.00),
(1, 'Corte Infantil', 30.00),
(1, 'Corte Com Tesoura', 70.00),
(2, 'Manicure Simples', 30.00),
(2, 'Pedicure', 35.00),
(2, 'Mãos + Pés (Combo)', 60.00),
(3, 'Coloração Completa', 120.00),
(3, 'Mechas', 100.00),
(3, 'Tonalizante', 30.00),
(3, 'Matização', 70.00),
(4, 'Hidratação Capilar', 60.00),
(4, 'Nutrição Capilar', 100.00),
(4, 'Limpeza De Pele', 120.00);

--email pra testar
INSERT INTO users (name, email, password) VALUES 
('Cliente Teste', 'luminebeautyofc@gmail.com', '$2y$10$7R93Wf7eLwYh0GvT.5pfeOX2Wq7v1O1t67R3M2/oV3pEq3.tD.YWW')
ON DUPLICATE KEY UPDATE email=email;
