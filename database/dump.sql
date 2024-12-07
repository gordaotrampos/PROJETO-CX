

-- Tabela para administradores
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Tabela para dados dos usuários
CREATE TABLE user_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(14) NOT NULL,
    tipo ENUM('fisica', 'juridica', 'governo') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Administrador padrão
INSERT INTO admin_users (username, password) VALUES ('admin', MD5('1234'));
