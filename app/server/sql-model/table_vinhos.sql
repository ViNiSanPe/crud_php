CREATE TABLE vinhos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    safra INT NOT NULL,
    pais_origem VARCHAR(100),
    preco DECIMAL(10, 2) NOT NULL,
);