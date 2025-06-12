CREATE DATABASE IF NOT EXISTS todo;
USE todo;

CREATE TABLE IF NOT EXISTS users (
  user_id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(255),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS todos (
  todo_id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  title VARCHAR(255),
  description VARCHAR(500),
  due_date VARCHAR(50),
  is_done INT,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO users (name, email, password)
VALUES ('Hana', 'hana@example.com', 'hashedpassword123');

INSERT INTO todos (user_id, title, description, due_date, is_done)
VALUES (1, 'Grocery shopping', 'Buy milk, eggs, and bread', '2025-06-15', 0);

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
