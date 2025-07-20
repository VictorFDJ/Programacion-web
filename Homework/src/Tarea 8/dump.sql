-- dump.sql

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS serie_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE serie_db;

-- Crear tabla personajes
CREATE TABLE IF NOT EXISTS personajes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  color VARCHAR(50) NOT NULL,
  tipo VARCHAR(50) NOT NULL,
  nivel INT NOT NULL,
  foto VARCHAR(255) NOT NULL
);

-- Insertar datos de ejemplo (opcional)
INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES
('Asta', 'Negro', 'Espadachín', 5, 'asta.jpg'),
('Yuno', 'Verde', 'Mago Viento', 5, 'yuno.jpg'),
('Noelle Silva', 'Azul', 'Mago Agua', 4, 'noelle.jpg');
