CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT
);
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    status ENUM('active', 'archived') DEFAULT 'active', 
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    service_id INT NOT NULL,
    reservation_time DATETIME NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);
CREATE TABLE available_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    service_id INT NOT NULL,
    slot_time DATETIME NOT NULL,
    is_booked BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);
INSERT INTO roles (name, description) VALUES
('user', 'Client normal'),
('admin', 'Administrateur système');

INSERT INTO users (role_id, name, email, password) VALUES
(1, 'Alice', 'alice@example.com', 'hashed_password_1'),
(2, 'Bob', 'bob@example.com', 'hashed_password_2');

INSERT INTO services (name, description, price) 
VALUES 
  ('Table pour 2 personnes', 'Table pour deux personnes dans le restaurant', 20.00),
  ('Chambre simple', 'Chambre avec un lit simple dans l hôtel', 50.00);

INSERT INTO available_slots (service_id, slot_time, is_booked) VALUES
(1, '2024-12-20 18:00:00', FALSE),
(1, '2024-12-20 20:00:00', FALSE),
(2, '2024-12-20 14:00:00', FALSE);

INSERT INTO reservations (user_id, service_id, reservation_time, status) VALUES
(1, 1, '2024-12-20 18:00:00', 'pending'),
(2, 2, '2024-12-20 14:00:00', 'confirmed');

-- Un utilisateur a un seul rôle (relation 1 à N entre roles et users).
-- Un utilisateur peut faire plusieurs réservations (relation 1 à N entre users et reservations).
-- Un service peut avoir plusieurs réservations (relation 1 à N entre services et reservations).
-- Un service peut avoir plusieurs créneaux horaires disponibles (relation 1 à N entre services et available_slots).
