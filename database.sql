-- database.sql
CREATE DATABASE IF NOT EXISTS estacao_bebidas_sabores
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE estacao_bebidas_sabores;

-- Tabela de usuários
DROP TABLE IF EXISTS order_items;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS menu_items;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de itens do menu
CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    tipo ENUM('prato', 'bebida', 'sobremesa') NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    descricao TEXT,
    imagem_url VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabela de pedidos
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    observacoes TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Itens de cada pedido
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    menu_item_id INT NOT NULL,
    quantidade INT DEFAULT 1,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dados de exemplo (menu)
INSERT INTO menu_items (nome, tipo, preco, descricao) VALUES
('Filé Mignon', 'prato', 35.90, 'Filé mignon grelhado com molho especial'),
('Salmão Grelhado', 'prato', 38.50, 'Salmão com ervas e limão'),
('Frango Parmigiana', 'prato', 28.00, 'Peito de frango à parmegiana'),
('Suco Natural', 'bebida', 6.00, 'Suco natural da fruta do dia'),
('Refrigerante', 'bebida', 6.50, 'Refrigerante lata 350ml'),
('Caipirinha', 'bebida', 14.00, 'Caipirinha tradicional'),
('Pudim de Leite', 'sobremesa', 7.50, 'Pudim cremoso de leite condensado'),
('Brownie com Sorvete', 'sobremesa', 12.00, 'Brownie quente com sorvete de baunilha'),
('Torta de Limão', 'sobremesa', 9.00, 'Torta de limão com merengue');

-- OBS: exemplo de usuário NÃO contém senha hash — use register.php para criar usuários com password_hash()
-- Exemplo de pedido de demonstração (assume que exista user id 1):
-- INSERT INTO users (nome, email, senha, telefone) VALUES ('Sania', 'sania@email.com', 'senha123', '11999999999');
-- INSERT INTO orders (user_id, observacoes) VALUES (1, 'Sem cebola no prato principal');
-- INSERT INTO order_items (order_id, menu_item_id, quantidade) VALUES (1, 1, 1), (1, 4, 1), (1, 7, 1);
